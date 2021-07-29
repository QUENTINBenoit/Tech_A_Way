<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
Use Faker;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $productList = [
            'Iphone12',
            'Note 10',
            'Ipad 5',
        ];


        $faker = Faker\Factory::create('fr_FR');
        

        for ($productNumber = 0; $productNumber < $faker->numberBetween(15, 70); $productNumber++) {
            $ExclTaxesPrice = $faker->numberBetween(0, 1000).".".$faker->numberBetween(0, 99);
            $setSalesTax = 20;
            $InclTaxesPrice = $ExclTaxesPrice + ($ExclTaxesPrice * ($setSalesTax/100));

        



            $product = new Product();
            $product->setName($productList[0]);
            $product->setExclTaxesPrice($ExclTaxesPrice);
            $product->setSalesTax($setSalesTax);
            $product->setInclTaxesPrice(round($InclTaxesPrice, 2));
            $product->setReference($faker->numberBetween(11, 99));
            $product->setDescription($faker->text($baseText = 200));
            $product->setStock($faker->numberBetween(0, 500));

            $manager->persist($product);
        }

        $manager->flush();
    }
}