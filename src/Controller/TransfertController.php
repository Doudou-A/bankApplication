<?php

namespace App\Controller;

use App\DOI\TransfertRequest;
use App\Entity\Transfert;
use App\Form\TransfertFormType;
use App\Repository\AccountRepository;
use App\Service\AccountManager;
use App\Service\TransfertManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TransfertController extends AbstractController
{
    /**
     * @Route("/transfert", name="transfert")
     */
    public function index(Request $request, TransfertManager $transfertManager, AccountManager $accountManager)
    {
        /* $userId = $this->getUser()->getId(); */
        $user = $this->getUser();

        $accountsNumber = $accountManager->getAccountsUser($user);
        
        $transfertRequest = new TransfertRequest;

        $form = $this->createForm(TransfertFormType::class, $transfertRequest, [
            'accountsNumber' => $accountsNumber,]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $amount = $transfertRequest->amount;

            $accountToDebit = $accountManager->accountDebitAmount($amount, $transfertRequest);
            
            $accountToCredit = $accountManager->getAccountByNumber($transfertRequest->accountToCredit);

            if($accountToDebit == $accountToCredit)
            {
                $sameAccountError = true;

                return $this->render('transfert/transfert.html.twig', [
                    'form' => $form->createView(),
                    'sameAccountError' => $sameAccountError
                ]);
            }
            $accountManager->accountCreditAmount($amount, $accountToCredit);

            $transfertManager->createTransfert($amount, $accountToCredit, $accountToDebit);

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('transfert/transfert.html.twig', [
            'form' => $form->createView(),
            'sameAccountError' => false
        ]);
    }
}
