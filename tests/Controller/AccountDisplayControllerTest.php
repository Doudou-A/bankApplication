<?php

namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AccountDisplayControllerTest extends WebTestCase
{
    public function testDisplayAccount()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'Administrator',
            'PHP_AUTH_PW'   => 'password',
        ]);

        $crawler = $client->request('GET', '/account/2');

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $this->assertSame(1, $crawler->filter('html:contains("Add a Transaction")')->count());
    }
}
