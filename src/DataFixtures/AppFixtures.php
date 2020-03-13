<?php

namespace App\DataFixtures;

use App\Entity\Comments;
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

      // Create my own account with permission admin
      $user = new Users();
      $user->setUsername('Floz42')
      ->setPassword($this->encoder->encodePassword($user, 'newpass'))
      ->setRoles('ROLE_ADMIN')
      ->setEmail('flo.carreclub@gmail.com');

      $manager->persist($user);

      $users = [];

      // Create 20 account with inforomations by faker bundle
      for ($i = 0; $i < 20; $i++) {
        $nb_words = mt_rand(5,20);

        $user = new Users();
        $user->setUsername($faker->userName)
            ->setPassword($this->encoder->encodePassword($user, 'password'))
            ->setRoles('ROLE_USER')
            ->setEmail($faker->email);
        $manager->persist($user);
        $users[] = $user;
      }

      // Create 20 comments with inforomations by faker bundle and user array
        for($j = 0; $j <= 20; $j++) {
          $user = $users[mt_rand(0, count($users) -1 )]; 

          $comment = new Comments();
          $comment->setComment($faker->sentence($nb_words))
                  ->setDate_comment(new \DateTime())
                  ->setUsers($user);
          $manager->persist($comment);
        }

        $manager->flush();
    }
}
