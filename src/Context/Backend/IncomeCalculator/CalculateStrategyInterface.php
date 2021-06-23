<?php

declare(strict_types=1);

namespace App\Context\Backend\IncomeCalculator;

use App\Context\Backend\IncomeCalculator\Model\Input;
use App\Context\Backend\IncomeCalculator\Model\Result;

interface CalculateStrategyInterface
{
    public function canHandle(Input $input): bool;

    public function doCalculation(Input $input): Result;
}
