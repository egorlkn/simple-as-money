<?php

declare(strict_types=1);

namespace App\Core\IncomeCalculator\CalculateStrategy;

use App\Core\IncomeCalculator\CalculateStrategyInterface;
use App\Core\IncomeCalculator\Exception\CalculatorException;
use App\Core\IncomeCalculator\Model\Input;
use App\Core\IncomeCalculator\Model\Result;

class InitialAmountWithoutRegularPayments implements CalculateStrategyInterface
{
    public function canHandle(Input $input): bool
    {
        return $input->initialAmountIsUnknown() && ((float)$input->getRegularPayment() === 0.0);
    }

    /**
     * @throws CalculatorException
     */
    public function doCalculation(Input $input): Result
    {
        $n = (float)$input->getNumberOfYears();
        $i = (float)$input->getInterestRatePerYear() / 100;
        $FV = (float)$input->getFinalAmount();

        $initialAmount = $FV / ((1 + $i) ** $n);

        if (is_nan($initialAmount) || is_infinite($initialAmount)) {
            throw CalculatorException::wrongCalculation();
        }

        return new Result(
            $initialAmount,
            (float)$input->getRegularPayment(),
            $input->getNumberOfRegularPaymentsPerYear(),
            (int)$input->getNumberOfYears(),
            (float)$input->getInterestRatePerYear(),
            (float)$input->getFinalAmount()
        );
    }
}
