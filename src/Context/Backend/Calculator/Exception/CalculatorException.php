<?php

declare(strict_types=1);

namespace App\Context\Backend\Calculator\Exception;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class CalculatorException extends Exception
{
    public function __construct(array $errors)
    {
        parent::__construct(implode("\n", $errors), Response::HTTP_BAD_REQUEST);
    }
}
