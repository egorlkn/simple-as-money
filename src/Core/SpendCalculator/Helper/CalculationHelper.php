<?php

declare(strict_types=1);

namespace App\Core\SpendCalculator\Helper;

class CalculationHelper
{
    public function calcRateForPeriod(float $value, int $numberOfPaymentsPerYear): float
    {
        return ((1 + $value) ** (1 / $numberOfPaymentsPerYear)) - 1;
    }

    /**
     * @return array<float>
     */
    public function calcPaymentsWithInflation(
        float $paymentAmount,
        int $numberOfPaymentsPerYear,
        int $numberOfYears,
        int $numberOfYearsUntilFistPayment,
        float $inflationPerPeriod
    ): array {
        $list = [];

        $numberOfPeriods = $numberOfPaymentsPerYear * $numberOfYears;

        $Hkp = $paymentAmount;

        for ($i = 1; $i <= $numberOfPeriods; $i++) {
            if ($i === 1) {
                $Hkp = $Hkp * ((1 + $inflationPerPeriod) ** ($numberOfYearsUntilFistPayment * $numberOfPaymentsPerYear));
            } else {
                $Hkp = $Hkp * (1 + $inflationPerPeriod);
            }

            $list[] = $Hkp;
        }

        return $list;
    }
}
