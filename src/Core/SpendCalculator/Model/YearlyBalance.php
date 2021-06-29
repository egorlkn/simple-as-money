<?php

declare(strict_types=1);

namespace App\Core\SpendCalculator\Model;

class YearlyBalance
{
    private int $numberOfYear;

    private float $amount;

    public function __construct(int $numberOfYear, float $amount)
    {
        $this->numberOfYear = $numberOfYear;
        $this->amount = $amount;
    }

    public function getNumberOfYear(): int
    {
        return $this->numberOfYear;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}
