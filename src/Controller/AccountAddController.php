<?php

namespace App\Controller;

use App\Entity\Account;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountAddController extends AbstractController
{
    /**
     * @Route("/account/add", name="account_add")
     */
    public function index()
    {
        $account = new Account;
        
        return $this->render('account_add/index.html.twig', [
            'controller_name' => 'AccountAddController',
        ]);
    }
}
