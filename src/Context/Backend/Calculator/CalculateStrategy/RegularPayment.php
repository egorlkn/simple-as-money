<?php

declare(strict_types=1);

namespace App\Context\Backend\Calculator\CalculateStrategy;

use App\Context\Backend\Calculator\CalculateStrategyInterface;
use App\Context\Backend\Calculator\Model\Input;
use App\Context\Backend\Calculator\Model\CommonResult;

class RegularPayment implements CalculateStrategyInterface
{
    public function canHandle(Input $input): bool
    {
        return $input->regularPaymentIsUnknown();
    }

    public function doCalculation(Input $input): CommonResult
    {
        $PV = (float)$input->getInitialAmount();
        $d = (float)$input->getNumberOfRegularPaymentsPerYear();
        $n = (float)$input->getNumberOfYears();
        $i = (float)$input->getInterestRatePerYear() / 100;
        $FV = (float)$input->getFinalAmount();

        $m = $n * $d;

        $j = ((1 + $i) ** (1 / $d)) - 1;

        $regularPayment = ($FV - $PV * ((1 + $j) ** $m)) / ((((1 + $j) ** $m) - 1) / $j);

        return new CommonResult(
            (float)$input->getInitialAmount(),
            $regularPayment,
            $input->getNumberOfRegularPaymentsPerYear(),
            (float)$input->getNumberOfYears(),
            (float)$input->getInterestRatePerYear(),
            (float)$input->getFinalAmount()
        );
    }
}
