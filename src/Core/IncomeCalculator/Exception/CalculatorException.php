<?php

declare(strict_types=1);

namespace App\Core\IncomeCalculator\Exception;

use Exception;

class CalculatorException extends Exception
{
    public const UNKNOWN_ERROR = 1000;
    public const INPUT_VALIDATION_ERROR = 1001;
    public const WRONG_CALCULATION_ERROR = 1002;

    protected function __construct($message = '', $code = 0)
    {
        parent::__construct($message, $code);
    }

    public static function wrongCalculation(): self
    {
        return new self('Wrong calculation', self::WRONG_CALCULATION_ERROR);
    }

    public static function unknownError(): self
    {
        return new self('Unknown error', self::UNKNOWN_ERROR);
    }
}
