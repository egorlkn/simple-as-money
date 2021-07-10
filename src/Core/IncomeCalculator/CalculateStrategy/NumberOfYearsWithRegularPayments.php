<?php

declare(strict_types=1);

namespace App\Core\IncomeCalculator\CalculateStrategy;

use App\Core\IncomeCalculator\CalculateStrategyInterface;
use App\Core\IncomeCalculator\Exception\CalculatorException;
use App\Core\IncomeCalculator\Model\Input;
use App\Core\IncomeCalculator\Model\Result;

class NumberOfYearsWithRegularPayments implements CalculateStrategyInterface
{
    public function canHandle(Input $input): bool
    {
        return $input->numberOfYearsIsUnknown() && ((float)$input->getRegularPayment() > 0.0);
    }

    /**
     * @throws CalculatorException
     */
    public function doCalculation(Input $input): Result
    {
        $PV = (float)$input->getInitialAmount();
        $A = (float)$input->getRegularPayment();
        $d = (float)$input->getNumberOfRegularPaymentsPerYear();
        $i = (float)$input->getInterestRatePerYear() / 100;
        $FV = (float)$input->getFinalAmount();

        $j = ((1 + $i) ** (1 / $d)) - 1;

        $m = log(($FV * $j + $A) / ($PV * $j + $A), 1 + $j);

        $numberOfYears = (int)ceil($m / $d);

        $mNew = $numberOfYears * $d;

        $finalAmount = ($PV * ((1 + $j) ** $mNew)) + ($A * ((((1 + $j) ** $mNew) - 1) / $j));

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
