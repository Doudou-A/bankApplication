<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccountDeleteController extends AbstractController
{
    /**
     * @Route("/account/delete", name="account_delete")
     */
    public function index()
    {
        return $this->render('account_delete/index.html.twig', [
            'controller_name' => 'AccountDeleteController',
        ]);
    }
}
