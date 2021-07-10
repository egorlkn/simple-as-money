<?php

declare(strict_types=1);

namespace App\Core\IncomeCalculator\CalculateStrategy;

use App\Core\IncomeCalculator\CalculateStrategyInterface;
use App\Core\IncomeCalculator\Exception\CalculatorException;
use App\Core\IncomeCalculator\Model\Input;
use App\Core\IncomeCalculator\Model\Result;

class NumberOfYearsWithoutRegularPayments implements CalculateStrategyInterface
{
    public function canHandle(Input $input): bool
    {
        return $input->numberOfYearsIsUnknown() && ((float)$input->getRegularPayment() === 0.0);
    }

    /**
     * @throws CalculatorException
     */
    public function doCalculation(Input $input): Result
    {
        $PV = (float)$input->getInitialAmount();
        $i = (float)$input->getInterestRatePerYear() / 100;
        $FV = (float)$input->getFinalAmount();

        $numberOfYears = (int)ceil(log($FV / $PV, 1 + $i));

        if ($numberOfYears <= 0) {
            $numberOfYears = 0;
            $finalAmount = $PV;
        } else {
            $finalAmount = $PV * ((1 + $i) ** $numberOfYears);
        }

        if (
            is_nan($numberOfYears) ||
            is_nan($finalAmount) ||
            is_infinite($numberOfYears) ||
            is_infinite($finalAmount)
        ) {
            throw CalculatorException::wrongCalculation();
        }

        return new Result(
            (float)$input->getInitialAmount(),
            (float)$input->getRegularPayment(),
            $input->getNumberOfRegularPaymentsPerYear(),
            $numberOfYears,
            (float)$input->getInterestRatePerYear(),
            $finalAmount
        );
    }
}
