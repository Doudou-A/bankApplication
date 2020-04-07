<?php

namespace App\Tests\Entity;

require('vendor/autoload.php');

use App\Entity\User;
use App\Entity\Account;
use App\Entity\Transfert;
use App\Entity\Transaction;
use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\ArrayCollection;

class AccountTest extends TestCase
{
    public function testId()
    {
        $account = new Account();

        $this->assertEquals(null, $account->getId());
    }

    public function testNumber()
    {
        $account = new Account();
        $number = 2776355;

        $account->setNumber($number);

        $this->assertEquals($number, $account->getNumber());
    }

    public function testMoney()
    {
        $account = new Account();
        $money = 14;

        $account->setMoney($money);
        $this->assertEquals($money, $account->getMoney());
    }

    public function testUser()
    {
        $account = new Account();
        $user = new User();
        $account->setUser($user);
        
        $this->assertEquals(new User(), $account->getUser());
    }  

    public function testTransaction()
    {
        $account = new Account();
        $transaction = new Transaction();
        $account->addTransaction($transaction);
        
        $this->assertEquals($account, $transaction->getAccount());
    }  

    public function testTransactionRemove()
    {
        $account = new Account();
        $transaction = new Transaction();

        $account->addTransaction($transaction);
        $account->removeTransaction($transaction);
        
        $this->assertEquals(null, $transaction->getAccount());
    }  

    public function testTransfertsDebit()
    {
        $account = new Account();
        $transfert = new Transfert();
        $account->addTransfertsDebit($transfert);
        
        $this->assertEquals($account, $transfert->getAccountToDebit());
    }  

    public function testGetTransfertDebit()
    {
        $account = new Account();
        $transferts = new ArrayCollection();

        $this->assertEquals($transferts, $account->getTransfertsDebit());
    }  
    
    public function testTransfertsDebitRemove()
    {
        $account = new Account();
        $transfert = new Transfert();

        $account->addTransfertsDebit($transfert);
        $account->RemoveTransfertsDebit($transfert);

        $this->assertEquals(null, $transfert->getAccountToDebit());
    }  
    
    public function testGetTransfertCredit()
    {
        $account = new Account();
        $transferts = new ArrayCollection();

        $this->assertEquals($transferts, $account->getTransfertsCredit());
    } 

    public function testTransfertsCreditRemove()
    {
        $account = new Account();
        $transfert = new Transfert();

        $account->addTransfertsCredit($transfert);
        $account->RemoveTransfertsCredit($transfert);
        
        $this->assertEquals(null, $transfert->getAccountToCredit());
    }  
}
    