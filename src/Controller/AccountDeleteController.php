<?php

namespace App\Controller;

use App\Service\AccountManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountDeleteController extends AbstractController
{
    /**
     * @Route("/account/delete/{id}", name="account_delete")
     */
    public function index(int $id, AccountManager $accountManager):RedirectResponse
    {
        $accountManager->deleteAccount($id);

        return $this->redirectToRoute('dashboard');
    }
}
