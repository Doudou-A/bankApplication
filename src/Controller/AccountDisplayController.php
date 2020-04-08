<?php

namespace App\Controller;

use App\Service\AccountManager;
use App\Repository\TransfertRepository;
use App\Repository\TransactionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountDisplayController extends AbstractController
{
    /**
     * @Route("/account/{id}", name="account_display")
     */
    public function index(int $id, AccountManager $accountManager, TransactionRepository $repoTransaction, TransfertRepository $repoTransfert):Response
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
