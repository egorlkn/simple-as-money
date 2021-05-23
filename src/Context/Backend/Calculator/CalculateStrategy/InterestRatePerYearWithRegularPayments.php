<?php

declare(strict_types=1);

namespace App\Context\Backend\Calculator\CalculateStrategy;

use App\Context\Backend\Calculator\CalculateStrategyInterface;
use App\Context\Backend\Calculator\Model\Input;
use App\Context\Backend\Calculator\Model\Result;

class InterestRatePerYearWithRegularPayments implements CalculateStrategyInterface
{
    public function canHandle(Input $input): bool
    {
        return $input->interestRatePerYearIsUnknown() && ((float)$input->getRegularPayment() > 0.0);
    }

    public function doCalculation(Input $input): Result
    {
        return new Result(
            (float)$input->getInitialAmount(),
            (float)$input->getRegularPayment(),
            $input->getNumberOfRegularPaymentsPerYear(),
            (int)$input->getNumberOfYears(),
            0.0,
            (float)$input->getFinalAmount()
        );

        $PV = (float)$input->getInitialAmount();
        $A = (float)$input->getRegularPayment();
        $d = (float)$input->getNumberOfRegularPaymentsPerYear();
        $n = (float)$input->getNumberOfYears();
        $FV = (float)$input->getFinalAmount();

        $m = $n * $d;

        $jUp = 0.0;
        $jDown = 0.0;

        while (true) {
            $jUp += 0.01;
            $jDown -= 0.01;

            if ($this->isSolvingEquation($PV, $A, $FV, $m, $jUp)) {
                $j = $jUp;
                break;
            }

            if ($this->isSolvingEquation($PV, $A, $FV, $m, $jDown)) {
                $j = $jDown;
                break;
            }
        }

        $interestRatePerYear = ((1 + $j) ** $m) - 1;

        return new Result(
            (float)$input->getInitialAmount(),
            (float)$input->getRegularPayment(),
            $input->getNumberOfRegularPaymentsPerYear(),
            (int)$input->getNumberOfYears(),
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
        $leftSubEquation = round(($FV * $j + $A) / ($PV * $j + $A), 2);
        $rightSubEquation = round((1 + $j) ** $m, 2);

        return $leftSubEquation === $rightSubEquation;
    }
}
