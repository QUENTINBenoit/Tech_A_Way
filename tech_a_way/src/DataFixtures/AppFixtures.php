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
            $adminUser->setStatusUser(1);
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
            $user ->setStatusUser(1);
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
