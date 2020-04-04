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
            $user ->setUsername($faker->firstName)
                  ->setPassword($this->encoder->encodePassword($user, 'password'));
            
                  $manager->persist($user);
                  $users[] = $user;
            
        }

        for($j = 0; $j < 6; $j++){
            $account = new Account();
            $account ->setNumber(random_int (1000000,9999999))
                     ->setMoney(0)
                     ->setUser($faker->randomElement($users));
            
                  $manager->persist($account);
                  $accounts[] = $account;
            
        }

        for($k = 0; $k < 32; $k++){
            $transaction = new Transaction();

            $account = $faker->randomElement($accounts);
            $transaction ->setName($faker->domainWord)
                    ->setPrice(random_int(0,999.99))
                    ->setStatus($faker->randomElement($status))
                    ->setAccount($faker->randomElement($accounts))
                    ->setDateCreated($faker->dateTime);
            
                  $manager->persist($transaction);
                  $transactions[] = $transaction;

                  $account ->addTransaction($transaction);
                  $money = $account->getMoney();
                  $price = $transaction->getPrice();
                  if($transaction->getStatus() == 0)
                  {
                    $money = $money + $price;
                  } else {
                    $money = $money - $price;
                  }
                  $account->setMoney($money);
                  $manager->persist($account);
        }
        $manager->flush();
    } 
}
