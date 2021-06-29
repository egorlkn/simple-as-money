<?php

declare(strict_types=1);

namespace App\Core\SpendCalculator\CalculateStrategy;

use App\Core\SpendCalculator\CalculateStrategyInterface;
use App\Core\SpendCalculator\Helper\CalculationHelper;
use App\Core\SpendCalculator\Model\Input;
use App\Core\SpendCalculator\Model\Result;

class NumberOfYears implements CalculateStrategyInterface
{
    private CalculationHelper $helper;

    public function __construct(CalculationHelper $helper)
    {
        $this->helper = $helper;
    }

    public function canHandle(Input $input): bool
    {
        return $input->numberOfYearsIsUnknown();
    }

    public function doCalculation(Input $input): Result
    {
        $PV = (float)$input->getInitialAmount();
        $H = (float)$input->getPaymentAmount();
        $x = $input->getNumberOfPaymentsPerYear();
        $s = (float)$input->getInterestRatePerYear() / 100;
        $FV = (float)$input->getFinalAmount();
        $z = $input->getNumberOfYearsUntilFistPayment();
        $k = $input->getInflation() / 100;

        $Kp = $this->helper->calcRateForPeriod($k, $x);
        $Sp = $this->helper->calcRateForPeriod($s, $x);

        $np = 0;
        $Hkp = $H;

        while ($PV > $FV) {
            $np++;

            if ($np === 1) {
                $Hkp = $Hkp * ((1 + $Kp) ** ($z * $x));
            } else {
                $Hkp = $Hkp * (1 + $Kp);
            }

            if (($PV - $FV) < $Hkp) {
                $np--;

                break;
            }

            $PV -= $Hkp;

            $PV *= (1 + $Sp);
        }

        // @todo дополняем сумму остатка
        $numberOfYears = (int)floor($np / $x);

        return new Result(
            (float)$input->getInitialAmount(),
            (float)$input->getPaymentAmount(),
            $input->getNumberOfPaymentsPerYear(),
            $numberOfYears,
            (float)$input->getInterestRatePerYear(),
            (float)$input->getFinalAmount(),
            $input->getNumberOfYearsUntilFistPayment(),
            $input->getInflation()
        );
    }
}
