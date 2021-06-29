<?php

declare(strict_types=1);

namespace App\Core\SpendCalculator;

use App\Core\SpendCalculator\Exception\CalculatorException;
use App\Core\SpendCalculator\Model\Input;
use App\Core\SpendCalculator\Model\Result;
use App\Core\SpendCalculator\Validation\InputValidator;
use DivisionByZeroError;
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

        try {
            foreach ($this->strategies as $strategy) {
                if ($strategy->canHandle($input)) {
                    return $strategy->doCalculation($input);
                }
            }
        } catch (DivisionByZeroError $error) {
            throw CalculatorException::wrongCalculation();
        }

        throw CalculatorException::unknownError();
    }
}
