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
        $transfertsDebit = $repoTransfert->findBy(array('accountToDebit' => $account->getId()), array('dateCreated' => 'desc'),5,0);
        $transfertsCredit = $repoTransfert->findBy(array('accountToCredit' => $account->getId()), array('dateCreated' => 'desc'),5,0);

        $aExchanges = array_merge($transactions, $transfertsDebit);
        $aExchanges = array_merge($aExchanges, $transfertsCredit);

        return $this->render('account/account_display.html.twig', [
            'account' => $account,
            'aExchanges' => $aExchanges
        ]);
    }
}
