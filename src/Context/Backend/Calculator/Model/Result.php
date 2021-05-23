<?php

declare(strict_types=1);

namespace App\Context\Backend\Calculator\Model;

class Result
{
    private float $initialAmount;

    private float $regularPayment;

    private int $numberOfRegularPaymentsPerYear;

    private int $numberOfYears;

    private float $interestRatePerYear;

    private float $finalAmount;

    public function __construct(
        float $initialAmount,
        float $regularPayment,
        int $numberOfRegularPaymentsPerYear,
        int $numberOfYears,
        float $interestRatePerYear,
        float $finalAmount
    ) {
        $this->initialAmount = $initialAmount;
        $this->regularPayment = $regularPayment;
        $this->numberOfRegularPaymentsPerYear = $numberOfRegularPaymentsPerYear;
        $this->numberOfYears = $numberOfYears;
        $this->interestRatePerYear = $interestRatePerYear;
        $this->finalAmount = $finalAmount;
    }

    public function getInitialAmount(): float
    {
        return $this->initialAmount;
    }

    public function getRegularPayment(): float
    {
        return $this->regularPayment;
    }

    public function getNumberOfRegularPaymentsPerYear(): int
    {
        return $this->numberOfRegularPaymentsPerYear;
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
}
