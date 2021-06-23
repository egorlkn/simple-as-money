<?php

declare(strict_types=1);

namespace App\Context\Backend\IncomeCalculator\Exception;

use Webmozart\Assert\Assert;

class InputValidationException extends CalculatorException
{
    /** @var string[] */
    private array $validationErrors;

    public static function create(array $validationErrors): self
    {
        Assert::allString($validationErrors);

        $self = new self('Input contents invalid data', self::INPUT_VALIDATION_ERROR);

        $self->validationErrors = $validationErrors;

        return $self;
    }

    /**
     * @return string[]
     */
    public function getValidationErrors(): array
    {
        return $this->validationErrors;
    }
}
