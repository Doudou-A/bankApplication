<?php

namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TransfertControllerTest extends WebTestCase
{
    public function testDebitTransfert()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'Administrator',
            'PHP_AUTH_PW'   => 'password',
        ]);

        $crawler = $client->request('GET', '/transfert');

        $form = $crawler->selectButton('Ajouter')->form();

        $form['transfert_form[accountToDebit]'] = 2345678;
        $form['transfert_form[accountToCredit]'] = 23456764;
        $form['transfert_form[amount]'] = 234 ;

        $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $this->assertSame(1, $crawler->filter('html:contains("Dashboard")')->count());
    }

    public function testCreditTransfert()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'Administrator',
            'PHP_AUTH_PW'   => 'password',
        ]);

        $crawler = $client->request('GET', '/transfert');

        $form = $crawler->selectButton('Ajouter')->form();

        $form['transfert_form[accountToDebit]'] = 23456764;
        $form['transfert_form[accountToCredit]'] = 2345678;
        $form['transfert_form[amount]'] = 234 ;

        $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $this->assertSame(1, $crawler->filter('html:contains("Dashboard")')->count());
    }

    public function testSameAccountTransfert()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'Administrator',
            'PHP_AUTH_PW'   => 'password',
        ]);

        $crawler = $client->request('GET', '/transfert');

        $form = $crawler->selectButton('Ajouter')->form();

        $form['transfert_form[accountToDebit]'] = 2345678;
        $form['transfert_form[accountToCredit]'] = 2345678;
        $form['transfert_form[amount]'] = 234 ;

        $crawler = $client->submit($form);

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        //echo $client->getResponse()->getContent(); 
        $this->assertSame(1, $crawler->filter('html:contains("You can\'t transfert money between the same account")')->count());

        $form = $crawler->selectButton('Ajouter')->form();

        $form['transfert_form[accountToDebit]'] = 23456764;
        $form['transfert_form[accountToCredit]'] = 2345678;
        $form['transfert_form[amount]'] = 234 ;

        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $this->assertSame(1, $crawler->filter('html:contains("Dashboard")')->count());
    }
}
