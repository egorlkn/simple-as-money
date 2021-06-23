<?php

declare(strict_types=1);

namespace App\Context\Backend\IncomeCalculator\Model;

use ArrayIterator;
use Webmozart\Assert\Assert;

/**
 * @method YearlyIncome[] getIterator()
 */
class YearlyIncomeCollection extends ArrayIterator
{
    public function __construct($yearlyIncomeList = array())
    {
        Assert::allIsInstanceOf($yearlyIncomeList, YearlyIncome::class);

        parent::__construct($yearlyIncomeList);
    }
}
