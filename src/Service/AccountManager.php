<?php

namespace App\Service;

use App\Entity\Account;
use Doctrine\ORM\EntityManagerInterface;

class AccountManager
{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function createAccount($createAccountRequest)
    {
        $account = new Account;
        $account->setNumber($createAccountRequest->number);
        $account->setMoney(0);

        $this->persist($account);
    }

    public function persist($account)
    {
        $this->manager->persist($account);
        $this->manager->flush();
    }
}
