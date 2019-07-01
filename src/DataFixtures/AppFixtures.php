<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
	$faker = Factory::create('fr_Fr');    
        // $product = new Product();
        // $manager->persist($product);
	
	for ($u	= 0; $u < 30; $u++) {
		$user = new User();
		$user->setUsername($faker->userName())
	             ->setPassword("password");
		$manager->persist($user);
			

	}



        $manager->flush();
    }
}
