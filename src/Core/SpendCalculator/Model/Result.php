<?php

declare(strict_types=1);

namespace App\Core\SpendCalculator\Model;

class Result
{
    private float $initialAmount;

    private float $paymentAmount;

    private int $numberOfPaymentsPerYear;

    private float $numberOfYears;

    private float $interestRatePerYear;

    private float $finalAmount;

    private float $numberOfYearsUntilFistPayment;

    private float $inflation;

    public function __construct(
        float $initialAmount,
        float $paymentAmount,
        int $numberOfPaymentsPerYear,
        float $numberOfYears,
        float $interestRatePerYear,
        float $finalAmount,
        float $numberOfYearsUntilFistPayment,
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

    public function getNumberOfYears(): float
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

    public function getNumberOfYearsUntilFistPayment(): float
    {
        return $this->numberOfYearsUntilFistPayment;
    }

    public function getInflation(): float
    {
        return $this->inflation;
    }
}
