<?php

namespace App\Form;

use App\Entity\Transaction;
use App\DOI\TransactionRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TransactionFormType extends AbstractType
{
    /**
     * Undocumented function
     *
     * @param FormBuilderInterface<array> $builder
     * @param array<Transaction> $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('price', null, [
                'attr' => [
                    'placeholder' => '€',
                ]
            ])
            ->add('status', ChoiceType::class, [
                'choices'  => [
                    'SELL' => 0,
                    'BUY' => 1
                ],
            ]);
        ;
    }
}
