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
            1=> ['model'=>'produit1'],
            2=> ['model'=>'produit2'],
            3=> ['model'=>'produit3'],
            4=> ['model'=>'produit4'],
            5=> ['model'=>'produit5'],
            6=> ['model'=>'produit6'],
            7=> ['model'=>'produit7'],
            8=> ['model'=>'produit8'],
            9=> ['model'=>'produit9'],
          
        ];


        $faker = Faker\Factory::create('fr_FR');
        

       for ($productNumber = 0; $productNumber < $faker->numberBetween(15, 70); $productNumber++) {
            $ExclTaxesPrice = $faker->numberBetween(0, 1000).".".$faker->numberBetween(0, 99);
            $setSalesTax = 20;
            $InclTaxesPrice = $ExclTaxesPrice + ($ExclTaxesPrice * ($setSalesTax/100));


            foreach ($productList as $key=> $value) {
                $product = new Product;
                $product->setName($value['model']);
                $product->setExclTaxesPrice($ExclTaxesPrice);
                $product->setSalesTax($setSalesTax);
                $product->setInclTaxesPrice(round($InclTaxesPrice, 2));
                $product->setReference($faker->numberBetween(11, 99));
                $product->setDescription($faker->text(150));
                $product->setStock($faker->numberBetween(0, 500));
            
                    
                    $product->setBrand($this->getReference('brand_'.$faker->numberBetween(1, 12)));

                    $subSubcategory = $this->getReference('category_'.$faker->numberBetween(1,37));
                    $product->addCategory($subSubcategory);
                    $product->addCategory($subSubcategory->getCategory());
                    $product->addCategory($subSubcategory->getCategory()->getCategory());
                

                $manager->persist($product);
            }
       }

        $manager->flush();
    }
}