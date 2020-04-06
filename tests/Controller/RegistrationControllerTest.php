<?php

namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testRegistration()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/register');

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Register')->form();

        $form['registration_form[username]'] = 'administration';
        $form['registration_form[plainPassword]'] = 'password';
        $form['registration_form[agreeTerms]'] = 1 ;

        $client->submit($form);

        $crawler = $client->followRedirect();

        /* echo $client->getResponse()->getContent(); */
        $this->assertSame(1, $crawler->filter('html:contains("Please sign in")')->count());
    }
}
