<?php

namespace App\DataFixtures;

use App\Entity\ProfilUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    /**
     * 
     * @var Generator
     */
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr-FR');
    }
    public function load(ObjectManager $manager): void
    {
        
// Users
for ($j = 0; $j < 10; $j++) {
    $user = new ProfilUser();
    $user->setEmail($this->faker->email())
        ->setRoles(['ROLE_USER'])
        ->setPlainPassword('password')
        ->setGuest(mt_rand(0, 20));

    if ($j < 2) {
        $user->setRoles(['ROLE_ADMIN']);
    }

    $manager->persist($user);
}
}
}
