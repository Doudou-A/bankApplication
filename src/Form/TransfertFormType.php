<?php

namespace App\Form;

use App\Entity\Account;
use App\Service\UserManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class TransfertFormType extends \Symfony\Component\Form\AbstractType
{

    private $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options, $userManager): void
    {
        $user = $userManager->getUser();

        $builder
            ->add('transmitter', EntityType::class, [
            'class' => Account::class,
            'query_builder' => function (EntityRepository $repo) {
                return $repo->createQueryBuilder('account')
                ->where('account.user == '.$user.'');
            },
            'mapped' => false,
            'multiple' => true,
            'expanded' => true,
            'choice_label' => 'name'
            ])
            ->add('amount');
    }
}