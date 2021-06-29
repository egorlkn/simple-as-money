<?php

declare(strict_types=1);

namespace App\Core\SpendCalculator\Model;

class BalanceByPeriod
{
    private int $indexOfPeriod;

    private float $amount;

    public function __construct(int $indexOfPeriod, float $amount)
    {
        $this->indexOfPeriod = $indexOfPeriod;
        $this->amount = $amount;
    }

    public function getIndexOfPeriod(): int
    {
        return $this->indexOfPeriod;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}
