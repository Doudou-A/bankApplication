<?php

namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TransactionControllerTest extends WebTestCase
{
    public function testTransactionSell()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'Administrator',
            'PHP_AUTH_PW'   => 'password',
        ]);

        $crawler = $client->request('GET', '/transaction/2');

        $form = $crawler->selectButton('Ajouter')->form();

        $form['transaction_form[name]'] = 'Bike';
        $form['transaction_form[price]'] = 234 ;
        $form['transaction_form[status]'] = 0 ;

        $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $this->assertSame(1, $crawler->filter('html:contains("Dashboard")')->count());
    }

    public function testTransactionBuy()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'Administrator',
            'PHP_AUTH_PW'   => 'password',
        ]);

        $crawler = $client->request('GET', '/transaction/2');

        $form = $crawler->selectButton('Ajouter')->form();

        $form['transaction_form[name]'] = 'Bike';
        $form['transaction_form[price]'] = 234 ;
        $form['transaction_form[status]'] = 1 ;

        $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $this->assertSame(1, $crawler->filter('html:contains("Dashboard")')->count());
    }
}
