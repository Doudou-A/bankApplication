<?php

namespace App\Controller;


use Carbon\CarbonInterval;
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
    public function index(AccountRepository $repoAccount, TransactionRepository $repoTransaction): Response
    {
        $user = $this->getUser();
        $accounts = $repoAccount->findBy(array('user' => $user));
        //$accounts = $repoAccount->findByUser($user);
        $transactions = new Transaction();

        foreach ($accounts as $account) {
            $transactions = $repoTransaction->findBy(array('account' => $account), array('dateCreated' => 'desc'), 5, 0);
        }

        $dateTime = CarbonInterval::week(3)->totalHours;

        return $this->render('dashboard/index.html.twig', [
            'accounts' => $accounts,
            'transactions' => $transactions,
            'dateTime' => $dateTime
        ]);
    }
}
