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

/***********************************PART 1: CATEGORY/PRODUCT/BRAND/PICTURE*************************************************************/   
        // List of main Categories
        $categoryListName = [
            'Audio et Hi-Fi',
            'Vidéo',
            'Informatique',
            'Téléphones Portables et Fixes'
        ];
        
        // creation of array empty to put object category in order to associate them later with the products 
        $arrayofObjectCategory = [];

        // On boucle d'abord sur le tableau $categoryListName
        for ($i = 0; $i< count($categoryListName); $i++) {
            $category = new Category();
            $category->setName($categoryListName[$i]);
            $category->setSubtitle("subtitle Catégorie : " . $faker->name);
            $category->setPicture($faker->firstname() . ".jpg");

                for ($subCategoryNumber = 0; $subCategoryNumber < $faker->numberBetween(2, 4); $subCategoryNumber++) {
                    $subCategory = new Category();
                    $subCategory->setName($faker->name());
                    $subCategory->setSubtitle("subtitle sous-catégorie ! " . $faker->name);
                    $subCategory->setPicture($faker->firstname() . ".jpg");

                        for ($subSubCategoryNumber = 0; $subSubCategoryNumber < $faker->numberBetween(2, 5); $subSubCategoryNumber++) {
                            $subSubCategory = new Category();
                            $subSubCategory->setName($faker->name());
                            $subSubCategory->setSubtitle("subtitle sous-sous-catégorie ! " . $faker->name);
                            $subSubCategory->setPicture($faker->firstname() . ".jpg");

                            $subCategory->addSubcategory($subSubCategory);
                            $arrayofObjectCategory[]= $subSubCategory;
                            $manager->persist($subSubCategory);
                        }
                    
                    $category->addSubcategory($subCategory);
                    // Include the data waiting list
                    $manager->persist($subCategory);
                }
            $manager->persist($category);
        }

        $brandList = [
            ['name' => 'Acer', 'picture' => 'acer.png'],
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
        foreach ($brandList as $currentBrand) {
            $brand = new Brand();
            $brand->setName($currentBrand['name']);
            $brand->setLogo($currentBrand['picture']);

            for ($productNumber = 0; $productNumber < $faker->numberBetween(15, 70); $productNumber++) {
                $ExclTaxesPrice = $faker->numberBetween(0, 1000).".".$faker->numberBetween(0, 99);
                $setSalesTax = 20;
                $InclTaxesPrice = $ExclTaxesPrice + ($ExclTaxesPrice * ($setSalesTax/100));

                $product = new Product();
                $product->setName($faker->sentence($nbWords = 1, $variableNbWords = true));
                $product->setExclTaxesPrice($ExclTaxesPrice);
                $product->setSalesTax($setSalesTax);
                $product->setInclTaxesPrice(round($InclTaxesPrice, 2));
                $product->setReference($faker->numberBetween(11, 99));
                $product->setDescription($faker->text());
                $product->setStock($faker->numberBetween(0, 500));

                    for ($pictureNumber = 0; $pictureNumber <=$faker->numberBetween(1, 10); $pictureNumber++) {
                        $picture = new Picture();
                        $picture->setName($faker->firstname() . ".jpg");

                        $product->addPicture($picture);
                        $manager->persist($picture);
                    }
                
                $brand->addProduct($product);

                // we generate randomNumber to link products on category and link the same product with subcategory of category, and link the same product with subsubcategory of subcategory
                $randomNumber = intval($faker->numberBetween(0, (count($arrayofObjectCategory)-1)));
                $product->addCategory($arrayofObjectCategory[$randomNumber]);
                $product->addCategory($arrayofObjectCategory[$randomNumber]->getCategory());
                $product->addCategory($arrayofObjectCategory[$randomNumber]->getCategory()->getCategory());
               
                // Include the data waiting list
                $manager->persist($product);
            }
            // Include the data waiting list
            $manager->persist($brand);
        }

/***********************************PART 2: USER/ORDER/STATUS/ORDERLINE/MODEOFPAYMENT/ADDRESS*************************************************************/   
        $userList = [
            ['firstname' => 'Benoit', 'lastname' => 'QUENTIN', 'email' => 'benquel@gmail.com'],
            ['firstname' => 'Frédéric', 'lastname' => 'GUILLON', 'email' => 'fred@gmail.com'],
            ['firstname' => 'Jamal', 'lastname' => 'EL', 'email' => 'jamal@gmail.com'],
            ['firstname' => 'Mickael', 'lastname' => 'GEERARDYN', 'email' => 'mick@gmail.comm']
        ];

        $rolesListAdmin = [
            ["ROLE_SUPER_ADMIN"]
        ];
        foreach ($userList as $currentUser) {
            $adminUser = new User();           
            $adminUser->setFirstname($currentUser[('firstname')]);
            $adminUser->setLastname($currentUser[('lastname')]);
            $adminUser->setPhoneNumber('06' . $faker->randomNumber(8));
            $adminUser->setEmail($currentUser[('email')]);
            $adminUser ->setRoles($rolesListAdmin[0]);
            $adminUser->setPassword('$2y$13$QtsNMqjme0ZfYSvgT81Ns.a3XmNZDH92aMqpKAx1xmzKGr9aQMlJ6'); // same password : "tech a way"
            $adminUser->setStatus(1);
            // $adminUser->setBirthdate(new DateTime($currentUser[('birthdate')]));
            $adminUser->setBirthdate(new Datetime($faker->dateTimeThisCentury->format('Y-m-d')));

            //$faker->dateTimeThisCentury->format('Y-m-d')
            // Include the data waiting list
            $manager->persist($adminUser);
        }

        $statusName = [
            'En cours - non payé',
            'En cours - payé colis non envoyé',
            'En cours - payé colis envoyé',
            'terminé : colis reçu',
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
            $user ->setStatus(1);
            $user ->setBirthdate(new Datetime($faker->dateTimeThisCentury->format('Y-m-d')));

            $typeDelivery = [
                'colissimo',
                'chronopost',
                'relai colis',
            ];


            for ($i = 0; $i < $faker->numberBetween(1, 4); $i++) {
                $address = new Address();
                $address->setType($typeDelivery[$faker->numberBetween(0, (count($typeDelivery)-1))]);
                $address->setStreet($faker->streetAddress());
                $address->setZipcode($faker->numberBetween(1, 9).$faker->numberBetween(1, 9).$faker->numberBetween(1, 9).$faker->numberBetween(1, 9).$faker->numberBetween(1, 9));
                $address->setCity($faker->city());

                $user->addAddress($address);
                $manager->persist($address);
            }

            for ($orderNumber = 0; $orderNumber < $faker->numberBetween(1, 20); $orderNumber++) {
                $order = new Order();
                $order->setNumber(50);
                $order->setTypeDelivery($typeDelivery[$faker->numberBetween(0, (count($typeDelivery)-1))]);
                $order->setStreetDelivery($faker->streetAddress());
                $order->setZipcodeDelivery($faker->numberBetween(1, 9).$faker->numberBetween(1, 9).$faker->numberBetween(1, 9).$faker->numberBetween(1, 9).$faker->numberBetween(1, 9));
                $order->setCityDelivery($faker->city());
                $order->setStreetBill($faker->streetAddress());
                $order->setZipcodeBill($faker->numberBetween(1, 9).$faker->numberBetween(1, 9).$faker->numberBetween(1, 9).$faker->numberBetween(1, 9).$faker->numberBetween(1, 9));
                $order->setCityBill($faker->city());

                    for ($orderLineNumber = 0; $orderLineNumber < $faker->numberBetween(1, 10); $orderLineNumber++) {
                        $ExclTaxesPrice = $faker->numberBetween(0, 1000).".".$faker->numberBetween(0, 99);
                        $setSalesTax = 20;
                        $InclTaxesPrice = $ExclTaxesPrice + ($ExclTaxesPrice * ($setSalesTax/100));

                        $orderLine = new OrderLine();
                        $orderLine->setProductName($faker->name());
                        $orderLine->setQuantity($faker->numberBetween(1, 5));
                        $orderLine->setExclTaxesUnitPrice($ExclTaxesPrice);
                        $orderLine->setSalesTax($setSalesTax);
                        $orderLine->setInclTaxesUnitPrice(round($InclTaxesPrice, 2));
          
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
