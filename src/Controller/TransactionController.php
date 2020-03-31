<?php

namespace App\Controller;

use App\Entity\Account;
use App\Entity\Transaction;
use App\DOI\TransactionRequest;
use App\Form\TransactionFormType;
use App\Repository\AccountRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TransactionController extends AbstractController
{
    /**
     * @Route("/transaction/{number}", name="transaction")
     */
    public function index($number, AccountRepository $repo, Request $request, EntityManagerInterface $manager)
    {

        $account = $repo->findByNumber($number);

        $transactionRequest = new TransactionRequest;

        $form = $this->createForm(TransactionFormType::class, $transactionRequest);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $transaction = new Transaction;
            $transaction->setName($transactionRequest->name);
            $transaction->setStatus($transactionRequest->status);
            $transaction->setPrice($transactionRequest->price);
            if($transactionRequest->status === 0)
            {
                $moneyBefore = $account->getMoney();
                $money = $moneyBefore + $transactionRequest->price;
                $account->setMoney($money);
            }

            $manager->persist($transaction);
            $manager->persist($account);
            $manager->flush();
        }

        return $this->render('transaction/transaction.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
