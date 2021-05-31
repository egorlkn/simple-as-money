<?php

declare(strict_types=1);

namespace App\Context\Backend\Calculator\CalculateStrategy;

use App\Context\Backend\Calculator\CalculateStrategyInterface;
use App\Context\Backend\Calculator\Model\Input;
use App\Context\Backend\Calculator\Model\CommonResult;

class InterestRatePerYearWithRegularPayments implements CalculateStrategyInterface
{
    public function canHandle(Input $input): bool
    {
        return $input->interestRatePerYearIsUnknown() && ((float)$input->getRegularPayment() > 0.0);
    }

    public function doCalculation(Input $input): CommonResult
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
            $jUpInterest = round($jUpInterest + 0.01, 2);
            $jUp = $jUpInterest / 100;

            if ($this->isSolvingEquation($PV, $A, $FV, $m, $jUp)) {
                $j = $jUp;
                break;
            }

            $jDownInterest = round($jDownInterest - 0.01, 2);
            $jDown = $jDownInterest / 100;

            if ($this->isSolvingEquation($PV, $A, $FV, $m, $jDown)) {
                $j = $jDown;
                break;
            }
        }

        $interestRatePerYear = (((1 + $j) ** $m) - 1) * 100;

        return new CommonResult(
            (float)$input->getInitialAmount(),
            (float)$input->getRegularPayment(),
            $input->getNumberOfRegularPaymentsPerYear(),
            (float)$input->getNumberOfYears(),
            round($interestRatePerYear, 2),
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
        $leftA = $FV * $j + $A;
        $leftB = $PV * $j + $A;

        if ((int)$leftB === 0) {
            return false;
        }

        $leftSubEquation = round($leftA / $leftB, 2);

        $rightSubEquation = round((1 + $j) ** $m, 2);

        return $leftSubEquation === $rightSubEquation;
    }
}
