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


            $underSubCategorySonHomeCinema=New Category;
            $underSubCategorySonHomeCinema->setName($underSubCategorySon[0]);
            $subCategorySon->addSubcategory($underSubCategorySonHomeCinema);


            $underSubCategorySonSoundBar=New Category;
            $underSubCategorySonSoundBar->setName($underSubCategorySon[1]);
            $subCategorySon->addSubcategory($underSubCategorySonSoundBar);

            $underSubCategorySonSpeaker=New Category;
            $underSubCategorySonSpeaker->setName($underSubCategorySon[2]);
            $subCategorySon->addSubcategory($underSubCategorySonSpeaker);

            $underSubCategorySonHeadphone=New Category;
            $underSubCategorySonHeadphone->setName($underSubCategorySon[3]);
            $subCategorySon->addSubcategory($underSubCategorySonHeadphone);

            




            $manager->persist($underSubCategorySonHomeCinema);
            $manager->persist($underSubCategorySonSoundBar);
            $manager->persist($underSubCategorySonSpeaker);
            $manager->persist($underSubCategorySonHeadphone);

        

        

        
        
        

        $manager->flush();
    }
}
