<?php

declare(strict_types=1);

namespace App\Core\SpendCalculator\CalculateStrategy;

use App\Core\SpendCalculator\CalculateStrategyInterface;
use App\Core\SpendCalculator\Exception\CalculatorException;
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

    /**
     * @throws CalculatorException
     */
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

        $Hkp = $H * ((1 + $Kp) ** ($z * $x));

        switch (true) {
            case $PV < $Hkp:
                $numberOfYears = 0;
                $finalAmount = $PV - $Hkp;

                break;
            default:
                $np = 0;

                while ($PV > $FV) {
                    $np++;

                    if ($np > 1) {
                        $PV *= (1 + $Sp);

                        $Hkp = $Hkp * (1 + $Kp);

                        if (($PV - $FV) < $Hkp) {
                            $np--;

                            break;
                        }
                    }

                    $PV -= $Hkp;
                }

                $numberOfYears = (int)floor($np / $x);
                $finalAmount = $PV;
        }

        if (
            is_nan($finalAmount) ||
            is_nan($numberOfYears) ||
            is_infinite($finalAmount) ||
            is_infinite($numberOfYears)
        ) {
            throw CalculatorException::wrongCalculation();
        }

        return new Result(
            (float)$input->getInitialAmount(),
            (float)$input->getPaymentAmount(),
            $input->getNumberOfPaymentsPerYear(),
            $numberOfYears,
            (float)$input->getInterestRatePerYear(),
            $finalAmount,
            $input->getNumberOfYearsUntilFistPayment(),
            $input->getInflation()
        );
    }
}
