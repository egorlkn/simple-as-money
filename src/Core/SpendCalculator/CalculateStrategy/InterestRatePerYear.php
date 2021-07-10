<?php

declare(strict_types=1);

namespace App\Core\SpendCalculator\CalculateStrategy;

use App\Core\SpendCalculator\CalculateStrategyInterface;
use App\Core\SpendCalculator\Exception\CalculatorException;
use App\Core\SpendCalculator\Helper\CalculationHelper;
use App\Core\SpendCalculator\Model\Input;
use App\Core\SpendCalculator\Model\Result;

class InterestRatePerYear implements CalculateStrategyInterface
{
    private CalculationHelper $helper;

    public function __construct(CalculationHelper $helper)
    {
        $this->helper = $helper;
    }

    public function canHandle(Input $input): bool
    {
        return $input->interestRatePerYearIsUnknown();
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
        $FV = (float)$input->getFinalAmount();
        $z = $input->getNumberOfYearsUntilFistPayment();
        $k = $input->getInflation() / 100;

        $Kp = $this->helper->calcRateForPeriod($k, $x);

        $HkpfacList = [];

        for ($i = 0; $i < ($n * $x); $i++) {
            $HkpfacList[] = (1 + $Kp) ** (($z * $x) + $i);
        }

        $SpInterest = 0.0;
        $startTime = time();

        while (true) {
            $runningTime = time() - $startTime;

            if ($runningTime > 5) {
                throw CalculatorException::wrongCalculation();
            }

            $SpInterest = round($SpInterest + 0.0001, 4);
            $Sp = $SpInterest / 100;

            if ($this->isSolvingEquation($Sp, $HkpfacList, $PV, $H, $x, $n, $FV)) {
                break;
            }
        }

        $interestRatePerYear = (((1 + $Sp) ** $x) - 1) * 100;

        if (is_nan($interestRatePerYear) || is_infinite($interestRatePerYear)) {
            throw CalculatorException::wrongCalculation();
        }

        return new Result(
            (float)$input->getInitialAmount(),
            (float)$input->getPaymentAmount(),
            $input->getNumberOfPaymentsPerYear(),
            (int)$input->getNumberOfYears(),
            $interestRatePerYear,
            (float)$input->getFinalAmount(),
            $input->getNumberOfYearsUntilFistPayment(),
            $input->getInflation()
        );
    }

    private function isSolvingEquation(
        float $Sp,
        array $HkpfacList,
        float $PV,
        float $H,
        int $x,
        float $n,
        float $FV
    ): bool {
        $leftPart = 0;
        $i = 0;
        foreach ($HkpfacList as $Hkpfac) {
            if ($i === 0) {
                $leftPart += $Hkpfac;
            } else {
                $leftPart += $Hkpfac / ((1 + $Sp) ** $i);
            }

            $i++;
        }

        $rightPart = ($PV - ($FV / ((1 + $Sp) ** ($n * $x - 1)))) / $H;

        return $leftPart >= ($rightPart * 0.99998) && $leftPart <= ($rightPart * 1.00002);
    }
}
