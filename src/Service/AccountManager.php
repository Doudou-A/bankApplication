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

    public function accountCreditAmount($amount, $accountToCredit)
    {
        $accountMoney = $accountToCredit->getMoney();
        $money = $accountMoney + $amount;
        $accountToCredit->setMoney($money);

        $this->persist($accountToCredit);

        return $accountToCredit;
    }

    public function accountDebitAmount($amount, $transfertRequest)
    {
        $accountToDebit = $this->getAccountByNumber($transfertRequest->accountToDebit);
        $accountMoney = $accountToDebit->getMoney();
        $money = $accountMoney - $amount;

        $accountToDebit->setMoney($money);

        $this->persist($accountToDebit);

        return $accountToDebit;
    }

    public function createAccount($createAccountRequest, $user)
    {
        $account = new Account;
        $account->setNumber($createAccountRequest->number);
        $account->setMoney(0);
        $account->setUser($user);

        $this->persist($account);
    }
     
    public function deleteAccount($id)
    {
        $account = $this->repository->find($id);

        $this->remove($account);
    }

    public function getAccount($id)
    {
        $account = $this->repository->find($id);
        return $account;
    }

    public function getAccountByNumber($number)
    {
        $account = $this->repository->findOneByNumber($number);
        return $account;
    }

    public function getAccountsUser($user)
    {
        $accounts = $this->repository->findByUser($user);

        foreach ($accounts as $account) {
            $accountsNumber[] = [$account->getNumber() => $account->getNumber()];
        }

        return $accountsNumber;
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

    public function remove($account)
    {
        $this->manager->remove($account);
        $this->manager->flush();
    }
}
