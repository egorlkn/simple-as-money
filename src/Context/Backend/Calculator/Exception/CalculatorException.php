<?php

declare(strict_types=1);

namespace App\Context\Backend\Calculator\Exception;

use Exception;

class CalculatorException extends Exception
{
    private const INVALID_NUMBER_OF_UNKNOWN_ITEMS_CODE = 1000;
    private const INVALID_KNOWN_ITEM = 1001;

    private function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
    }

    public static function soMuchOfUnknownItems(): self
    {
        return new self('Может быть только одна неизвестная величина', self::INVALID_NUMBER_OF_UNKNOWN_ITEMS_CODE);
    }

    public static function noOneUnknownItem(): self
    {
        return new self('Должна быть хотя бы одна неизвестная величина', self::INVALID_NUMBER_OF_UNKNOWN_ITEMS_CODE);
    }

    public static function invalidInitialAmount(): self
    {
        return new self('Начальная сумма размещения должна быть больше или равна нулю', self::INVALID_KNOWN_ITEM);
    }

    public static function invalidRegularPayment(): self
    {
        return new self('Сумма регулярного взноса должна быть больше или равна нулю', self::INVALID_KNOWN_ITEM);
    }

    public static function invalidNumberOfYears(): self
    {
        return new self('Количество лет должно быть больше или равно еденице', self::INVALID_KNOWN_ITEM);
    }

    public static function invalidInterestRatePerYear(): self
    {
        return new self('Ставка размещения должна быть больше нуля', self::INVALID_KNOWN_ITEM);
    }

    public static function invalidFinalAmount(): self
    {
        return new self('Сумма накопления должна быть больше нуля', self::INVALID_KNOWN_ITEM);
    }
}
