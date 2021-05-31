<?php

declare(strict_types=1);

namespace App\Context\Backend\Calculator;

use App\Context\Backend\Calculator\Exception\CalculatorException;
use App\Context\Backend\Calculator\Model\Input;
use App\Context\Backend\Calculator\Model\CommonResult;

class Service
{
    /** @var array<CalculateStrategyInterface> */
    private array $strategies;

    public function __construct(array $strategies)
    {
        $this->strategies = $strategies;
    }

    /**
     * @throws CalculatorException
     */
    public function doCalculation(Input $input): CommonResult
    {
        $input->validate();

        foreach ($this->strategies as $strategy) {
            if (!$strategy->canHandle($input)) {
                continue;
            }

            return $strategy->doCalculation($input);
        }

        throw CalculatorException::unknownError();
    }
}
