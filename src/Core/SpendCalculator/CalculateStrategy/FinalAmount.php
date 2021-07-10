<?php

declare(strict_types=1);

namespace App\Core\SpendCalculator\CalculateStrategy;

use App\Core\SpendCalculator\CalculateStrategyInterface;
use App\Core\SpendCalculator\Exception\CalculatorException;
use App\Core\SpendCalculator\Helper\CalculationHelper;
use App\Core\SpendCalculator\Model\Input;
use App\Core\SpendCalculator\Model\Result;

class FinalAmount implements CalculateStrategyInterface
{
    private CalculationHelper $helper;

    public function __construct(CalculationHelper $helper)
    {
        $this->helper = $helper;
    }

    public function canHandle(Input $input): bool
    {
        return $input->finalAmountIsUnknown();
    }

    /**
     * @throws CalculatorException
     */
    public function doCalculation(Input $input): Result
    {
        $PV = (float)$input->getInitialAmount();
        $H = (float)$input->getPaymentAmount();
        $x = $input->getNumberOfPaymentsPerYear();
        $n = (int)$input->getNumberOfYears();
        $s = (float)$input->getInterestRatePerYear() / 100;
        $z = $input->getNumberOfYearsUntilFistPayment();
        $k = $input->getInflation() / 100;

        $Kp = $this->helper->calcRateForPeriod($k, $x);
        $Sp = $this->helper->calcRateForPeriod($s, $x);

        $HkpList = $this->helper->calcPaymentsWithInflation($H, $x, $n, $z, $Kp);

        $finalAmount = 0;
        $i = 1;
        foreach ($HkpList as $Hkp) {
            if ($i === 1) {
                $finalAmount = ($PV - $Hkp) * (1 + $Sp);
            } elseif ($i === count($HkpList)) {
                $finalAmount -= $Hkp;
            } else {
                $finalAmount = ($finalAmount - $Hkp) * (1 + $Sp);
            }

            $i++;
        }

        if (is_nan($finalAmount) || is_infinite($finalAmount)) {
            throw CalculatorException::wrongCalculation();
        }

        return new Result(
            (float)$input->getInitialAmount(),
            (float)$input->getPaymentAmount(),
            $input->getNumberOfPaymentsPerYear(),
            (int)$input->getNumberOfYears(),
            (float)$input->getInterestRatePerYear(),
            $finalAmount,
            $input->getNumberOfYearsUntilFistPayment(),
            $input->getInflation()
        );
    }
}
