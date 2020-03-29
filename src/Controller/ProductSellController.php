<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductSellController extends AbstractController
{
    /**
     * @Route("/product/sell", name="product_sell")
     */
    public function index()
    {
        return $this->render('product_sell/index.html.twig', [
            'controller_name' => 'ProductSellController',
        ]);
    }
}
