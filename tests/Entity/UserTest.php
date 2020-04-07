<?php

namespace App\Tests\Entity;

require('vendor/autoload.php');

use App\Entity\Task;
use App\Entity\User;
use App\Entity\Account;
use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\ArrayCollection;

class UserTest extends TestCase
{
    public function testId()
    {
        $user = new User();

        $this->assertEquals(null, $user->getId());
    }

    public function testUsername()
    {
        $user = new User();
        $username = "Test";

        $user->setUsername($username);
        $this->assertEquals("Test", $user->getUsername());
    }

    public function testRoles()
    {
        $user = new User();
        $roles= ["ROLE_TEST"];

        $user->setRoles($roles);

        $this->assertEquals("ROLE_TEST", $user->getRoles()[0]);
    }

    public function testPassword()
    {
        $user = new User();
        $password= "PasswordTest";

        $user->setPassword($password);

        $this->assertEquals("PasswordTest", $user->getPassword());
    }

    public function testGetSalt()
    {
        $user = new User();

        $this->assertEquals(null, $user->getSalt());
    }

    public function testEraseCredentialst()
    {
        $user = new User();

        $this->assertEquals(null, $user->eraseCredentials());
    }

    public function testaccountAdd()
    {
        $account = new Account();
        $user = new User();

        $user->addAccount($account);

        $this->assertEquals($user, $account->getUser());
    }   

    public function testGetAccount()
    {
        $user = new User();
        $accounts = new ArrayCollection();

        $this->assertEquals($accounts, $user->getAccounts());
    }  
    
    public function testAccountRemove()
    {
        $user = new User();
        $account = new Account();

        $user->addAccount($account);
        $user->removeAccount($account);
        
        $this->assertEquals(null, $account->getUser());
    }  
}
