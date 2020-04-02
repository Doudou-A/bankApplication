<?php

namespace App\Controller;

use App\DOI\TransfertRequest;
use App\Form\TransfertFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TransfertController extends AbstractController
{
    /**
     * @Route("/transfert", name="transfert")
     */
    public function index(Request $request)
    {
        $user = $this->getUser();

        $transfertRequest = new TransfertRequest;

        $form = $this->createForm(TransfertFormType::class, $transfertRequest);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

        }
        return $this->render('transfert/index.html.twig', [
            'controller_name' => 'TransfertController',
        ]);
    }
}
