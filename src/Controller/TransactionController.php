<?php

namespace App\Controller;

use App\Entity\Account;
use App\Entity\Transaction;
use App\DOI\TransactionRequest;
use App\Service\AccountManager;
use App\Form\TransactionFormType;
use App\Service\TransactionManager;
use App\Repository\AccountRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TransactionController extends AbstractController
{
    /**
     * @Route("/transaction/{id}", name="transaction")
     */
    public function index(int $id, Request $request, AccountManager $accountManager, TransactionManager $transactionManager): Response
    {
        $account = $accountManager->getAccount($id);

        $transactionRequest = new TransactionRequest;

        $form = $this->createForm(TransactionFormType::class, $transactionRequest);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $transaction = $transactionManager->newTransaction($transactionRequest, $id);

            if($transactionRequest->status == 1)
            {
                $money = $transactionManager->buy($transaction, $transactionRequest);
            } else {
                $money = $transactionManager->sell($transaction, $transactionRequest);
            }
            $accountManager->updateAccount($account, $money);

            $transactionManager->persist($transaction);
            $accountManager->persist($account);

            $this->addFlash('success', 'Your transaction has been add to your account !');

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('transaction/transaction.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
