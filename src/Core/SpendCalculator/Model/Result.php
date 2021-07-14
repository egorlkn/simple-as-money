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

    private ?BalanceByPeriodCollection $balancesByPeriod = null;

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

    public function getBalancesByPeriod(): BalanceByPeriodCollection
    {
        if ($this->balancesByPeriod instanceof BalanceByPeriodCollection) {
            return $this->balancesByPeriod;
        }

        $this->balancesByPeriod = $this->calcBalancesByPeriod();

        return $this->balancesByPeriod;
    }

    private function calcBalancesByPeriod(): BalanceByPeriodCollection
    {
        $list = [];

        $PV = $this->getInitialAmount();
        $H = $this->getPaymentAmount();
        $x = $this->getNumberOfPaymentsPerYear();
        $n = $this->getNumberOfYears();
        $s = $this->getInterestRatePerYear() / 100;
        $FV = $this->getFinalAmount();
        $z = $this->getNumberOfYearsUntilFistPayment();
        $k = $this->getInflation() / 100;

        $Kp = ((1 + $k) ** (1 / $x)) - 1;
        $Sp = ((1 + $s) ** (1 / $x)) - 1;

        $Hkp = $H * ((1 + $Kp) ** ($z * $x));

        for ($i = 1; $i <= ($n * $x); $i++) {
            if ($i > 1) {
                $PV *= (1 + $Sp);
                $Hkp *= (1 + $Kp);
            }

            $list[] = new BalanceByPeriod($i, $PV);

            $PV -= $Hkp;
        }

        $list[] = new BalanceByPeriod($i, $FV);

        return new BalanceByPeriodCollection($list);
    }
}
