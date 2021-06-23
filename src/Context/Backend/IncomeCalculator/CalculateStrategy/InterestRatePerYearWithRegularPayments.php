<?php

declare(strict_types=1);

namespace App\Context\Backend\IncomeCalculator\CalculateStrategy;

use App\Context\Backend\IncomeCalculator\CalculateStrategyInterface;
use App\Context\Backend\IncomeCalculator\Model\Input;
use App\Context\Backend\IncomeCalculator\Model\Result;

class InterestRatePerYearWithRegularPayments implements CalculateStrategyInterface
{
    public function canHandle(Input $input): bool
    {
        return $input->interestRatePerYearIsUnknown() && ((float)$input->getRegularPayment() > 0.0);
    }

    public function doCalculation(Input $input): Result
    {
        $PV = (float)$input->getInitialAmount();
        $A = (float)$input->getRegularPayment();
        $d = (float)$input->getNumberOfRegularPaymentsPerYear();
        $n = (float)$input->getNumberOfYears();
        $FV = (float)$input->getFinalAmount();

        $m = $n * $d;

        $jUpInterest = 0.0;
        $jDownInterest = 0.0;

        while (true) {
            $jUpInterest = round($jUpInterest + 0.001, 3);
            $jUp = $jUpInterest / 100;

            if ($this->isSolvingEquation($PV, $A, $FV, $m, $jUp)) {
                $j = $jUp;
                break;
            }

//            $jDownInterest = round($jDownInterest - 0.01, 2);
//            $jDown = $jDownInterest / 100;
//
//            if ($this->isSolvingEquation($PV, $A, $FV, $m, $jDown)) {
//                $j = $jDown;
//                break;
//            }
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
