<?php

namespace App\Controller;

use App\DOI\CreateAccountRequest;
use App\Form\AccountFormType;
use App\Service\AccountManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountAddController extends AbstractController
{
    /**
     * @Route("/account/add", name="account_add")
     */
    public function index(Request $request, AccountManager $accountManager)
    {
        $createAccountRequest = new CreateAccountRequest;

        $form = $this->createForm(AccountFormType::class, $createAccountRequest);
        $form->handleRequest($request);

        if($form ->isSubmitted() && $form->isValid())
        {
            $accountManager->createAccount($createAccountRequest);

            $this->addFlash('success', 'Your account has been created !');

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('account_add/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
