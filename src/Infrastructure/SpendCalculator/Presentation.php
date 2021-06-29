<?php

declare(strict_types=1);

namespace App\Infrastructure\SpendCalculator;

use App\Core\SpendCalculator;
use Symfony\Component\HttpFoundation\Response;

class Presentation
{
    private ?SpendCalculator\Model\Result $result = null;

    private ?SpendCalculator\Exception\CalculatorException $exception = null;

    private function __construct() {}

    public static function success(SpendCalculator\Model\Result $result): self
    {
        $self = new self();

        $self->result = $result;

        return $self;
    }

    public static function fail(SpendCalculator\Exception\CalculatorException $exception): self
    {
        $self = new self();

        $self->exception = $exception;

        return $self;
    }

    public function isSuccessful(): bool
    {
        return $this->result instanceof SpendCalculator\Model\Result;
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
        $balancesByPeriod = $this->result->getBalancesByPeriod();
        $balancesByPeriodView = [];

        /** @var SpendCalculator\Model\BalanceByPeriod $balance */
        foreach ($balancesByPeriod as $balance) {
            $balancesByPeriodView[] = [
                'index_of_period' => $balance->getIndexOfPeriod(),
                'amount' => round($balance->getAmount(), 2),
            ];
        }

        return [
            'initial_amount' => round($this->result->getInitialAmount(), 2),
            'payment_amount' => round($this->result->getPaymentAmount(), 2),
            'number_of_payments_per_year' => $this->result->getNumberOfPaymentsPerYear(),
            'number_of_years' => $this->result->getNumberOfYears(),
            'interest_rate_per_year' => round($this->result->getInterestRatePerYear(), 2),
            'final_amount' => round($this->result->getFinalAmount(), 2),
            'number_of_years_until_fist_payment' => $this->result->getNumberOfYearsUntilFistPayment(),
            'inflation' => round($this->result->getInflation(), 2),
            'balances_by_period' => $balancesByPeriodView,
        ];
    }

    private function getFailedView(): array
    {
        $view = [
            'error_code' => $this->exception->getCode(),
            'errors' => [],
        ];

        if ($this->exception instanceof SpendCalculator\Exception\InputValidationException) {
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
            case SpendCalculator\Exception\CalculatorException::INPUT_VALIDATION_ERROR:
                return Response::HTTP_BAD_REQUEST;
        }

        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}
