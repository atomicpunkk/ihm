<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{  
  /**
   * L'encodeur de mots de passe
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
	$faker = Factory::create('fr_Fr');    
        // $product = new Product();
        // $manager->persist($product);
	
	for ($u	= 0; $u < 30; $u++) {
		$user = new User();
		
		$hash = $this->encoder->encodePassword($user, "password");

		$user->setUsername($faker->userName())
	             ->setPassword($hash);
		$manager->persist($user);
			

	}



        $manager->flush();
    }
}
