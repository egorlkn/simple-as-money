<?php

declare(strict_types=1);

namespace App\Infrastructure\IncomeCalculator;

use App\Core\IncomeCalculator;
use Symfony\Component\HttpFoundation\Response;

class Presentation
{
    private ?IncomeCalculator\Model\Result $result = null;

    private ?IncomeCalculator\Exception\CalculatorException $exception = null;

    private function __construct() {}

    public static function success(IncomeCalculator\Model\Result $result): self
    {
        $self = new self();

        $self->result = $result;

        return $self;
    }

    public static function fail(IncomeCalculator\Exception\CalculatorException $exception): self
    {
        $self = new self();

        $self->exception = $exception;

        return $self;
    }

    public function isSuccessful(): bool
    {
        return $this->result instanceof IncomeCalculator\Model\Result;
    }

    public function getView(): array
    {
        if ($this->isSuccessful()) {
            return $this->getSuccessfulView();
        }

        return $this->getFailedView();
    }

    public function getHttpCode(): int
    {
        if ($this->isSuccessful()) {
            return Response::HTTP_OK;
        }

        return $this->getFailedHttpCode();
    }

    private function getSuccessfulView(): array
    {
        $yearlyBalances = $this->result->getYearlyBalanceCollection();
        $yearlyBalancesView = [];

        foreach ($yearlyBalances->getIterator() as $yearlyBalance) {
            $yearlyBalancesView[] = [
                'index_of_year' => $yearlyBalance->getIndexOfYear(),
                'amount' => round($yearlyBalance->getAmount(), 2),
            ];
        }

        return [
            'initial_amount' => round($this->result->getInitialAmount(), 2),
            'regular_payment' => round($this->result->getRegularPayment(), 2),
            'number_of_regular_payments_per_year' => $this->result->getNumberOfRegularPaymentsPerYear(),
            'number_of_years' => $this->result->getNumberOfYears(),
            'interest_rate_per_year' => round($this->result->getInterestRatePerYear(), 2),
            'final_amount' => round($this->result->getFinalAmount(), 2),
            'yearly_balances' => $yearlyBalancesView,
        ];
    }

    private function getFailedView(): array
    {
        $view = [
            'error_code' => $this->exception->getCode(),
            'errors' => [],
        ];

        if ($this->exception instanceof IncomeCalculator\Exception\InputValidationException) {
            foreach ($this->exception->getValidationErrors() as $error) {
                $view['errors'][] = $error;
            }

            return $view;
        }

        $view['errors'][] = 'К сожалению не удалось произвести расчёт с приведёнными данными';
        $view['errors'][] = 'Мы уже получили подробный отчет и начали исправление';
        $view['errors'][] = 'Спасибо за понимание!';

        return $view;
    }

    private function getFailedHttpCode(): int
    {
        switch ($this->exception->getCode()) {
            case IncomeCalculator\Exception\CalculatorException::INPUT_VALIDATION_ERROR:
                return Response::HTTP_BAD_REQUEST;
        }

        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}
