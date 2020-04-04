<?php

namespace App\DataFixtures;


use Faker\Factory;
use App\Entity\User;
use App\Entity\Account;
use App\Entity\Transaction;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     *
     * @var UserPasswordEncoderInterface
     * 
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $users = [];
        $accounts = [];
        $status = [0,1];

        for($i = 0; $i < 3; $i++){
            $user = new User();
            $user ->setUsername($faker->userName)
                  ->setPassword($this->encoder->encodePassword($user, 'password'));
            
                  $manager->persist($user);
                  $users[] = $user;
            
        }

        for($j = 0; $j < 6; $j++){
            $account = new Account();
            $account ->setNumber(random_int (7,7))
                     ->setMoney(0)
                     ->setUser($faker->randomElement($users));
            
                  $manager->persist($account);
                  $accounts[] = $account;
            
        }

        for($k = 0; $k < 32; $k++){
            $transaction = new Transaction();

            $account = $faker->randomElement($accounts);
            $transaction ->setName($faker->domainWord)
                    ->setPrice($faker->randomElement($users))
                    ->setStatus($faker->randomElement($status))
                    ->setAccount($faker->randomElement($accounts))
                    ->setDateCreated($faker->dateTime);
            
                  $manager->persist($transaction);
                  $transactions[] = $transaction;

                  $account ->setTransaction($transaction);
                  $manager->persist($account);
        }
        $manager->flush();
    } 
}
