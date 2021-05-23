<?php

declare(strict_types=1);

namespace App\Context\Backend\Calculator\CalculateStrategy;

use App\Context\Backend\Calculator\CalculateStrategyInterface;
use App\Context\Backend\Calculator\Model\Input;
use App\Context\Backend\Calculator\Model\Result;

class InitialAmountWithoutRegularPayments implements CalculateStrategyInterface
{
    public function canHandle(Input $input): bool
    {
        return $input->initialAmountIsUnknown() && ((float)$input->getRegularPayment() === 0.0);
    }

    public function doCalculation(Input $input): Result
    {
        $n = (float)$input->getNumberOfYears();
        $i = (float)$input->getInterestRatePerYear() / 100;
        $FV = (float)$input->getFinalAmount();

        $initialAmount = $FV / ((1 + $i) ** $n);

        return new Result(
            round($initialAmount, 2),
            (float)$input->getRegularPayment(),
            $input->getNumberOfRegularPaymentsPerYear(),
            (int)$input->getNumberOfYears(),
            (float)$input->getInterestRatePerYear(),
            (float)$input->getFinalAmount()
        );
    }
}
