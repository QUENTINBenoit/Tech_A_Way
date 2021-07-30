<?php

namespace App\DataFixtures;


use DateTime;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;



class UserFixtures extends Fixture
{
    private $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');


        $rolesList = [
                        ["ROLE_USER"],
                        ["ROLE_CATALOG_MANAGER"],
                        ["ROLE_ADMIN"]
                    ];

        for ($userNumber = 0; $userNumber < $faker->numberBetween(10, 50); $userNumber++) {
            $user = new User();
            $user ->setFirstname($faker->firstName());
            $user ->setLastname($faker->lastName());
            $user ->setPhoneNumber('06' . $faker->randomNumber(8));
            $user ->setEmail($faker->email());
            $user ->setRoles($rolesList[$faker->numberBetween(0, (count($rolesList) -1))]);
            $user ->setPassword('$2y$13$AmMvdO6CynQ8qx197C79b.xJmiv2rS0Or0c4V2pG6TSsp4UlrLhPO'); // same password : "mdp123"
            $user ->setStatusUser(1);
            $user ->setBirthdate(new Datetime($faker->dateTimeThisCentury->format('Y-m-d')));
                        
            $manager->persist($user);
        }

        $manager->flush();
    }
}