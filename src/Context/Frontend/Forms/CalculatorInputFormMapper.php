<?php

declare(strict_types=1);

namespace App\Context\Frontend\Forms;

use App\Context\Backend\Calculator;
use Symfony\Component\Form\Extension\Core\DataMapper\DataMapper;
use Symfony\Component\Form\FormInterface;

class CalculatorInputFormMapper extends DataMapper
{
    public function mapFormsToData(iterable $forms, &$data): void
    {
        $forms = iterator_to_array($forms);

        $data = new Calculator\Model\Input(
            $this->mapFloat($forms['initialAmount']),
            $this->mapFloat($forms['regularPayment']),
            $this->mapInt($forms['numberOfRegularPaymentsPerYear']),
            $this->mapFloat($forms['numberOfYears']),
            $this->mapFloat($forms['interestRatePerYear']),
            $this->mapFloat($forms['finalAmount']),
            $this->mapBoolean($forms['initialAmountIsUnknown']),
            $this->mapBoolean($forms['regularPaymentIsUnknown']),
            $this->mapBoolean($forms['numberOfYearsIsUnknown']),
            $this->mapBoolean($forms['interestRatePerYearIsUnknown']),
            $this->mapBoolean($forms['finalAmountIsUnknown'])
        );
    }

    private function mapFloat(FormInterface $form): ?float
    {
        return $form->getData() === null ? null : (float)$form->getData();
    }

    private function mapInt(FormInterface $form): ?int
    {
        return $form->getData() === null ? null : (int)$form->getData();
    }

    private function mapBoolean(FormInterface $form): bool
    {
        return (int)$form->getData() === 1;
    }
}
