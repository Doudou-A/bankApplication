<?php

namespace App\DataFixtures;

use Composer\Factory;
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
        $categorys = [];
        $figures = [];
        $filesFigure = [
            'dbcdbae3ae508e8c9a46ba61d45d6136.jpeg',
            '21ce571edc427fb10aa74edac77ecf3c.jpeg',
            '2e26f5f98a5af418e1a33954d68aa326.jpeg',
            '05b0b8eabad2b5f2ec3269b51246ec8f.jpeg',
            '7bb010227fbca7126c793a0de3f15dcf.jpeg',
            '209ff159f6a206392fe90bdcc57dbc5b.jpeg',
            'aa1271b44f485696e4e1274aa50a9514.jpeg',
            'c158866b93282205720c314e11857a05.jpeg',
            'd6c44dc48699d85f5719a7907096e5fd.jpeg',
            'e0c75bf1081783b89b365900a33a505f.jpeg'
        ];

        for ($i = 0; $i < 6; $i++) {
            $user = new User();
            $user->setUsername($faker->userName)
                ->setImage($faker->randomElement($filesUser))
                ->setEmail($faker->email)
                ->setPassword($this->encoder->encodePassword($user, 'password'))
                ->setToken(rand())
                ->setConfirm(true)
                ->setDateCreated($faker->dateTime);

            $manager->persist($user);
            $users[] = $user;
        }

        for ($j = 0; $j < 3; $j++) {
            $category = new Category();
            $category->setName($faker->tld);

            $manager->persist($category);
            $categorys[] = $category;
        }

        for ($k = 0; $k < 32; $k++) {
            $figure = new Figure();
            $figure->setName($faker->domainWord)
                ->setUser($faker->randomElement($users))
                ->setImage($faker->randomElement($filesFigure))
                ->setContent($faker->text)
                ->setCategory($faker->randomElement($categorys))
                ->setDateCreated($faker->dateTime);

            $manager->persist($figure);
            $figures[] = $figure;
        }

        for ($l = 0; $l < 96; $l++) {
            $media = new Media();
            $media->setFigure($faker->randomElement($figures))
                ->setUrl($faker->randomElement($UrlImage))
                ->setType('image');

            $manager->persist($media);
        }

        for ($m = 0; $m < 365; $m++) {
            $comment = new Comment();
            $comment->setFigure($faker->randomElement($figures))
                ->setUser($faker->randomElement($users))
                ->setContent($faker->sentence)
                ->setDateCreated($faker->dateTime);

            $manager->persist($comment);
        }
        $manager->flush();
    }
}
