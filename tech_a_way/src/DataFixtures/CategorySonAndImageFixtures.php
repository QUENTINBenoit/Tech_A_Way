<?php

namespace App\DataFixtures;

//use App\DataFixtures\ProductsFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Category;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorySonAndImageFixtures extends Fixture
{
    public const CATEGORY_REFERENCE = 'category_';

    public function load(ObjectManager $manager)
    {
        $majorCategoriesList = [

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
        $underSubCategorySonList = [
            8=>['under'=>'Homecinema'],
            7=>['under'=>'Barre de son'],
            6=>['under'=>'Enceintes'],
            5=>['under'=>'Casque/Ecouteur'],
         
         
         
     ];
     $underSubCategoryImageList = [
        4=>['under'=>'Télévision'],
        3=>['under'=>'Projection'],
        2=>['under'=>'Camera'],
        1=>['under'=>'Photo'],
        

    ];



        $categorySonAndImage = new Category();
        $categorySonAndImage->setName($majorCategoriesList[0]);
        $categorySonAndImage->setSubtitle('Catégorie, Son et Image');

        $manager->persist($categorySonAndImage);

        /**====================Fin========================== */

        /**=======les sous categories de son ============= */

        $subCategorySon = new Category;
        $subCategorySon->setName($subCategoriesSonAndImageList[0]) ;
        $subCategorySon->setSubtitle('Le meilleur de l\'audio');
        $subCategorySon->setCategory($subCategorySon);
        $categorySonAndImage->addSubcategory($subCategorySon);


        $manager->persist($subCategorySon);

        /**=====Subcategories of the category Sound======== */

        foreach ($underSubCategorySonList as $key => $value) {
            $underSon = new Category;
            $underSon->setName($value['under']);
            $subCategorySon->addSubcategory($underSon);
            $manager->persist($underSon);
            $this->setReference('category_'.$key,$underSon);
        }

         /**==================Sous categorie Image==================== */
         $subCategoryImage = new Category;
         $subCategoryImage->setName($subCategoriesSonAndImageList[1]);
         $subCategoryImage->setSubtitle('les dernière definition sont chez nous');
         $categorySonAndImage->addSubcategory($subCategoryImage);
 
         $manager->persist($subCategoryImage); /** Ici on persist la sous categorie Image */
 
 
         /**========Subcategories of the Image category============*/
         foreach ($underSubCategoryImageList as $key => $value) {
             $underImage = new Category;
             $underImage->setName($value['under']);
             $subCategoryImage->addSubcategory($underImage);
             $manager->persist($underImage);
             $this->setReference('category_'.$key,$underImage);
         }

         $manager->flush();

    }

}