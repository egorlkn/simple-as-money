<?php

declare(strict_types=1);

namespace App\Context\Backend\IncomeCalculator\Exception;

use Exception;

class CalculatorException extends Exception
{
    protected const UNKNOWN_ERROR = 1000;
    protected const INPUT_VALIDATION_ERROR = 1001;

    protected function __construct($message = '', $code = 0)
    {
        parent::__construct($message, $code);
    }

    public static function unknownError(): self
    {
        return new self('Unknown error', self::UNKNOWN_ERROR);
    }
}
