<?php

namespace App\Service;

use App\Entity\Account;
use App\Repository\AccountRepository;
use Doctrine\ORM\EntityManagerInterface;

class AccountManager
{
    private $manager;
    private $repository;

    public function __construct(EntityManagerInterface $manager, AccountRepository $repository)
    {
        $this->manager = $manager;
        $this->repository = $repository;
    }

    public function createAccount($createAccountRequest, $user)
    {
        $account = new Account;
        $account->setNumber($createAccountRequest->number);
        $account->setMoney(0);
        $account->setUser($user);

        $this->persist($account);
    }

    public function getAccount($id)
    {
        $account = $this->repository->find($id);
        return $account;
    }

    public function getAccountList()
    {
        
    }

    public function updateAccount($account, $money)
    {
        $account->setMoney($money);
    }

    public function persist($account)
    {
        $this->manager->persist($account);
        $this->manager->flush();
    }
}
