<?php

declare(strict_types=1);

namespace App\Core\SpendCalculator;

use App\Core\SpendCalculator\Model\Input;
use App\Core\SpendCalculator\Model\Result;

interface CalculateStrategyInterface
{
    public function canHandle(Input $input): bool;

    public function doCalculation(Input $input): Result;
}
