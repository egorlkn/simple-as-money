<?php

declare(strict_types=1);

namespace App\Core\IncomeCalculator;

use App\Core\IncomeCalculator\Exception\CalculatorException;
use App\Core\IncomeCalculator\Model\Input;
use App\Core\IncomeCalculator\Model\Result;

interface CalculateStrategyInterface
{
    public function canHandle(Input $input): bool;

    /**
     * @throws CalculatorException
     */
    public function doCalculation(Input $input): Result;
}
