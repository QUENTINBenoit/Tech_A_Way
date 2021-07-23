<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\ModeOfPayment;
use App\Entity\Order;
use App\Entity\OrderLine;
use App\Entity\Picture;
use App\Entity\Product;
use App\Entity\Status;
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
        //faker is used to generate fake data.
        $faker = Faker\Factory::create('fr_FR');

        // List of main Categories
        $categoryListName = [
            'Audio et Hi-Fi',
            'Vidéo',
            'Informatique',
            'Téléphones Portables et Fixes'
        ];
        
        // creation of array empty to put object category in order to associate them later with the products 
        $arrayofObject = [];


        // On boucle d'abord sur le tableau $categoryListName
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
                            $arrayofObject[]= $subSubCategory;
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
            for ($productNumber = 0; $productNumber <= 9; $productNumber++) {
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

                // we generate randomNumber to link products on category and link the same product with subcategory of category, and link the same product with subsubcategory of subcategory
                $randomNumber = intval($faker->numberBetween(0, (count($arrayofObject)-1)));
                $product->addCategory($arrayofObject[$randomNumber]);
                $product->addCategory($arrayofObject[$randomNumber]->getCategory());
                $product->addCategory($arrayofObject[$randomNumber]->getCategory()->getCategory());
               
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



















// PART2 ****************************************************************************
        $statusName = [
            'En cours - non payé',
            'En cours - payé colis non envoyé',
            'En cours - payé colis envoyé',
            'terminé',
            'abandonné'
        ];
        // creation of array empty to put object category in order to associate them later with the products 
        $arrayofObjectStatus = [];
        // On boucle d'abord sur le tableau $categoryListName
        for ($i = 0; $i< count($statusName); $i++) {
            $status = new Status();
            $status->setName($statusName[$i]);

            $arrayofObjectStatus[]= $status;
            $manager->persist($status);
        }

        $typeOfPayment = [
            'American express',
            'Bitcoin',
            'CB',
            'Mastercard',
            'Paypal',
            'Visa Electron',
            'Visa'
        ];
        // creation of array empty to put object category in order to associate them later with the products 
        $arrayofObjectModeOfPayment = [];
        // On boucle d'abord sur le tableau $categoryListName
        for ($i = 0; $i< count($typeOfPayment); $i++) {
            $modeOfPayment = new ModeOfPayment();
            $modeOfPayment->setType($typeOfPayment[$i]);

            $arrayofObjectModeOfPayment[]= $modeOfPayment;
            $manager->persist($modeOfPayment);
        }





        for ($userNumber = 0; $userNumber <= 19; $userNumber++) {

            $user = new User();

            $user ->setFirstname($faker->firstName());
            $user ->setLastname($faker->lastName());
            $user ->setPhoneNumber('06' . $faker->randomNumber(8));
            $user ->setEmail($faker->lastName());
            $user ->setRole('["ROLE_USER"]');
            $user ->setPassword($faker->password());
            $user ->setStatus(1);
            $user ->setBirthdate(new Datetime($faker->dateTimeThisCentury->format('Y-m-d')));

            for ($i = 0; $i <= 9; $i++) {
                $address = new Address();
                $address->setType('chronopost');
                $address->setStreet('rue machin');
                $address->setZipcode('75');
                $address->setCity('Paris');


                $user->addAddress($address);
                $manager->persist($address);
            }

            for ($orderNumber = 0; $orderNumber <= 9; $orderNumber++) {

                $order = new Order();
                $order->setNumber(50);
                $order->setTypeDelivery('chronopost');
                $order->setStreetDelivery('rue machin livraison');
                $order->setZipcodeDelivery('75');
                $order->setCityDelivery('Paris livraison');
                $order->setStreetBill('rue machin facturation');
                $order->setZipcodeBill('72');
                $order->setCityBill('Le mans facturation');



                    for ($orderLineNumber = 1; $orderLineNumber <=5; $orderLineNumber++) {
                        $ExclTaxesPrice = $faker->numberBetween(0, 1000);
                        $setSalesTax = 20;

                        $orderLine = new OrderLine();
                        $orderLine->setProductName($faker->name());
                        $orderLine->setQuantity(25);
                        $orderLine->setExclTaxesUnitPrice($faker->numberBetween(0, 1000) . "." . $faker->numberBetween(0, 99));
                        $orderLine->setSalesTax($setSalesTax);
                        $orderLine->setInclTaxesUnitPrice($faker->numberBetween(0, 500));
          

                        $order->addOrderLine($orderLine);
                        $manager->persist($orderLine);
                    }

                    $user->addOrder($order);

  
                $randomNumber = intval($faker->numberBetween(0, (count($arrayofObjectStatus)-1)));
                $order->setStatus($arrayofObjectStatus[$randomNumber]);

                $randomNumber = intval($faker->numberBetween(0, (count($arrayofObjectModeOfPayment)-1)));
                $order->setModeOfPayment($arrayofObjectModeOfPayment[$randomNumber]);
        
               
                // Include the data waiting list
                $manager->persist($order);
            }
            // Include the data waiting list
            $manager->persist($user);
        }




















        // We register the products in BDD
        $manager->flush();
    }
}
