<?php

namespace App\Service;

use App\Entity\Transaction;
use App\Service\AccountManager;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class TransactionManager
{
    private $accountManager;
    private $manager;
    //private $repository;

    public function __construct(AccountManager $accountManager, EntityManagerInterface $manager/* , AccountRepository $repository */)
    {
        $this->accountManager = $accountManager;
        $this->manager = $manager;
        //$this->repository = $repository;
    }

    //Operation Buy object : Money in account - price of object
    public function buy($transaction, $object)
    {
        $money = $transaction->getAccount()->getMoney() - $object->price;

        return $money;
    }

    public function newTransaction($transactionRequest, $id)
    {
        $transaction = new Transaction;
        $transaction->setName($transactionRequest->name);
        $transaction->setDateCreated(new \DateTime());
        $transaction->setStatus($transactionRequest->status);
        $transaction->setPrice($transactionRequest->price);

        $account = $this->accountManager->getAccount($id);
        $transaction->setAccount($account);

        return $transaction;
    }

    public function persist($transaction)
    {
        $this->manager->persist($transaction);
        $this->manager->flush();
    }

    //Operation Sell object : Money in account + price of object
    public function sell($transaction, $object)
    {
        $money = $transaction->getAccount()->getMoney() + $object->price;

        return $money;
    }

}
