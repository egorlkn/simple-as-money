<?php

declare(strict_types=1);

namespace App\Context\Backend\Calculator\Validator;

use App\Context\Backend\Calculator\Exception\CalculatorException;
use App\Context\Backend\Calculator\Model\Input;

class Validator
{
    /**
     * @throws CalculatorException
     */
    public function validateInput(Input $input): void
    {
        $this->checkNumberOfUnknownItems($input);
        $this->checkKnownItems($input);
    }

    /**
     * @throws CalculatorException
     */
    private function checkNumberOfUnknownItems(Input $input): void
    {
        $number = 0;

        if ($input->initialAmountIsUnknown()) {
            $number++;
        }

        if ($input->regularPaymentIsUnknown()) {
            $number++;
        }

        if ($input->numberOfYearsIsUnknown()) {
            $number++;
        }

        if ($input->interestRatePerYearIsUnknown()) {
            $number++;
        }

        if ($input->finalAmountIsUnknown()) {
            $number++;
        }

        if ($number === 0) {
            throw CalculatorException::noOneUnknownItem();
        }

        if ($number !== 1) {
            throw CalculatorException::soMuchOfUnknownItems();
        }
    }

    /**
     * @throws CalculatorException
     */
    private function checkKnownItems(Input $input): void
    {
        if (!$input->initialAmountIsUnknown() && $input->getInitialAmount() === null) {
            throw CalculatorException::invalidInitialAmount();
        }

        if (!$input->regularPaymentIsUnknown() && $input->getRegularPayment() === null) {
            throw CalculatorException::invalidRegularPayment();
        }

        if (!$input->numberOfYearsIsUnknown() && $input->getNumberOfYears() === null) {
            throw CalculatorException::invalidNumberOfYears();
        }

        if (!$input->interestRatePerYearIsUnknown() && $input->getInterestRatePerYear() === null) {
            throw CalculatorException::invalidInterestRatePerYear();
        }

        if (!$input->finalAmountIsUnknown() && $input->getFinalAmount() === null) {
            throw CalculatorException::invalidFinalAmount();
        }
    }
}
