<?php

declare(strict_types=1);

namespace App\Context\Backend\IncomeCalculator\Model;

class YearlyIncome
{
    private int $numberOfYear;

    private float $finalAmount;

    public function __construct(int $numberOfYear, float $finalAmount)
    {
        $this->numberOfYear = $numberOfYear;
        $this->finalAmount = $finalAmount;
    }

    public function getNumberOfYear(): int
    {
        return $this->numberOfYear;
    }

    public function getFinalAmount(): float
    {
        return $this->finalAmount;
    }
}
