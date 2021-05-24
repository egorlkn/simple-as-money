<?php

declare(strict_types=1);

namespace App\Context\Backend\Calculator\Model;

use App\Context\Backend\Calculator\Exception\CalculatorException;
use Symfony\Component\Validator\Constraints as Assert;

class Input
{
    /**
     * @Assert\Type("float", message="Начальная сумма размещения должна быть числом")
     * @Assert\PositiveOrZero(message="Начальная сумма размещения должна быть больше или равна нулю")
     */
    private ?float $initialAmount;

    /**
     * @Assert\Type("float", message="Сумма регулярного взноса должна быть числом")
     * @Assert\PositiveOrZero(message="Сумма регулярного взноса должна быть больше или равна нулю")
     */
    private ?float $regularPayment;

    /**
     * @Assert\Type("int", message="Количество взносов в год должно быть числом")
     * @Assert\PositiveOrZero(message="Количество взносов в год должно быть больше или равно нулю")
     * @Assert\NotNull(message="Количество взносов в год должно быть больше или равно нулю")
     */
    private ?int $numberOfRegularPaymentsPerYear;

    /**
     * @Assert\Type("float", message="Количество лет должно быть числом")
     * @Assert\GreaterThanOrEqual(1, message="Количество лет должно быть больше или равно единице")
     */
    private ?float $numberOfYears;

    /**
     * @Assert\Type("float", message="Ставка размещения должна быть числом")
     * @Assert\Positive(message="Ставка размещения должна быть больше нуля")
     */
    private ?float $interestRatePerYear;

    /**
     * @Assert\Type("float", message="Сумма накопления должна быть числом")
     * @Assert\Positive(message="Сумма накопления должна быть больше нуля")
     */
    private ?float $finalAmount;

    private bool $initialAmountIsUnknown;
    private bool $regularPaymentIsUnknown;
    private bool $numberOfYearsIsUnknown;
    private bool $interestRatePerYearIsUnknown;
    private bool $finalAmountIsUnknown;

    public function __construct(
        ?float $initialAmount,
        ?float $regularPayment,
        ?int $numberOfRegularPaymentsPerYear,
        ?float $numberOfYears,
        ?float $interestRatePerYear,
        ?float $finalAmount,
        bool $initialAmountIsUnknown,
        bool $regularPaymentIsUnknown,
        bool $numberOfYearsIsUnknown,
        bool $interestRatePerYearIsUnknown,
        bool $finalAmountIsUnknown
    ) {
        $this->initialAmount = $initialAmount;
        $this->regularPayment = $regularPayment;
        $this->numberOfRegularPaymentsPerYear = $numberOfRegularPaymentsPerYear;
        $this->numberOfYears = $numberOfYears;
        $this->interestRatePerYear = $interestRatePerYear;
        $this->finalAmount = $finalAmount;
        $this->initialAmountIsUnknown = $initialAmountIsUnknown;
        $this->regularPaymentIsUnknown = $regularPaymentIsUnknown;
        $this->numberOfYearsIsUnknown = $numberOfYearsIsUnknown;
        $this->interestRatePerYearIsUnknown = $interestRatePerYearIsUnknown;
        $this->finalAmountIsUnknown = $finalAmountIsUnknown;
    }

    public static function empty(): self
    {
        return new self(
            null,
            null,
            12,
            null,
            null,
            null,
            false,
            false,
            false,
            false,
            false
        );
    }

    public function getInitialAmount(): ?float
    {
        if ($this->initialAmountIsUnknown()) {
            return null;
        }

        return $this->initialAmount;
    }

    public function getRegularPayment(): ?float
    {
        if ($this->regularPaymentIsUnknown()) {
            return null;
        }

        return $this->regularPayment;
    }

    public function getNumberOfRegularPaymentsPerYear(): int
    {
        return $this->numberOfRegularPaymentsPerYear;
    }

