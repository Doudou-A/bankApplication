<?php

namespace App\Controller;

use App\Repository\AccountRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(AccountRepository $repo)
    {
        $user = $this->getUser();
        $accounts = $repo->findByUser($user);

        return $this->render('dashboard/index.html.twig', [
            'accounts' => $accounts
        ]);
    }
}
