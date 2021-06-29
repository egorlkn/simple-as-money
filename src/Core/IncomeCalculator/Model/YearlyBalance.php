<?php

declare(strict_types=1);

namespace App\Core\IncomeCalculator\Model;

class YearlyBalance
{
    private int $indexOfYear;

    private float $amount;

    public function __construct(int $indexOfYear, float $amount)
    {
        $this->indexOfYear = $indexOfYear;
        $this->amount = $amount;
    }

    public function getIndexOfYear(): int
    {
        return $this->indexOfYear;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}
