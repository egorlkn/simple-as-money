<?php

declare(strict_types=1);

namespace App\Context\Backend\IncomeCalculator\CalculateStrategy;

use App\Context\Backend\IncomeCalculator\CalculateStrategyInterface;
use App\Context\Backend\IncomeCalculator\Exception\CalculatorException;
use App\Context\Backend\IncomeCalculator\Model\Input;
use App\Context\Backend\IncomeCalculator\Model\Result;

class InterestRatePerYearWithRegularPayments implements CalculateStrategyInterface
{
    public function canHandle(Input $input): bool
    {
        return $input->interestRatePerYearIsUnknown() && ((float)$input->getRegularPayment() > 0.0);
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
        $FV = (float)$input->getFinalAmount();

        $m = $n * $d;

        $jUpInterest = 0.0;
        $startTime = time();

        while (true) {
            $runningTime = time() - $startTime;

            if ($runningTime > 10) {
                throw CalculatorException::wrongCalculation();
            }

            $jUpInterest = round($jUpInterest + 0.001, 3);
            $jUp = $jUpInterest / 100;

            if ($this->isSolvingEquation($PV, $A, $FV, $m, $jUp)) {
                $j = $jUp;
                break;
            }
        }

        $interestRatePerYear = (((1 + $j) ** $d) - 1) * 100;

        return new Result(
            (float)$input->getInitialAmount(),
            (float)$input->getRegularPayment(),
            $input->getNumberOfRegularPaymentsPerYear(),
            (float)$input->getNumberOfYears(),
            $interestRatePerYear,
            (float)$input->getFinalAmount()
        );
    }

    public function isSolvingEquation(
        float $PV,
        float $A,
        float $FV,
        float $m,
        float $j
    ): bool {
        $a1 = $PV * ((1 + $j) ** $m);
        $a2 = ((1 + $j) ** $m) - 1;
        $a3 = $a2 / $j;
        $a4 = $a3 * $A;
        $calcFV = $a1 + $a4;

        return $calcFV >= ($FV * 0.9998) && $calcFV <= ($FV * 1.0002);
    }
}
