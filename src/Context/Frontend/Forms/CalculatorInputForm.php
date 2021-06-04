<?php

declare(strict_types=1);

namespace App\Context\Frontend\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class CalculatorInputForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'initialAmount',
                NumberType::class,
                [
                    'html5' => true,
                    'scale' => 2,
                    'attr' => [
                        'step' => 0.01,
                        'min' => 0,
                    ],
                    'input' => 'number',
                    'empty_data' => null,
                    'label' => 'Начальная сумма размещения',
                    'required' => false,
                ]
            )
            ->add(
                'initialAmountIsUnknown',
                CheckboxType::class,
                [
                    'empty_data' => null,
                    'label' => 'Неизвестная величина',
                    'required' => false,
                ]
            )
            ->add(
                'regularPayment',
                NumberType::class,
                [
                    'html5' => true,
                    'scale' => 2,
                    'attr' => [
                        'step' => 0.01,
                        'min' => 0,
                    ],
                    'input' => 'number',
                    'empty_data' => null,
                    'label' => 'Сумма регулярного взноса',
                    'required' => false,
                ]
            )
            ->add(
                'regularPaymentIsUnknown',
                CheckboxType::class,
                [
                    'empty_data' => null,
                    'label' => 'Неизвестная величина',
                    'required' => false,
                ]
            )
            ->add(
                'numberOfRegularPaymentsPerYear',
                NumberType::class,
                [
                    'html5' => true,
                    'scale' => 0,
                    'attr' => [
                        'step' => 1,
                        'min' => 0,
                    ],
                    'input' => 'number',
                    'empty_data' => null,
                    'label' => 'Количество взносов в год',
                    'required' => false,
                ]
            )
            ->add(
                'numberOfYears',
                NumberType::class,
                [
                    'html5' => true,
                    'scale' => 1,
                    'attr' => [
                        'step' => 0.1,
                        'min' => 1,
                    ],
                    'input' => 'number',
                    'empty_data' => null,
                    'label' => 'Количество лет',
                    'required' => false,
                ]
            )
            ->add(
                'numberOfYearsIsUnknown',
                CheckboxType::class,
                [
                    'empty_data' => null,
                    'label' => 'Неизвестная величина',
                    'required' => false,
                ]
            )
            ->add(
                'interestRatePerYear',
                NumberType::class,
                [
                    'html5' => true,
                    'scale' => 2,
                    'attr' => [
                        'step' => 0.01,
                        'min' => 0.01,
                    ],
                    'input' => 'number',
                    'empty_data' => null,
                    'label' => 'Ставка размещения в % годовых',
                    'required' => false,
                ]
            )
            ->add(
                'interestRatePerYearIsUnknown',
                CheckboxType::class,
                [
                    'empty_data' => null,
                    'label' => 'Неизвестная величина',
                    'required' => false,
                ]
            )
            ->add(
                'finalAmount',
                NumberType::class,
                [
                    'html5' => true,
                    'scale' => 2,
                    'attr' => [
                        'step' => 0.01,
                        'min' => 0.01,
                    ],
                    'input' => 'number',
                    'empty_data' => null,
                    'label' => 'Сумма накопления',
                    'required' => false,
                ]
            )
            ->add(
                'finalAmountIsUnknown',
                CheckboxType::class,
                [
                    'empty_data' => null,
                    'label' => 'Неизвестная величина',
                    'required' => false,
                ]
            )
            ->add(
                'submit',
                SubmitType::class,
                [
                    'label' => 'Рассчитать',
                ]
            )
            ->setDataMapper(new CalculatorInputFormMapper());
    }
}
