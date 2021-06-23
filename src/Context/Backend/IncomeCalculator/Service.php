<?php

declare(strict_types=1);

namespace App\Context\Backend\IncomeCalculator;

use App\Context\Backend\IncomeCalculator\Exception\CalculatorException;
use App\Context\Backend\IncomeCalculator\Model\Input;
use App\Context\Backend\IncomeCalculator\Model\Result;
use App\Context\Backend\IncomeCalculator\Validation\InputValidator;
use Webmozart\Assert\Assert;

class Service
{
    private InputValidator $inputValidator;

    /** @var CalculateStrategyInterface[] */
    private array $strategies;

    public function __construct(InputValidator $inputValidator, array $strategies)
    {
        Assert::allIsInstanceOf($strategies, CalculateStrategyInterface::class);

        $this->inputValidator = $inputValidator;
        $this->strategies = $strategies;
    }

    /**
     * @throws CalculatorException
     */
    public function doCalculation(Input $input): Result
    {
        $this->inputValidator->validate($input);

        foreach ($this->strategies as $strategy) {
            if ($strategy->canHandle($input)) {
                return $strategy->doCalculation($input);
            }
        }

        throw CalculatorException::unknownError();
    }
}
