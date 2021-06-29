<?php

declare(strict_types=1);

namespace App\Core\SpendCalculator\Model;

use ArrayIterator;
use Webmozart\Assert\Assert;

class BalanceByPeriodCollection extends ArrayIterator
{
    public function __construct($yearlyBalanceList = array())
    {
        Assert::allIsInstanceOf($yearlyBalanceList, BalanceByPeriod::class);

        parent::__construct($yearlyBalanceList);
    }
}
