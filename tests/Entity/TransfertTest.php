<?php

namespace App\Tests\Entity;

require('vendor/autoload.php');

use DateTime;
use App\Entity\User;
use App\Entity\Account;
use App\Entity\Transfert;
use PHPUnit\Framework\TestCase;

class TransfertTest extends TestCase
{
    public function testId()
    {
        $transfert = new Transfert();

        $this->assertEquals(null, $transfert->getId());
    }

    public function testUsername()
    {
        $user = new User();
        $username = "Test";

        $user->setUsername($username);
        $this->assertEquals("Test", $user->getUsername());
    }

    public function testAmount()
    {
        $transfert = new Transfert();
        $amount= 250;

        $transfert->setAmount($amount);

        $this->assertEquals($amount, $transfert->getAmount());
    }

    public function testDateCreated()
    {
        $transfert = new Transfert();
        $dateTime = new DateTime("10:01:00");

        $transfert->setDateCreated($dateTime);
        $this->assertEquals(new DateTime("10:01:00"), $transfert->getDateCreated());
    }

    public function testAccountToDebit()
    {
        $transfert = new Transfert();
        $accountToDebit = new Account();
        $transfert->setAccountToDebit($accountToDebit);
        
        $this->assertEquals(new Account(), $transfert->getAccountToDebit());
    }   

    public function testAccountToCredit()
    {
        $transfert = new Transfert();
        $accountToCredit = new Account();
        $transfert->setAccountToCredit($accountToCredit);
        
        $this->assertEquals(new Account(), $transfert->getAccountToCredit());
    }   
}
