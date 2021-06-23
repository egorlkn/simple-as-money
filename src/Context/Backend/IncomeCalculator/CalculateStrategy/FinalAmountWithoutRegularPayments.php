<?php

declare(strict_types=1);

namespace App\Context\Backend\IncomeCalculator\CalculateStrategy;

use App\Context\Backend\IncomeCalculator\CalculateStrategyInterface;
use App\Context\Backend\IncomeCalculator\Model\Input;
use App\Context\Backend\IncomeCalculator\Model\Result;

class FinalAmountWithoutRegularPayments implements CalculateStrategyInterface
{
    public function canHandle(Input $input): bool
    {
        return $input->finalAmountIsUnknown() && ((float)$input->getRegularPayment() === 0.0);
    }

    public function doCalculation(Input $input): Result
    {
        $PV = (float)$input->getInitialAmount();
        $n = (float)$input->getNumberOfYears();
        $i = (float)$input->getInterestRatePerYear() / 100;

        $finalAmount = $PV * ((1 + $i) ** $n);

        return new Result(
            (float)$input->getInitialAmount(),
            (float)$input->getRegularPayment(),
            $input->getNumberOfRegularPaymentsPerYear(),
            (float)$input->getNumberOfYears(),
            (float)$input->getInterestRatePerYear(),
            $finalAmount
        );
    }
}
