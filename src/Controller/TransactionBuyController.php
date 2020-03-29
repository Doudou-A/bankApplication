<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TransactionBuyController extends AbstractController
{
    /**
     * @Route("/transaction/buy", name="transaction_buy")
     */
    public function index()
    {
        return $this->render('transaction_buy/index.html.twig', [
            'controller_name' => 'TransactionBuyController',
        ]);
    }
}