    public function getNumberOfYears(): ?float
    {
        if ($this->numberOfYearsIsUnknown()) {
            return null;
        }

        return $this->numberOfYears;
    }

    public function getInterestRatePerYear(): ?float
    {
        if ($this->interestRatePerYearIsUnknown()) {
            return null;
        }

        return $this->interestRatePerYear;
    }

    public function getFinalAmount(): ?float
    {
        if ($this->finalAmountIsUnknown()) {
            return null;
        }

        return $this->finalAmount;
    }

    public function initialAmountIsUnknown(): bool
    {
        return $this->initialAmountIsUnknown;
    }

    public function regularPaymentIsUnknown(): bool
    {
        return $this->regularPaymentIsUnknown;
    }

    public function numberOfYearsIsUnknown(): bool
    {
        return $this->numberOfYearsIsUnknown;
    }

    public function interestRatePerYearIsUnknown(): bool
    {
        return $this->interestRatePerYearIsUnknown;
    }

    public function finalAmountIsUnknown(): bool
    {
        return $this->finalAmountIsUnknown;
    }

    /**
     * @throws CalculatorException
     */
    public function validate(): void
    {
        $error = $this->checkNumberOfUnknownItems();
        if ($error) {
            throw new CalculatorException([$error]);
        }

        $errors = $this->checkKnownItems();
        if (!empty($errors)) {
            throw new CalculatorException($errors);
        }

        $error = $this->checkNumberOfRegularPaymentsPerYear();
        if ($error) {
            throw new CalculatorException([$error]);
        }
    }

    private function checkNumberOfUnknownItems(): string
    {
        $i = 0;

        if ($this->initialAmountIsUnknown()) {
            $i++;
        }

        if ($this->regularPaymentIsUnknown()) {
            $i++;
        }

        if ($this->numberOfYearsIsUnknown()) {
            $i++;
        }

        if ($this->interestRatePerYearIsUnknown()) {
            $i++;
        }

        if ($this->finalAmountIsUnknown()) {
            $i++;
        }

        if ($i === 0) {
            return 'Должна быть хотя бы одна неизвестная величина';
        }

        if ($i !== 1) {
            return 'Может быть только одна неизвестная величина';
        }

        return '';
    }

    private function checkKnownItems(): array
    {
        $errors = [];

        if (!$this->initialAmountIsUnknown() && $this->getInitialAmount() === null) {
            $errors[] = 'Начальная сумма размещения должна быть больше или равна нулю';
        }

        if (!$this->regularPaymentIsUnknown() && $this->getRegularPayment() === null) {
            $errors[] = 'Сумма регулярного взноса должна быть больше или равна нулю';
        }

        if (!$this->numberOfYearsIsUnknown() && $this->getNumberOfYears() === null) {
            $errors[] = 'Количество лет должно быть больше или равно единице';
        }

        if (!$this->interestRatePerYearIsUnknown() && $this->getInterestRatePerYear() === null) {
            $errors[] = 'Ставка размещения должна быть больше нуля';
        }

        if (!$this->finalAmountIsUnknown() && $this->getFinalAmount() === null) {
            $errors[] = 'Сумма накопления должна быть больше нуля';
        }

        return $errors;
    }

    private function checkNumberOfRegularPaymentsPerYear(): string
    {
        if ($this->regularPaymentIsUnknown()) {
            if ($this->getNumberOfRegularPaymentsPerYear() < 1) {
                return 'Количество взносов в год должно быть больше или равно единице';
            }
        } else {
            if ((float)$this->getRegularPayment() === 0.0) {
                if ($this->getNumberOfRegularPaymentsPerYear() !== 0) {
                    return 'Количество взносов в год должно быть равно нулю';
                }
            } else {
                if ($this->getNumberOfRegularPaymentsPerYear() < 1) {
                    return 'Количество взносов в год должно быть больше или равно единице';
                }
            }
        }

        return '';
    }
}
