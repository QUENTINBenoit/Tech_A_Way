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

            'Son/Images',
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
        

        /************************************************
         * =========================================
         * DATA SET FOR THE SOUND AND IMAGE CATEGORY
         * =========================================
         * 
         * here is the 'Image and sound' category, 
         * I have tried many ways to factor my code but
         * unfortunately my attempts have failed.
         * But the code works.
         *
         ************************************************/
            
        $categorySonAndImage = new Category();
        $categorySonAndImage->setName($majorCategoryList[0]);
        $categorySonAndImage->setSubtitle('Son or not Son');


            
        $subCategorySon = new Category;
        $subCategorySon->setName($subCategoriesSonAndImageList[0]) ;
        $subCategorySon->setCategory($subCategorySon);
        $categorySonAndImage->addSubcategory($subCategorySon);


        $subCategoryImage = new Category;
        $subCategoryImage->setName($subCategoriesSonAndImageList[1]);
        $categorySonAndImage->addSubcategory($subCategoryImage);

        $manager->persist($subCategoryImage);
        $manager->persist($subCategorySon);
        $manager->persist($categorySonAndImage);

        // Subcategories of the category Sound

        foreach ($underSubCategorySon as $current) 
        {
            $under = new Category;
            $under->setName($current);
            $subCategorySon->addSubcategory($under);
            $manager->persist($under);

        }

  

     
                /*$underSubCategorySonHomeCinema=new Category;
                $underSubCategorySonHomeCinema->setName($underSubCategorySon[0]);
                $subCategorySon->addSubcategory($underSubCategorySonHomeCinema);


                $underSubCategorySonSoundBar=new Category;
                $underSubCategorySonSoundBar->setName($underSubCategorySon[1]);
                $subCategorySon->addSubcategory($underSubCategorySonSoundBar);

                $underSubCategorySonSpeaker=new Category;
                $underSubCategorySonSpeaker->setName($underSubCategorySon[2]);
                $subCategorySon->addSubcategory($underSubCategorySonSpeaker);

                $underSubCategorySonHeadphone=new Category;
                $underSubCategorySonHeadphone->setName($underSubCategorySon[3]);
                $subCategorySon->addSubcategory($underSubCategorySonHeadphone);


        $manager->persist($underSubCategorySonHomeCinema);
        $manager->persist($underSubCategorySonSoundBar);
        $manager->persist($underSubCategorySonSpeaker);
        $manager->persist($underSubCategorySonHeadphone);



*/


        // Subcategories of the Image category
        
            





        

        

        
        
        

        $manager->flush();
    }
}
