<?php

namespace App\Form;

use App\Entity\Account;
use App\Service\UserManager;
use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class TransfertFormType extends \Symfony\Component\Form\AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->traitChoices = $options['accountsNumber'];

        $builder
            /*->add('transmitter', EntityType::class, [
            'class' => Account::class,
            'query_builder' => function (EntityRepository $repo) {
                return $repo->createQueryBuilder('account')
                ->where('account.user.id == '.$options['userId'].'');
            },
            'mapped' => false,
            'multiple' => true,
            'expanded' => true,
            'choice_label' => 'name'
            ]) */
            ->add('transmitter', ChoiceType::class, [
                'mapped' => false,
                'choices' => $this->traitChoices
            ])
            ->add('amount');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\DOI\TransfertRequest',
            'accountsNumber' => false,
        ]);

        // you can also define the allowed types, allowed values and
        // any other feature supported by the OptionsResolver component
        $resolver->setAllowedTypes('accountsNumber', 'array');
    }
}