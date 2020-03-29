<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductBuyController extends AbstractController
{
    /**
     * @Route("/product/buy", name="product_buy")
     */
    public function index()
    {
        return $this->render('product_buy/index.html.twig', [
            'controller_name' => 'ProductBuyController',
        ]);
    }
}
