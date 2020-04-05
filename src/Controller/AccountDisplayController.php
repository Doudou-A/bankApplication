<?php

namespace App\Controller;

use App\Repository\TransactionRepository;
use App\Repository\TransfertRepository;
use App\Service\AccountManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccountDisplayController extends AbstractController
{
    /**
     * @Route("/account/{id}", name="account_display")
     */
    public function index($id, AccountManager $accountManager, TransactionRepository $repoTransaction, TransfertRepository $repoTransfert)
    {

        $account = $accountManager->getAccount($id);

        $transactions = $repoTransaction->findBy(array('account' => $account->getId()), array('dateCreated' => 'desc'),10,0);
        $transferts = $repoTransfert->findBy(array('account' => $account->getId()), array('dateCreated' => 'desc'),10,0);

        $aExchanges = array_merge($transactions, $transferts);

        return $this->render('account/account_display.html.twig', [
            'account' => $account,
            'aExchanges' => $aExchanges
        ]);
    }
}
