<?php

declare(strict_types=1);

namespace App\Core\IncomeCalculator\CalculateStrategy;

use App\Core\IncomeCalculator\CalculateStrategyInterface;
use App\Core\IncomeCalculator\Model\Input;
use App\Core\IncomeCalculator\Model\Result;

class InterestRatePerYearWithoutRegularPayments implements CalculateStrategyInterface
{
    public function canHandle(Input $input): bool
    {
        return $input->interestRatePerYearIsUnknown() && ((float)$input->getRegularPayment() === 0.0);
    }

    public function doCalculation(Input $input): Result
    {
        $PV = (float)$input->getInitialAmount();
        $n = (float)$input->getNumberOfYears();
        $FV = (float)$input->getFinalAmount();

        $interestRatePerYear = ((($FV / $PV) ** (1 / $n)) - 1) * 100;

        return new Result(
            (float)$input->getInitialAmount(),
            (float)$input->getRegularPayment(),
            $input->getNumberOfRegularPaymentsPerYear(),
            (int)$input->getNumberOfYears(),
            $interestRatePerYear,
            (float)$input->getFinalAmount()
        );
    }
}
