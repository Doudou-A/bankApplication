<?php

namespace App\Controller;

use App\Entity\Account;
use App\DOI\CreateAccount;
use App\Form\AccountFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountAddController extends AbstractController
{
    /**
     * @Route("/account/add", name="account_add")
     */
    public function index(Request $request, EntityManagerInterface $manager)
    {
        $createAccount = new CreateAccount;

        $form = $this->createForm(AccountFormType::class, $createAccount);
        $form->handleRequest($request);

        if($form ->isSubmitted() && $form->isValid())
        {
            $account = new Account;
            $account->setNumber($createAccount->number);
            $account->setMoney(0);
            $manager->persist($account);
            $manager->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('account_add/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
