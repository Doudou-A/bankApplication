<?php

namespace App\Controller;

use App\Service\AccountManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccountDeleteController extends AbstractController
{
    /**
     * @Route("/account/delete/{id}", name="account_delete")
     */
    public function index($id, AccountManager $accountManager)
    {
        $accountManager->deleteAccount($id);

        return $this->redirectToRoute('dashboard');
    }
}
