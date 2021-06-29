<?php

declare(strict_types=1);

namespace App\Core\SpendCalculator\Validation;

use App\Core\SpendCalculator\Exception\InputValidationException;
use App\Core\SpendCalculator\Model\Input;

class InputValidator
{
    /**
     * @throws InputValidationException
     */
    public function validate(Input $input): void
    {
        $errors = [];

        $errors = array_merge($errors, $this->validateNumberOfUnknownValues($input));

        if (!empty($errors)) {
            throw InputValidationException::create($errors);
        }

        $errors = array_merge($errors, $this->validateInitialAmount($input));
        $errors = array_merge($errors, $this->validatePaymentAmount($input));
        $errors = array_merge($errors, $this->validateNumberOfPaymentsPerYear($input));
        $errors = array_merge($errors, $this->validateNumberOfYears($input));
        $errors = array_merge($errors, $this->validateInterestRatePerYear($input));
        $errors = array_merge($errors, $this->validateFinalAmount($input));
        $errors = array_merge($errors, $this->validateNumberOfYearsUntilFirstPaymnet($input));
        $errors = array_merge($errors, $this->validateInflation($input));

        if (!empty($errors)) {
            throw InputValidationException::create($errors);
        }
    }

    private function validateNumberOfUnknownValues(Input $input): array
    {
        $errors = [];

        $numberOfUnknownValues = 0;

        if ($input->initialAmountIsUnknown()) {
            $numberOfUnknownValues++;
        }

        if ($input->paymentAmountIsUnknown()) {
            $numberOfUnknownValues++;
        }

        if ($input->numberOfYearsIsUnknown()) {
            $numberOfUnknownValues++;
        }

        if ($input->interestRatePerYearIsUnknown()) {
            $numberOfUnknownValues++;
        }

        if ($input->finalAmountIsUnknown()) {
            $numberOfUnknownValues++;
        }

        if ($numberOfUnknownValues < 1) {
            $errors[] = 'Должна быть выбрана хотя бы одна Неизвестная величина';
        }

        if ($numberOfUnknownValues > 1) {
            $errors[] = 'Должна быть выбрана только одна Неизвестная величина';
        }

        return $errors;
    }

    private function validateInitialAmount(Input $input): array
    {
        if ($input->initialAmountIsUnknown()) {
            return [];
        }

        $initialAmount = $input->getInitialAmount();

        if (!is_float($initialAmount)) {
            return [
                'Не задана Начальная сумма',
            ];
        }

        // @todo проверить логику валидации начальной суммы

        if ($initialAmount <= 0.0) {
            return [
                'Начальная сумма должна быть больше нуля',
            ];
        }

        return [];
    }

    private function validatePaymentAmount(Input $input): array
    {
        if ($input->paymentAmountIsUnknown()) {
            return [];
        }

        $paymentAmount = $input->getPaymentAmount();

        if (!is_float($paymentAmount)) {
            return [
                'Не задана Сумма выплаты',
            ];
        }

        if ($paymentAmount <= 0.0) {
            return [
                'Сумма выплаты должна быть больше нуля',
            ];
        }

        return [];
    }

    private function validateNumberOfPaymentsPerYear(Input $input): array
    {
        $numberOfPaymentsPerYear = $input->getNumberOfPaymentsPerYear();

        if ($numberOfPaymentsPerYear < 1) {
            return [
                'Количество выплат в год должно быть больше или равно единицы',
            ];
        }

        return [];
    }

    private function validateNumberOfYears(Input $input): array
    {
        if ($input->numberOfYearsIsUnknown()) {
            return [];
        }

        $numberOfYears = $input->getNumberOfYears();

        if (!is_int($numberOfYears)) {
            return [
                'Не задано Количество лет',
            ];
        }

        if ($numberOfYears < 1) {
            return [
                'Количество лет должно быть больше или равно единицы',
            ];
        }

        return [];
    }

    private function validateInterestRatePerYear(Input $input): array
    {
        if ($input->interestRatePerYearIsUnknown()) {
            return [];
        }

        $interestRatePerYear = $input->getInterestRatePerYear();

        if (!is_float($interestRatePerYear)) {
            return [
                'Не задана Ставка размещения',
            ];
        }

        if ($interestRatePerYear <= 0.0) {
            return [
                'Ставка размещения должна быть больше нуля',
            ];
        }

        return [];
    }

    private function validateFinalAmount(Input $input): array
    {
        if ($input->finalAmountIsUnknown()) {
            return [];
        }

        $finalAmount = $input->getFinalAmount();

        if (!is_float($finalAmount)) {
            return [
                'Не задана Конечная сумма',
            ];
        }

        if ($finalAmount < 0.0) {
            return [
                'Конечная сумма должна быть больше или равна нулю',
            ];
        }

        return [];
    }

    private function validateNumberOfYearsUntilFirstPaymnet(Input $input): array
    {
        $numberOfYearsUntilFistPayment = $input->getNumberOfYearsUntilFistPayment();

        if ($numberOfYearsUntilFistPayment < 0) {
            return [
                'Количество лет до первой выплаты должно быть больше или равно нулю',
            ];
        }

        return [];
    }

    private function validateInflation(Input $input): array
    {
        $inflation = $input->getInflation();

        if ($inflation <= 0.0) {
            return [
                'Инфляция должна быть больше нуля',
            ];
        }

        return [];
    }
}
