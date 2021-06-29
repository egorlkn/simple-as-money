<?php

declare(strict_types=1);

namespace App\Core\SpendCalculator\Model;

class Input
{
    private ?float $initialAmount;

    private ?float $paymentAmount;

    private int $numberOfPaymentsPerYear;

    private ?float $numberOfYears;

    private ?float $interestRatePerYear;

    private ?float $finalAmount;

    private float $numberOfYearsUntilFistPayment;

    private float $inflation;

    private bool $initialAmountIsUnknown;
    private bool $paymentAmountIsUnknown;
    private bool $numberOfYearsIsUnknown;
    private bool $interestRatePerYearIsUnknown;
    private bool $finalAmountIsUnknown;

    public function __construct(
        ?float $initialAmount,
        ?float $paymentAmount,
        int $numberOfPaymentsPerYear,
        ?float $numberOfYears,
        ?float $interestRatePerYear,
        ?float $finalAmount,
        float $numberOfYearsUntilFistPayment,
        float $inflation,
        bool $initialAmountIsUnknown,
        bool $paymentAmountIsUnknown,
        bool $numberOfYearsIsUnknown,
        bool $interestRatePerYearIsUnknown,
        bool $finalAmountIsUnknown
    ) {
        $this->initialAmount = $initialAmount;
        $this->paymentAmount = $paymentAmount;
        $this->numberOfPaymentsPerYear = $numberOfPaymentsPerYear;
        $this->numberOfYears = $numberOfYears;
        $this->interestRatePerYear = $interestRatePerYear;
        $this->finalAmount = $finalAmount;
        $this->numberOfYearsUntilFistPayment = $numberOfYearsUntilFistPayment;
        $this->inflation = $inflation;
        $this->initialAmountIsUnknown = $initialAmountIsUnknown;
        $this->paymentAmountIsUnknown = $paymentAmountIsUnknown;
        $this->numberOfYearsIsUnknown = $numberOfYearsIsUnknown;
        $this->interestRatePerYearIsUnknown = $interestRatePerYearIsUnknown;
        $this->finalAmountIsUnknown = $finalAmountIsUnknown;
    }

    public function getInitialAmount(): ?float
    {
        if ($this->initialAmountIsUnknown()) {
            return null;
        }

        return $this->initialAmount;
    }

    public function getPaymentAmount(): ?float
    {
        if ($this->paymentAmountIsUnknown()) {
            return null;
        }

        return $this->paymentAmount;
    }

    public function getNumberOfPaymentsPerYear(): int
    {
        return $this->numberOfPaymentsPerYear;
    }

    public function getNumberOfYears(): ?float
    {
        if ($this->numberOfYearsIsUnknown()) {
            return null;
        }

        return $this->numberOfYears;
    }

    public function getInterestRatePerYear(): ?float
    {
        if ($this->interestRatePerYearIsUnknown()) {
            return null;
        }

        return $this->interestRatePerYear;
    }

    public function getFinalAmount(): ?float
    {
        if ($this->finalAmountIsUnknown()) {
            return null;
        }

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

    public function initialAmountIsUnknown(): bool
    {
        return $this->initialAmountIsUnknown;
    }

    public function paymentAmountIsUnknown(): bool
    {
        return $this->paymentAmountIsUnknown;
    }

    public function numberOfYearsIsUnknown(): bool
    {
        return $this->numberOfYearsIsUnknown;
    }

    public function interestRatePerYearIsUnknown(): bool
    {
        return $this->interestRatePerYearIsUnknown;
    }

    public function finalAmountIsUnknown(): bool
    {
        return $this->finalAmountIsUnknown;
    }
}
