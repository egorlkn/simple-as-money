<?php

declare(strict_types=1);

namespace App\Context\Backend\Calculator;

use App\Context\Backend\Calculator\Exception\CalculatorException;
use App\Context\Backend\Calculator\Model\Input;
use App\Context\Backend\Calculator\Model\Result;
use App\Context\Backend\Calculator\Validator\Validator;

class Service
{
    private Validator $validator;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @throws CalculatorException
     */
    public function doCalculation(Input $input): Result
    {
        $this->validator->validateInput($input);

        return new Result();
    }
}
