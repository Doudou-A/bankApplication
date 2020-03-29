<?php

namespace App\Form;

use Symfony\Component\Form\FormBuilderInterface;


class AccountFormType extends \Symfony\Component\Form\AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('number');
    }
}