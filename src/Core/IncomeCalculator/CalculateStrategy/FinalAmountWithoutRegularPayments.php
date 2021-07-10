<?php

declare(strict_types=1);

namespace App\Core\IncomeCalculator\CalculateStrategy;

use App\Core\IncomeCalculator\CalculateStrategyInterface;
use App\Core\IncomeCalculator\Model\Input;
use App\Core\IncomeCalculator\Model\Result;
use App\Core\IncomeCalculator\Exception\CalculatorException;

class FinalAmountWithoutRegularPayments implements CalculateStrategyInterface
{
    public function canHandle(Input $input): bool
    {
        return $input->finalAmountIsUnknown() && ((float)$input->getRegularPayment() === 0.0);
    }

    /**
     * @throws CalculatorException
     */
    public function doCalculation(Input $input): Result
    {
        $PV = (float)$input->getInitialAmount();
        $n = (float)$input->getNumberOfYears();
        $i = (float)$input->getInterestRatePerYear() / 100;

        $finalAmount = $PV * ((1 + $i) ** $n);

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
