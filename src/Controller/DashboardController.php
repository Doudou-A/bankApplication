<?php

namespace App\Controller;

use App\Entity\Transaction;
use App\Repository\AccountRepository;
use App\Repository\TransactionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(AccountRepository $repoAccount, TransactionRepository $repoTransaction):Response
    {
        $user = $this->getUser();
        $accounts = $repoAccount->findByUser($user);
        $transactions = new Transaction();

        foreach($accounts as $account){
        //$transactions = $repoTransaction->findBy(array('account' => $account->getId()), array('dateCreated' => 'desc'),5,0);
        $qb->select('u')
        ->from('Transaction', 'u')
        ->where('u.account.id = ?1')
        ->orderBy('u.name', 'ASC');
     
        }

        return $this->render('dashboard/index.html.twig', [
            'accounts' => $accounts,
            'transactions' => $transactions
        ]);
    }
}
