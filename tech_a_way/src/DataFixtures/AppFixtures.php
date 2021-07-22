<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Picture;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use DateTime;


class AppFixtures extends Fixture
{
     private $passwordHasher; 
     public function __construct(UserPasswordHasherInterface $passwordHasher){
         $this->passwordHasher = $passwordHasher; 
     }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');


        $categoryListName = [
            'Audio et Hi-Fi',
            'Vidéo',
            'Informatique',
            'Téléphones Portables et Fixes'
        ];
        

        for ($i = 0; $i< count($categoryListName); $i++) {

            $category = new Category();
            $category->setName($categoryListName[$i]);

            $category->setSubtitle("Catégorie : " . $faker->name);
            $category->setPicture($faker->name() . ".jpg");


                for ($subCategoryNumber = 1; $subCategoryNumber <= 5; $subCategoryNumber++) {

                    $subCategory = new Category();
                    $subCategory->setName($faker->name());
                    $subCategory->setSubtitle("sous-catégorie ! " . $faker->name);
                    $subCategory->setPicture($faker->name() . ".jpg");


                        for ($subSubCategoryNumber = 1; $subSubCategoryNumber <= 7; $subSubCategoryNumber++) {

                            $subSubCategory = new Category();
                            $subSubCategory->setName($faker->name());
                            $subSubCategory->setSubtitle("sous-sous-catégorie ! " . $faker->name);
                            $subSubCategory->setPicture($faker->name() . ".jpg");

                            $subCategory->addSubcategory($subSubCategory);
                            $manager->persist($subSubCategory);
                        }

                        $category->addSubcategory($subCategory);

                    
                    // Include the data waiting list
                    $manager->persist($subCategory);
                }


            $manager->persist($category);
        }
























        $brandList = [
            [
                'name' => 'Acer',
                'picture' => 'acer.png'
            ],
            ['name' => 'Apple', 'picture' => 'apple.jpg'],
            ['name' => 'Asus', 'picture' => 'asus.png'],
            ['name' => 'Dell', 'picture' => 'dell.png'],
            ['name' => 'Lg', 'picture' => 'lg.jpg'],
            ['name' => 'Nokia', 'picture' => 'nokia.png'],
            ['name' => 'Panasonic', 'picture' => 'panasonic.png'],
            ['name' => 'Philips', 'picture' => 'philips.png'],
            ['name' => 'Samsung', 'picture' => 'samsung.png'],
            ['name' => 'Sony', 'picture' => 'sony.jpg'],
            ['name' => 'Toshiba', 'picture' => 'toshiba.jpg'],
            ['name' => 'Xiaomi', 'picture' => 'xiaomi.png']
        ];

        // Create 5 brands !!
        foreach ($brandList as $currentBrand) {

            $brand = new Brand();
            $brand->setName($currentBrand['name']);

            $brand->setLogo($currentBrand['picture']);

            // Create 30 products !!
            for ($productNumber = 1; $productNumber <= 10; $productNumber++) {
                $ExclTaxesPrice = $faker->numberBetween(0, 1000);
                $setSalesTax = 20;

                $product = new Product();
                $product->setName($faker->sentence($nbWords = 1, $variableNbWords = true));


                $product->setExclTaxesPrice($faker->numberBetween(0, 1000) . "." . $faker->numberBetween(0, 99));
                $product->setSalesTax($setSalesTax);
                $product->setInclTaxesPrice($ExclTaxesPrice + ($ExclTaxesPrice * $setSalesTax));
                $product->setReference($faker->numberBetween(11, 99));
                $product->setDescription($faker->text());
                $product->setStock($faker->numberBetween(0, 500));

              

                



                    for ($pictureNumber = 1; $pictureNumber <=5; $pictureNumber++) {

                        $picture = new Picture();
                        $picture->setName($faker->name() . ".jpg");

                        $product->addPicture($picture);
                        $manager->persist($picture);
                    }

                    $brand->addProduct($product);


                
                // Include the data waiting list
                $manager->persist($product);
            }
            // Include the data waiting list
            $manager->persist($brand);
        }

        $userList = [
   
            ['firstname' => 'Benoit', 'lastname' => 'QUENTIN','phone_number' => '0669857452', 'email' => 'benquel@gmail.com','role' => '["ROLE_SUPER_ADMIN"]', 'password' => 'techaway1'],
            ['firstname' => 'Frédéric', 'lastname' => 'GUILLON','phone_number' => '0685426284', 'email' => 'fred@gmail.com','role' => '["ROLE_SUPER_ADMIN"]', 'password' => 'techaway2'],
            ['firstname' => 'Jamal', 'lastname' => 'EL','phone_number' => '0664571245', 'email' => 'jamal@gmail.com','role' => '["ROLE_SUPER_ADMIN"]', 'password' => 'techaway3'],
            ['firstname' => 'Mickael', 'lastname' => 'GEERARDYN','phone_number' => '0685647592', 'email' => 'mick@gmail.comm','role' => '["ROLE_SUPER_ADMIN"]', 'password' => 'techaway4']
        ];

        foreach ($userList as $currentUser) {
            
            $adminUser = new User();           

            $adminUser->setFirstname($currentUser[('firstname')]);
            $adminUser->setLastname($currentUser[('lastname')]);
            $adminUser->setPhoneNumber('06' . $faker->randomNumber(8));
            $adminUser->setEmail($currentUser[('email')]);
            $adminUser->setRole($currentUser[('role')]);
            $adminUser->setPassword(($currentUser[('password')]));
            $adminUser->setStatus(1);
            // $adminUser->setBirthdate(new DateTime($currentUser[('birthdate')]));
            $adminUser->setBirthdate(new Datetime($faker->dateTimeThisCentury->format('Y-m-d')));


            //$faker->dateTimeThisCentury->format('Y-m-d')
            // Include the data waiting list
            $manager->persist($adminUser);
        }
        // We register the products in BDD
        $manager->flush();
    }
}
