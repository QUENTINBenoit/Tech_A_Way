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
        $majorCategoryList = [

            // I am testing a nested table to link the major categories to the relevant
            // subcategories

            'Son et images',
            'Informatiques',
            'Objet connecté',
            'Téléphonie',

            
        ];

        $subCategoriesSonAndImageList = [
            'Son',
            'Images'
            
        ];

     $underSubCategorySon = [
         'Homecinema',
         'Barre de son',
         'Enceintes',
         'Casque/Ecouteur'
     ];
        

        foreach ($majorCategoryList as $currentCategory){
            
            $category = new Category();

            $category->setName($currentCategory);
            $category->setSubtitle('Son or not Son');
            $subCategory = new Category;
            $subCategory->setName('Homecinema') ;
            $category->addSubcategory($subCategory);
            $manager->persist($subCategory);
            $manager->persist($category);
        }

        

        
        
        

        $manager->flush();
    }
}
