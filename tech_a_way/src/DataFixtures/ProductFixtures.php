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
            'name'=>'Iphone12',
            'name'=>'Note 10',
            'name'=>'Ipad 5',
        ];


        $faker = Faker\Factory::create('fr_FR');
        

        for ($productNumber = 0; $productNumber < $faker->numberBetween(15, 70); $productNumber++) {
            $ExclTaxesPrice = $faker->numberBetween(0, 1000).".".$faker->numberBetween(0, 99);
            $setSalesTax = 20;
            $InclTaxesPrice = $ExclTaxesPrice + ($ExclTaxesPrice * ($setSalesTax/100));
            // $brand = $this->getReference('brand_'. $faker->numberBetween(1,50));

        


            foreach ($productList   as $current) {
                $product = new Product;
                $product->setName($current);
                $product->setExclTaxesPrice($ExclTaxesPrice);
                $product->setSalesTax($setSalesTax);
                $product->setInclTaxesPrice(round($InclTaxesPrice, 2));
                $product->setReference($faker->numberBetween(11, 99));
                $product->setDescription($faker->text($baseText = 200));
                $product->setStock($faker->numberBetween(0, 500));
                $product->setBrand($this->getReference(BrandsFixtures::BRAND_REFERENCE));
                $product->addCategory($this->getReference((CategoriesFixtures::CATEGORY_REFERENCE)));
            

                $manager->persist($product);
            }
        }

        $manager->flush();
    }
}