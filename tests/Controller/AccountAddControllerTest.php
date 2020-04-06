<?php

namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AccountAddControllerTest extends WebTestCase
{
    public function testAddController()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'Administrator',
            'PHP_AUTH_PW'   => 'password',
        ]);

        $crawler = $client->request('GET', '/account/add');

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Ajouter')->form();

        $form['account_form[number]'] = '2345678';

        $client->submit($form);

        $crawler = $client->followRedirect();

        /* echo $client->getResponse()->getContent(); */
        $this->assertSame(1, $crawler->filter('html:contains("Dashboard")')->count());
    }
}
