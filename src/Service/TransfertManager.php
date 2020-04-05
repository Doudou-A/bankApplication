<?php

namespace App\Service;

use App\Entity\Transfert;
use App\Repository\TransfertRepository;
use Doctrine\ORM\EntityManagerInterface;

class TransfertManager
{
    private $manager;
    private $repository;

    public function __construct(EntityManagerInterface $manager, TransfertRepository $repository)
    {
        $this->manager = $manager;
        $this->repository = $repository;
    }

    public function createTransfert($amount, $accountToCredit, $accountToDebit)
    {
        $transfert = new Transfert;
        $transfert->setAmount($amount);
        $transfert->setAccountToCredit($accountToCredit);
        $transfert->setAccountToDebit($accountToDebit);
        $transfert->setDateCreated(new \DateTime());

        $this->persist($transfert);
    }

    public function persist($transfert)
    {
        $this->manager->persist($transfert);
        $this->manager->flush();
    }
}
