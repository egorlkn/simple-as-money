<?php

declare(strict_types=1);

namespace App\Context\Backend\Calculator\CalculateStrategy;

use App\Context\Backend\Calculator\CalculateStrategyInterface;
use App\Context\Backend\Calculator\Model\Input;
use App\Context\Backend\Calculator\Model\Result;

class RegularPayment implements CalculateStrategyInterface
{
    public function canHandle(Input $input): bool
    {
        return $input->regularPaymentIsUnknown();
    }

    public function doCalculation(Input $input): Result
    {
        return new Result(get_class($this));
    }
}
