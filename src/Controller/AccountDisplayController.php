<?php

namespace App\Controller;

use App\Repository\TransactionRepository;
use App\Service\AccountManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccountDisplayController extends AbstractController
{
    /**
     * @Route("/account/{id}", name="account_display")
     */
    public function index($id, AccountManager $accountManager, TransactionRepository $repo)
    {

        $account = $accountManager->getAccount($id);

        $transactions = $repo->findBy(array('account' => $account->getId()), array('dateCreated' => 'desc'),10,0);

        return $this->render('account/account_display.html.twig', [
            'account' => $account,
            'transactions' => $transactions
        ]);
    }
}
