<?php

namespace App\Form;

use App\Entity\Account;
use Symfony\Component\Form\FormBuilderInterface;


class AccountFormType extends \Symfony\Component\Form\AbstractType
{
    /**
     * Undocumented function
     *
     * @param FormBuilderInterface<array> $builder
     * @param array<Account> $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('number');
    }
}