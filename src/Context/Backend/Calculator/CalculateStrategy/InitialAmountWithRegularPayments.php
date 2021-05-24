<?php

declare(strict_types=1);

namespace App\Context\Backend\Calculator\CalculateStrategy;

use App\Context\Backend\Calculator\CalculateStrategyInterface;
use App\Context\Backend\Calculator\Model\Input;
use App\Context\Backend\Calculator\Model\Result;

class InitialAmountWithRegularPayments implements CalculateStrategyInterface
{
    public function canHandle(Input $input): bool
    {
        return $input->initialAmountIsUnknown() && ((float)$input->getRegularPayment() > 0.0);
    }

    public function doCalculation(Input $input): Result
    {
        $A = (float)$input->getRegularPayment();
        $d = (float)$input->getNumberOfRegularPaymentsPerYear();
        $n = (float)$input->getNumberOfYears();
        $i = (float)$input->getInterestRatePerYear() / 100;
        $FV = (float)$input->getFinalAmount();

        $m = $n * $d;

        $j = ((1 + $i) ** (1 / $m)) - 1;

        $initialAmount = ($FV - $A * ((((1 + $j) ** $m) - 1) / $j)) / ((1 + $j) ** $m);

        return new Result(
            round($initialAmount, 2),
            (float)$input->getRegularPayment(),
            $input->getNumberOfRegularPaymentsPerYear(),
            (float)$input->getNumberOfYears(),
            (float)$input->getInterestRatePerYear(),
            (float)$input->getFinalAmount()
        );
    }
}
