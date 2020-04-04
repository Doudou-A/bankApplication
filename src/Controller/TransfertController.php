<?php

namespace App\Controller;

use App\DOI\TransfertRequest;
use App\Form\TransfertFormType;
use App\Repository\AccountRepository;
use App\Service\AccountManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TransfertController extends AbstractController
{
    /**
     * @Route("/transfert", name="transfert")
     */
    public function index(Request $request, AccountRepository $repo, AccountManager $accountManager)
    {
        /* $userId = $this->getUser()->getId(); */
        $user = $this->getUser();
        $accounts = $repo->findByUser($user); 

        foreach($accounts as $account)
        {
            $accountsNumber[] = [$account->getNumber() => 'number'];
        }
        $transfertRequest = new TransfertRequest;

        $form = $this->createForm(TransfertFormType::class, $transfertRequest, [
            'accountsNumber' => $accountsNumber,]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $account_to_debit = $accountManager->getAccountByNumber($transfertRequest->account_to_debit);
            dd($account_to_debit);

        }
        return $this->render('transfert/transfert.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
