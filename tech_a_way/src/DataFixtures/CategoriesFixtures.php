<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;



class CategoriesFixtures extends Fixture 
{
    public function load(ObjectManager $manager)
    {
        

       // create 20 products! Bam!
       for ($i = 0; $i < 4; $i++) {
        $category = new Category();
        $category->setName('Son et image '.$i , 'Informatique' .$i , 'Téléphonie' .$i , 'Objet connecté' .$i);
        $manager->persist($category);
    }

    $manager->flush();
    }
}