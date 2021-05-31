<?php

declare(strict_types=1);

namespace App\Context\Backend\Calculator;

use App\Context\Backend\Calculator\Model\Input;
use App\Context\Backend\Calculator\Model\CommonResult;

interface CalculateStrategyInterface
{
    public function canHandle(Input $input): bool;

    public function doCalculation(Input $input): CommonResult;
}
