<?php 

namespace App\Service;

use Doctrine\ORM\EntityManager;

class AccountManager
{
    private $manager;

    public function __construct(EntityManager $manager)
    {
        $this->manager =$manager;
        
    }

    public function addAccount()
    {
        
    }

}
