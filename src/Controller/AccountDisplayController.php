<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccountDisplayController extends AbstractController
{
    /**
     * @Route("/account/display", name="account_display")
     */
    public function index()
    {
        return $this->render('account_display/index.html.twig', [
            'controller_name' => 'AccountDisplayController',
        ]);
    }
}
