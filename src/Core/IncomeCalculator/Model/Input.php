<?php

declare(strict_types=1);

namespace App\Core\IncomeCalculator\Model;

class Input
{
    private ?float $initialAmount;

    private ?float $regularPayment;

    private int $numberOfRegularPaymentsPerYear;

    private ?int $numberOfYears;

    private ?float $interestRatePerYear;

    private ?float $finalAmount;

    private bool $initialAmountIsUnknown;
    private bool $regularPaymentIsUnknown;
    private bool $numberOfYearsIsUnknown;
    private bool $interestRatePerYearIsUnknown;
    private bool $finalAmountIsUnknown;

    public function __construct(
        ?float $initialAmount,
        ?float $regularPayment,
        int $numberOfRegularPaymentsPerYear,
        ?int $numberOfYears,
        ?float $interestRatePerYear,
        ?float $finalAmount,
        bool $initialAmountIsUnknown,
        bool $regularPaymentIsUnknown,
        bool $numberOfYearsIsUnknown,
        bool $interestRatePerYearIsUnknown,
        bool $finalAmountIsUnknown
    ) {
        $this->initialAmount = $initialAmount;
        $this->regularPayment = $regularPayment;
        $this->numberOfRegularPaymentsPerYear = $numberOfRegularPaymentsPerYear;
        $this->numberOfYears = $numberOfYears;
        $this->interestRatePerYear = $interestRatePerYear;
        $this->finalAmount = $finalAmount;
        $this->initialAmountIsUnknown = $initialAmountIsUnknown;
        $this->regularPaymentIsUnknown = $regularPaymentIsUnknown;
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

    public function getRegularPayment(): ?float
    {
        if ($this->regularPaymentIsUnknown()) {
            return null;
        }

        return $this->regularPayment;
    }

    public function getNumberOfRegularPaymentsPerYear(): int
    {
        return $this->numberOfRegularPaymentsPerYear;
    }

    public function getNumberOfYears(): ?int
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

    public function initialAmountIsUnknown(): bool
    {
        return $this->initialAmountIsUnknown;
    }

    public function regularPaymentIsUnknown(): bool
    {
        return $this->regularPaymentIsUnknown;
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
