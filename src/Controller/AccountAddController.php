<?php

namespace App\Controller;

use App\Entity\Account;
use App\Form\AccountFormType;
use App\DOI\CreateAccount;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountAddController extends AbstractController
{
    /**
     * @Route("/account/add", name="account_add")
     */
    public function index(Request $request, EntityManager $manager)
    {
        $createAccount = new CreateAccount;

        $form = $this->createForm(AccountFormType::class, $createAccount);
        $form->handleRequest($request);

        if($form ->isSubmitted() and $form->isValid())
        {
            $account = new Account ([
                'money' => $createAccount->money
            ]);

            $manager->persist($account);
            $manager->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('account_add/index.html.twig', [
            'controller_name' => 'AccountAddController',
        ]);
    }
}
