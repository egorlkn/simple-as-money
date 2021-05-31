<?php

declare(strict_types=1);

namespace App\Context\Backend\Calculator\Model;

class CommonResult
{
    private float $initialAmount;

    private float $regularPayment;

    private int $numberOfRegularPaymentsPerYear;

    private float $numberOfYears;

    private float $interestRatePerYear;

    private float $finalAmount;

    private ?YearlyResultCollection $yearlyResults = null;

    public function __construct(
        float $initialAmount,
        float $regularPayment,
        int $numberOfRegularPaymentsPerYear,
        float $numberOfYears,
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

    public function getYearlyResults(): YearlyResultCollection
    {
        if ($this->yearlyResults instanceof YearlyResultCollection) {
            return $this->yearlyResults;
        }

        $this->yearlyResults = $this->buildYearlyResults();

        return $this->yearlyResults;
    }

    private function buildYearlyResults(): YearlyResultCollection
    {
        $results = [];
        $numberOfYears = $leaveNumberOfYears = $this->getNumberOfYears();
        $numberOfRegularPaymentsPerYear = $this->getNumberOfRegularPaymentsPerYear();
        $regularPayment = $this->getRegularPayment();
        $initialAmount = $this->getInitialAmount();
        $ratePerYear = $this->getInterestRatePerYear() / 100;

        for ($i = 1.0; $i <= ceil($numberOfYears); $i++) {
            $leaveNumberOfYears -= 1.0;

            if ($leaveNumberOfYears > 0.0) {
                $n = 1.0;
            } else {
                $n = $leaveNumberOfYears + 1.0;
            }

            if ($numberOfRegularPaymentsPerYear === 0) {
                $finalAmount = $initialAmount * ((1 + $ratePerYear) ** $n);
            } else {
                $m = $n * $numberOfRegularPaymentsPerYear;
                $j = ((1 + $ratePerYear) ** (1 / $m)) - 1;
                $finalAmount = $initialAmount * ((1 + $j) ** $m) + $regularPayment * (((1 + $j) ** $m) - 1 / $j);
            }

            $results[] = new YearlyResult(
                (int)$i,
                round($finalAmount, 2)
            );

            $initialAmount = $finalAmount;
        }

        return new YearlyResultCollection($results);
    }
}
