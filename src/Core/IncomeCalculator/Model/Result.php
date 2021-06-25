<?php

declare(strict_types=1);

namespace App\Core\IncomeCalculator\Model;

class Result
{
    private float $initialAmount;

    private float $regularPayment;

    private int $numberOfRegularPaymentsPerYear;

    private float $numberOfYears;

    private float $interestRatePerYear;

    private float $finalAmount;

    private ?YearlyBalanceCollection $yearlyBalances = null;

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

    public function getYearlyBalanceCollection(): YearlyBalanceCollection
    {
        if ($this->yearlyBalances instanceof YearlyBalanceCollection) {
            return $this->yearlyBalances;
        }

        $this->yearlyBalances = $this->calcYearlyBalances();

        return $this->yearlyBalances;
    }

    private function calcYearlyBalances(): YearlyBalanceCollection
    {
        $results = [];

        $numberOfYears = $leaveNumberOfYears = $this->getNumberOfYears();
        $numberOfRegularPaymentsPerYear = $this->getNumberOfRegularPaymentsPerYear();
        $regularPayment = $this->getRegularPayment();
        $initialAmount = $this->getInitialAmount();
        $ratePerYear = $this->getInterestRatePerYear() / 100;
        $commonFinalAmount = $this->getFinalAmount();

        for ($i = 1.0; $i <= ceil($numberOfYears); $i++) {
            $leaveNumberOfYears -= 1.0;

            if ($leaveNumberOfYears <= 0.0) {
                $results[] = new YearlyBalance((int)$i, $commonFinalAmount);

                break;
            }

            if ($numberOfRegularPaymentsPerYear === 0) {
                $finalAmount = $initialAmount * ((1 + $ratePerYear) ** 1.0);
            } else {
                $m = 1.0 * $numberOfRegularPaymentsPerYear;
                $j = ((1 + $ratePerYear) ** (1 / $numberOfRegularPaymentsPerYear)) - 1;
                $finalAmount = $initialAmount * ((1 + $j) ** $m) + $regularPayment * ((((1 + $j) ** $m) - 1) / $j);
            }

            $results[] = new YearlyBalance((int)$i, $finalAmount);

            $initialAmount = $finalAmount;
        }

        return new YearlyBalanceCollection($results);
    }
}
