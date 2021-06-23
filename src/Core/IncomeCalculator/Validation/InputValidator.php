<?php

declare(strict_types=1);

namespace App\Core\IncomeCalculator\Validation;

use App\Core\IncomeCalculator\Exception\InputValidationException;
use App\Core\IncomeCalculator\Model\Input;

class InputValidator
{
    /**
     * @throws InputValidationException
     */
    public function validate(Input $input): void
    {
        $errors = [];

        $errors = array_merge($errors, $this->validateNumberOfUnknownValues($input));
        $errors = array_merge($errors, $this->validateInitialAmount($input));
        $errors = array_merge($errors, $this->validateRegularPayment($input));
        $errors = array_merge($errors, $this->validateNumberOfRegularPaymentsPerYear($input));
        $errors = array_merge($errors, $this->validateNumberOfYears($input));
        $errors = array_merge($errors, $this->validateInterestRatePerYear($input));
        $errors = array_merge($errors, $this->validateFinalAmount($input));

        if (empty($errors)) {
            return;
        }

        throw InputValidationException::create($errors);
    }

    private function validateNumberOfUnknownValues(Input $input): array
    {
        $errors = [];

        $numberOfUnknownValues = 0;

        if ($input->initialAmountIsUnknown()) {
            $numberOfUnknownValues++;
        }

        if ($input->regularPaymentIsUnknown()) {
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
                'Не задана Начальная сумма размещения'
            ];
        }

        if ($initialAmount < 0.0) {
            return [
                'Начальная сумма размещения должна быть больше или равна нулю'
            ];
        }

        return [];
    }

    private function validateRegularPayment(Input $input): array
    {
        if ($input->regularPaymentIsUnknown()) {
            return [];
        }

        $regularPayment = $input->getRegularPayment();

        if (!is_float($regularPayment)) {
            return [
                'Не задана Сумма регулярного взноса'
            ];
        }

        if ($regularPayment < 0.0) {
            return [
                'Сумма регулярного взноса должна быть больше или равна нулю'
            ];
        }

        return [];
    }

    private function validateNumberOfRegularPaymentsPerYear(Input $input): array
    {
        $numberOfRegularPaymentsPerYear = $input->getNumberOfRegularPaymentsPerYear();
        $regularPayment = $input->getRegularPayment();

        if ($regularPayment === 0.0) {
            if ($numberOfRegularPaymentsPerYear !== 0) {
                return [
                    'При нулевой Сумме регулярного взноса Количество взносов в год должно быть равно нулю'
                ];
            }
        } else {
            if ($numberOfRegularPaymentsPerYear < 1) {
                return [
                    'При заданной Сумме регулярного взноса Количество взносов в год должно быть больше или равно еденицы'
                ];
            }
        }

        return [];
    }

    private function validateNumberOfYears(Input $input): array
    {
        if ($input->numberOfYearsIsUnknown()) {
            return [];
        }

        $numberOfYears = $input->getNumberOfYears();

        if (!is_float($numberOfYears)) {
            return [
                'Не задано Количество лет'
            ];
        }

        if ($numberOfYears < 1) {
            return [
                'Количество лет должно быть больше или равно единицы'
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
                'Не задана Ставка размещения'
            ];
        }

        if ($interestRatePerYear <= 0.0) {
            return [
                'Ставка размещения должна быть больше нуля'
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
                'Не задана Сумма накопления'
            ];
        }

        $simpleFinalAmount = 0.0;

        $initialAmount = $input->getInitialAmount();
        if (is_float($initialAmount)) {
            $simpleFinalAmount += $initialAmount;
        }

        $regularPayment = $input->getRegularPayment();
        if (is_float($regularPayment)) {
            $numberOfYears = $input->getNumberOfYears();

            if (is_float($numberOfYears)) {
                $numberOfRegularPaymentsPerYear = $input->getNumberOfRegularPaymentsPerYear();

                $simpleFinalAmount += ($regularPayment * $numberOfRegularPaymentsPerYear * $numberOfYears);
            } else {
                $simpleFinalAmount += $regularPayment;
            }
        }

        if ($finalAmount <= $simpleFinalAmount) {
            return [
                'Сумма накопления должна быть больше суммы Начального размещения вместе со всеми Регулярными взоносами'
            ];
        }

        return [];
    }
}
