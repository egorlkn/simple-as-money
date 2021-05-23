<?php

declare(strict_types=1);

namespace App\Context\Backend\Calculator;

use App\Context\Backend\Calculator\Exception\CalculatorException;
use App\Context\Backend\Calculator\Model\Input;
use App\Context\Backend\Calculator\Model\Result;

class Service
{
    /**
     * @throws CalculatorException
     */
    public function doCalculation(Input $input): Result
    {
        $input->validate();

        return new Result();
    }
}
