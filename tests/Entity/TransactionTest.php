<?php

namespace App\Tests\Entity;

require('vendor/autoload.php');

use DateTime;
use App\Entity\Account;
use App\Entity\Transaction;
use PHPUnit\Framework\TestCase;

class TransactionTest extends TestCase
{
    public function testId()
    {
        $transaction = new Transaction();

        $this->assertEquals(null, $transaction->getId());
    }

    public function testName()
    {
        $transaction = new Transaction();
        $name = 'test name';

        $transaction->setName($name);

        $this->assertEquals($name, $transaction->getName());
    }

    public function testPrice()
    {
        $transaction = new Transaction();
        $price = 30;

        $transaction->setPrice($price);

        $this->assertEquals($price, $transaction->getPrice());
    }

    public function testStatus()
    {
        $transaction = new Transaction();
        $status = 0;

        $transaction->setStatus($status);

        $this->assertEquals($status, $transaction->getStatus());
    }

    public function testDateCreated()
    {
        $transaction = new Transaction();
        $dateTime = new DateTime("10:01:00");

        $transaction->setDateCreated($dateTime);
        $this->assertEquals(new DateTime("10:01:00"), $transaction->getDateCreated());
    }

    public function testAccount()
    {
        $transaction = new Transaction();
        $account = new Account();

        $transaction->setAccount($account);

        $this->assertEquals($account, $transaction->getAccount());
    }
}