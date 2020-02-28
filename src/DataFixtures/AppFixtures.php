<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
  { 
    /**
    * Encodeur de mot de passe
    *
    * @var UserPasswordEncoderInterface
    */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {

      $faker = Factory::create();

      for ($i = 0; $i < 20; $i++) {
        $user = new Users();
        $user->setUsername($faker->userName)
            ->setPassword($this->encoder->encodePassword($user, 'password'))
            ->setRoles('ROLE_USER')
            ->setEmail($faker->email);

            $manager->persist($user);
            

      }
      


        $manager->flush();


 

    }
}
