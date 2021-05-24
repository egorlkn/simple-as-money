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
        $PV = (float)$input->getInitialAmount();
        $d = (float)$input->getNumberOfRegularPaymentsPerYear();
        $n = (float)$input->getNumberOfYears();
        $i = (float)$input->getInterestRatePerYear() / 100;
        $FV = (float)$input->getFinalAmount();

        $m = $n * $d;

        $j = ((1 + $i) ** (1 / $m)) - 1;

        $regularPayment = ($FV - $PV * ((1 + $j) ** $m)) / ((((1 + $j) ** $m) - 1) / $j);

        return new Result(
            (float)$input->getInitialAmount(),
            round($regularPayment, 2),
            $input->getNumberOfRegularPaymentsPerYear(),
            (float)$input->getNumberOfYears(),
            (float)$input->getInterestRatePerYear(),
            (float)$input->getFinalAmount()
        );
    }
}
