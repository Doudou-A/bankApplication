<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TransactionSaleController extends AbstractController
{
    /**
     * @Route("/transaction/sale", name="transaction_sale")
     */
    public function index()
    {
        return $this->render('transaction_sale/index.html.twig', [
            'controller_name' => 'TransactionSaleController',
        ]);
    }
}
