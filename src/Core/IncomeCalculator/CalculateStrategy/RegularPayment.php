<?php

declare(strict_types=1);

namespace App\Core\IncomeCalculator\CalculateStrategy;

use App\Core\IncomeCalculator\CalculateStrategyInterface;
use App\Core\IncomeCalculator\Exception\CalculatorException;
use App\Core\IncomeCalculator\Model\Input;
use App\Core\IncomeCalculator\Model\Result;

class RegularPayment implements CalculateStrategyInterface
{
    public function canHandle(Input $input): bool
    {
        return $input->regularPaymentIsUnknown();
    }

    /**
     * @throws CalculatorException
     */
    public function doCalculation(Input $input): Result
    {
        $PV = (float)$input->getInitialAmount();
        $d = (float)$input->getNumberOfRegularPaymentsPerYear();
        $n = (float)$input->getNumberOfYears();
        $i = (float)$input->getInterestRatePerYear() / 100;
        $FV = (float)$input->getFinalAmount();

        $m = $n * $d;

        $j = ((1 + $i) ** (1 / $d)) - 1;

        $regularPayment = ($FV - $PV * ((1 + $j) ** $m)) / ((((1 + $j) ** $m) - 1) / $j);

        if (is_nan($regularPayment) || is_infinite($regularPayment)) {
            throw CalculatorException::wrongCalculation();
        }

        return new Result(
            (float)$input->getInitialAmount(),
            $regularPayment,
            $input->getNumberOfRegularPaymentsPerYear(),
            (int)$input->getNumberOfYears(),
            (float)$input->getInterestRatePerYear(),
            (float)$input->getFinalAmount()
        );
    }
}
