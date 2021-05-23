<?php

declare(strict_types=1);

namespace App\Context\Backend\Calculator\Exception;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class CalculatorException extends Exception
{
    private array $errors;

    public function __construct(array $errors, int $code = Response::HTTP_BAD_REQUEST)
    {
        $this->errors = $errors;

        parent::__construct(implode("\n", $errors), $code);
    }

    public static function unknownError(): self
    {
        return new self(
            [
                'Неизвестная ошибка. Пожалуйста, свяжитесь с администрацией сайта по адресу info@simpleasmoney.ru',
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
