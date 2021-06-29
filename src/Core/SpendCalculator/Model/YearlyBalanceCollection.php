<?php

declare(strict_types=1);

namespace App\Core\SpendCalculator\Model;

use ArrayIterator;
use Webmozart\Assert\Assert;

/**
 * @method YearlyBalance[] getIterator()
 */
class YearlyBalanceCollection extends ArrayIterator
{
    public function __construct($yearlyBalanceList = array())
    {
        Assert::allIsInstanceOf($yearlyBalanceList, YearlyBalance::class);

        parent::__construct($yearlyBalanceList);
    }
}
