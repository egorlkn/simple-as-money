<?php

declare(strict_types=1);

namespace App\Core\SpendCalculator\CalculateStrategy;

use App\Core\SpendCalculator\CalculateStrategyInterface;
use App\Core\SpendCalculator\Helper\CalculationHelper;
use App\Core\SpendCalculator\Model\Input;
use App\Core\SpendCalculator\Model\Result;

class PaymentAmount implements CalculateStrategyInterface
{
    private CalculationHelper $helper;

    public function __construct(CalculationHelper $helper)
    {
        $this->helper = $helper;
    }

    public function canHandle(Input $input): bool
    {
        return $input->paymentAmountIsUnknown();
    }

    public function doCalculation(Input $input): Result
    {
        $PV = (float)$input->getInitialAmount();
        $x = $input->getNumberOfPaymentsPerYear();
        $n = (float)$input->getNumberOfYears();
        $s = (float)$input->getInterestRatePerYear() / 100;
        $FV = $input->getFinalAmount();
        $z = $input->getNumberOfYearsUntilFistPayment();
        $k = $input->getInflation() / 100;

        $Kp = $this->helper->calcRateForPeriod($k, $x);
        $Sp = $this->helper->calcRateForPeriod($s, $x);

        $HkpfacList = [];
        $HspfacList = [];

        for ($i = 0; $i < ($x * $n); $i++) {
            $Hkpfac = (1 + $Kp) ** (($z * $x) + $i);

            if ($i === 0) {
                $Hspfac = $Hkpfac;
            } else {
                $Hspfac = $Hkpfac / ((1 + $Sp) ** $i);
            }

            $HkpfacList[] = $Hkpfac;
            $HspfacList[] = $Hspfac;
        }

        $PVfinal = $FV / (1 + $Sp) ** (($x * $n) - 1);

        $paymentAmount = ($PV - $PVfinal) / array_sum($HspfacList);

        return new Result(
            (float)$input->getInitialAmount(),
            $paymentAmount,
            $input->getNumberOfPaymentsPerYear(),
            (float)$input->getNumberOfYears(),
            (float)$input->getInterestRatePerYear(),
            (float)$input->getFinalAmount(),
            $input->getNumberOfYearsUntilFistPayment(),
            $input->getInflation()
        );
    }
}
