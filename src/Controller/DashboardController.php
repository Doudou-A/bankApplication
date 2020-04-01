<?php

namespace App\Controller;

use App\Repository\AccountRepository;
use App\Repository\TransactionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(AccountRepository $repoAccount, TransactionRepository $repoTransaction )
    {
        $user = $this->getUser();
        $accounts = $repoAccount->findByUser($user);

        foreach($accounts as $account){
        $transactions = $repoTransaction->findBy(array('account' => $account->getId()), array('dateCreated' => 'desc'),5,0);
        }

        return $this->render('dashboard/index.html.twig', [
            'accounts' => $accounts,
            'transactions' => $transactions
        ]);
    }
}
