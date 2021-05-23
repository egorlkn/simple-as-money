<?php

declare(strict_types=1);

namespace App\Context\Backend\Calculator\CalculateStrategy;

use App\Context\Backend\Calculator\CalculateStrategyInterface;
use App\Context\Backend\Calculator\Model\Input;
use App\Context\Backend\Calculator\Model\Result;

class FinalAmountWithRegularPayments implements CalculateStrategyInterface
{
    public function canHandle(Input $input): bool
    {
        return $input->finalAmountIsUnknown() && ((float)$input->getRegularPayment() > 0.0);
    }

    public function doCalculation(Input $input): Result
    {
        return new Result(get_class($this));
    }
}
