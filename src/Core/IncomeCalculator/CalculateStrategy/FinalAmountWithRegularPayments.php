<?php

declare(strict_types=1);

namespace App\Core\IncomeCalculator\CalculateStrategy;

use App\Core\IncomeCalculator\CalculateStrategyInterface;
use App\Core\IncomeCalculator\Exception\CalculatorException;
use App\Core\IncomeCalculator\Model\Input;
use App\Core\IncomeCalculator\Model\Result;

class FinalAmountWithRegularPayments implements CalculateStrategyInterface
{
    public function canHandle(Input $input): bool
    {
        return $input->finalAmountIsUnknown() && ((float)$input->getRegularPayment() > 0.0);
    }

    /**
     * @throws CalculatorException
     */
    public function doCalculation(Input $input): Result
    {
        $PV = (float)$input->getInitialAmount();
        $A = (float)$input->getRegularPayment();
        $d = (float)$input->getNumberOfRegularPaymentsPerYear();
        $n = (float)$input->getNumberOfYears();
        $i = (float)$input->getInterestRatePerYear() / 100;

        $m = $n * $d;

        $j = ((1 + $i) ** (1 / $d)) - 1;

        $finalAmount = $PV * ((1 + $j) ** $m) + $A * ((((1 + $j) ** $m) - 1) / $j);

        if (is_nan($finalAmount) || is_infinite($finalAmount)) {
            throw CalculatorException::wrongCalculation();
        }

        return new Result(
            (float)$input->getInitialAmount(),
            (float)$input->getRegularPayment(),
            $input->getNumberOfRegularPaymentsPerYear(),
            (int)$input->getNumberOfYears(),
            (float)$input->getInterestRatePerYear(),
            $finalAmount
        );
    }
}
