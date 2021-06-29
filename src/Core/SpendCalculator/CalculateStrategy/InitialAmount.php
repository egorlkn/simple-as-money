<?php

declare(strict_types=1);

namespace App\Core\SpendCalculator\CalculateStrategy;

use App\Core\SpendCalculator\CalculateStrategyInterface;
use App\Core\SpendCalculator\Helper\CalculationHelper;
use App\Core\SpendCalculator\Model\Input;
use App\Core\SpendCalculator\Model\Result;

class InitialAmount implements CalculateStrategyInterface
{
    private CalculationHelper $helper;

    public function __construct(CalculationHelper $helper)
    {
        $this->helper = $helper;
    }

    public function canHandle(Input $input): bool
    {
        return $input->initialAmountIsUnknown();
    }

    public function doCalculation(Input $input): Result
    {
        $H = (float)$input->getPaymentAmount();
        $x = $input->getNumberOfPaymentsPerYear();
        $n = (float)$input->getNumberOfYears();
        $s = (float)$input->getInterestRatePerYear() / 100;
        $FV = $input->getFinalAmount();
        $z = $input->getNumberOfYearsUntilFistPayment();
        $k = $input->getInflation() / 100;

        $Kp = $this->helper->calcRateForPeriod($k, $x);
        $Sp = $this->helper->calcRateForPeriod($s, $x);

        $HkpList = $this->helper->calcPaymentsWithInflation($H, $x, $n, $z, $Kp);

        $HspList = [];
        $i = 1;
        foreach ($HkpList as $Hkp) {
            if ($i === 1) {
                $Hsp = $Hkp;
            } else {
                $Hsp = $Hkp / ((1 + $Sp) ** ($i - 1));
            }

            $HspList[] = $Hsp;

            $i++;
        }

        $initialAmount = array_sum($HspList);

        $initialAmount += $FV / ((1 + $Sp) ** (($x * $n) - 1));

        return new Result(
            $initialAmount,
            (float)$input->getPaymentAmount(),
            $input->getNumberOfPaymentsPerYear(),
            (float)$input->getNumberOfYears(),
            (float)$input->getInterestRatePerYear(),
            (float)$input->getFinalAmount(),
            $input->getNumberOfYearsUntilFistPayment(),
            $input->getInflation()
        );
    }
}
