<?php

declare(strict_types=1);

namespace App\Core\SpendCalculator\Model;

class Result
{
    private float $initialAmount;

    private float $paymentAmount;

    private int $numberOfPaymentsPerYear;

    private int $numberOfYears;

    private float $interestRatePerYear;

    private float $finalAmount;

    private int $numberOfYearsUntilFistPayment;

    private float $inflation;

    public function __construct(
        float $initialAmount,
        float $paymentAmount,
        int $numberOfPaymentsPerYear,
        int $numberOfYears,
        float $interestRatePerYear,
        float $finalAmount,
        int $numberOfYearsUntilFistPayment,
        float $inflation
    ) {
        $this->initialAmount = $initialAmount;
        $this->paymentAmount = $paymentAmount;
        $this->numberOfPaymentsPerYear = $numberOfPaymentsPerYear;
        $this->numberOfYears = $numberOfYears;
        $this->interestRatePerYear = $interestRatePerYear;
        $this->finalAmount = $finalAmount;
        $this->numberOfYearsUntilFistPayment = $numberOfYearsUntilFistPayment;
        $this->inflation = $inflation;
    }

    public function getInitialAmount(): float
    {
        return $this->initialAmount;
    }

    public function getPaymentAmount(): float
    {
        return $this->paymentAmount;
    }

    public function getNumberOfPaymentsPerYear(): int
    {
        return $this->numberOfPaymentsPerYear;
    }

    public function getNumberOfYears(): int
    {
        return $this->numberOfYears;
    }

    public function getInterestRatePerYear(): float
    {
        return $this->interestRatePerYear;
    }

    public function getFinalAmount(): float
    {
        return $this->finalAmount;
    }

    public function getNumberOfYearsUntilFistPayment(): int
    {
        return $this->numberOfYearsUntilFistPayment;
    }

    public function getInflation(): float
    {
        return $this->inflation;
    }
}
