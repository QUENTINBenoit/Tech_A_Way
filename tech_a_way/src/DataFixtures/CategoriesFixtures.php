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
        $majorCategoriesList = [

            // I am testing a nested table to link the major categories to the relevant
            // subcategories

            'Son/Images',
            'Informatiques',
            'Objet connecté',
            'Téléphonie',

            
        ];

        $subCategoriesInformatiqueList =[
            'peripherique',
            'Portable',
            'Ordinateur Fix'
        ];

        $underSubCategoryPeripheriqueList =[
            'Ecran PC',
            'Clavier/Souris',
            'Disque dur',
            'Imprimante/Scanner',
        ];

        $underSubCategoryPortableList =[
            'Neuf',
            'Reconditionne',
            'Sation d\'accueil ',
            'Sacoches',
        ];

        $underSubCategoryOrdinateurFixList =[

            'Neuf',
            'Reconditionne',
            'Tour',
        ];

        $subCategoriesObjetConnecteList = [
            'Maison',
            'Sport',
            'Sécurité'
        ];

        $underSubCategoryMaisonList =[
            'Ampoule Connecte',
            'Prise Connecte',
            'Traitement de l\'aire',
            'Aspirateur connecte'
        ];

        $underSubCategorySportList = [
            'Montre connecte',
            'Drone',
            'Balance connecte',
        ];

        $underSubCategorySecuriteList = [
            'Camera de surveillance',
            'Alarme',
            'Detecteur de fumer',
            'Interphone Connecté',
        ];

        $subCategoriesTelephonieList = [
            'Mobile',
            'Fix',
        ];

        $underSubCategoryMobileList = [
            'Smartphone neuf',
            'Smartphone Reconditione',
            'Chargeur/Cable',
            'Protection',

        ];
        $underSubCategoryFixList = [
            'Sans fil',
            'Filaire',
            'Fax',


        ];

        $subCategoriesSonAndImageList = [
            'Son',
            'Images'
            
        ];

        $underSubCategorySonList = [
         'Homecinema',
         'Barre de son',
         'Enceintes',
         'Casque/Ecouteur'
     ];
        $underSubCategoryImageList = [
            'Télévision',
            'Projection',
            'Camera',
            'Photo',

        ];


        // Factorisation tableau 
        $majorCategoryList1 = [

            // I am testing a nested table to link the major categories to the relevant
            // subcategories

            'Son/Images'=>[
                'Son'=>[
                    'Homecinema',
                    'Barre de son',
                    'Enceintes',
                    'Casque/Ecouteur'
                ],
                'Images'=>[
                    'Télévision',
                    'Projection',
                    'Camera',
                    'Photo',
        
                ] 
            ],




            'Informatiques',
            'Objet connecté',
            'Téléphonie',

            
        ];

        // je veux recuperer la clé son pour lié en categorie et sous categorie


        





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


       /**==========major categoy Son et image==============*/  
            
        $categorySonAndImage = new Category();
        $categorySonAndImage->setName($majorCategoriesList[0]);
        $categorySonAndImage->setSubtitle('Son or not Son');

        /**====================Fin============================ */



        /**=====Ici on persist la major category son et image=== */   
        $manager->persist($categorySonAndImage);
        /**====================Fin========================== */   

        /**=======les sous categories de son ============= */
        $subCategorySon = new Category;
        $subCategorySon->setName($subCategoriesSonAndImageList[0]) ;
        $subCategorySon->setCategory($subCategorySon);
        $categorySonAndImage->addSubcategory($subCategorySon);


        $manager->persist($subCategorySon); /**ici on persist La sous categorie Son */

         /**=====Subcategories of the category Sound======== */
         foreach ($underSubCategorySonList as $current) 
         {
             $under = new Category;
             $under->setName($current);
             $subCategorySon->addSubcategory($under);
             $manager->persist($under);
 
         }


        /**==========================Fin============================= */

        /**==================Sous categorie Image==================== */
        $subCategoryImage = new Category;
        $subCategoryImage->setName($subCategoriesSonAndImageList[1]);
        $categorySonAndImage->addSubcategory($subCategoryImage);

        $manager->persist($subCategoryImage); /** Ici on persist la sous categorie Image */


        /**========Subcategories of the Image category============*/
        foreach ($underSubCategoryImageList as $currentImage) 
        {
            $under = new Category;
            $under->setName($currentImage);
            $subCategoryImage->addSubcategory($under);
            $manager->persist($under);

        }

         /* code obselet 
            
                $underSubCategorySonHomeCinema=new Category;
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


     
               





        
        /************************************************
         * =========================================
         * DATA SET FOR THE INFORMATIQUE CATEGORY
         * =========================================
         * 
         * Below you will find the data set for the IT category
         * 
         * 
         * 
         * 
         *
         ************************************************/


    /**================Major Categories Informatique================================ */
        $categoryInformatique = new Category();
        $categoryInformatique->setName($majorCategoriesList[1]);
        $categoryInformatique->setSubtitle('Informatique or not informatique');

        $manager->persist($categoryInformatique); /**Persit la major categorie Informatique */
    /**==============================Fin============================================== */
    
    
    /**========================Sous Categorie Peripherique ======================= */
        $subCategoryPeripherique = new Category();
        $subCategoryPeripherique->setName($subCategoriesInformatiqueList[0]);
        $subCategoryPeripherique->setCategory($subCategoryPeripherique);
        $categoryInformatique->addSubcategory($subCategoryPeripherique);

        $manager->persist($subCategoryPeripherique); /**Persit la sous categorie Peripherique */


            // les sous categories de peripherique
            foreach ($underSubCategoryPeripheriqueList as $current) 
            {
                $underPeripherique = new Category;
                $underPeripherique->setName($current);
                $subCategoryPeripherique->addSubcategory($underPeripherique);
                $manager->persist($underPeripherique);

            }

    /**===================================FIN=========================================== */

    /**=======================Sou scategorie OrdiPortable============================ */
        $subCategoryPortable = new Category();
        $subCategoryPortable->setName($subCategoriesInformatiqueList[1]);
        $subCategoryPortable->setCategory($subCategoryPortable);
        $categoryInformatique->addSubcategory($subCategoryPortable);

        $manager->persist($subCategoryPortable);


                // les sous-sous categories de ordi portable
                foreach ($underSubCategoryPortableList as $current) 
                        {
                            $underPortable = new Category;
                            $underPortable->setName($current);
                            $subCategoryPortable->addSubcategory($underPortable);
                            $manager->persist($underPortable);

                        }

    /**===========================FIN================================================== */
      

    /**====================Sous categorie Pc Fix=============================== */
        $subCategoryOrdiFix = new Category();
        $subCategoryOrdiFix->setName($subCategoriesInformatiqueList[2]);
        $subCategoryOrdiFix->setCategory($subCategoryOrdiFix);
        $categoryInformatique->addSubcategory($subCategoryOrdiFix);

        $manager->persist($subCategoryOrdiFix); /** Ici on persist */


        foreach ($underSubCategoryOrdinateurFixList as $current) 
                        {
                            $underOrdiFix = new Category;
                            $underOrdiFix->setName($current);
                            $subCategoryOrdiFix->addSubcategory($underOrdiFix);
                            $manager->persist($underOrdiFix);

                        }
    /**============================FIN=========================================== */








    /************************************************
         * =========================================
         * DATA SET FOR THE Connected object CATEGORY
         * =========================================
         * 
         * Below you will find the data set for the Connected object category
         * 
         * 
         * 
         * 
         *
         ************************************************/


    /**================Major Categories "Objet Connecté"================================ */
    $categoryConnectedObject = new Category();
    $categoryConnectedObject->setName($majorCategoriesList[2]);
    $categoryConnectedObject->setSubtitle('Objet connecte or not Objet connecte');

    $manager->persist($categoryConnectedObject); /**Persit la major categorie Informatique */
/**==============================Fin============================================== */


/**========================Sous Categorie Maison ======================= */
    $subCategoryMaison = new Category();
    $subCategoryMaison->setName($subCategoriesObjetConnecteList[0]);
    $subCategoryMaison->setCategory($subCategoryMaison);
    $categoryConnectedObject->addSubcategory($subCategoryMaison);

    $manager->persist($subCategoryMaison); /**Persit la sous categorie Maison */


        // les sous categories de Maison
        foreach ($underSubCategoryMaisonList as $current) 
        {
            $UnderMaison = new Category;
            $UnderMaison->setName($current);
            $subCategoryMaison->addSubcategory($UnderMaison);
            $manager->persist($UnderMaison);

        }

/**===================================FIN=========================================== */

/**=======================Souscategorie Sport============================ */
    $subCategorySport = new Category();
    $subCategorySport->setName($subCategoriesObjetConnecteList[1]);
    $subCategorySport->setCategory($subCategorySport);
    $categoryConnectedObject->addSubcategory($subCategorySport);

    $manager->persist($subCategorySport);


            // les sous-sous categories Sport
            foreach ($underSubCategorySportList as $current) 
                    {
                        $underSport = new Category;
                        $underSport->setName($current);
                        $subCategorySport->addSubcategory($underSport);
                        $manager->persist($underSport);

                    }

/**===========================FIN================================================== */
  

/**====================Sous sécurité=============================== */
    $subCategorySecurity = new Category();
    $subCategorySecurity->setName($subCategoriesObjetConnecteList[2]);
    $subCategorySecurity->setCategory($subCategorySecurity);
    $categoryConnectedObject->addSubcategory($subCategorySecurity);

    $manager->persist($subCategorySecurity); /** Ici on persist */


    foreach ($underSubCategorySecuriteList as $current) 
                    {
                        $underSecurity = new Category;
                        $underSecurity->setName($current);
                        $subCategorySecurity->addSubcategory($underSecurity);
                        $manager->persist($underSecurity);

                    }
/**============================FIN=========================================== */


/************************************************
         * =========================================
         * DATA SET FOR THE Telephonie CATEGORY
         * =========================================
         * 
         * Below you will find the data set for the Telephonie category
         * 
         * 
         * 
         * 
         *
         ************************************************/


    /**================Major Categories "Telephonie"================================ */
    $categoryTelephonie = new Category();
    $categoryTelephonie->setName($majorCategoriesList[3]);
    $categoryTelephonie->setSubtitle('Telephonie or not telephonie');

    $manager->persist($categoryTelephonie); /**Persit la major categorie Informatique */
/**==============================Fin============================================== */


/**========================Sous Categorie Mobile ======================= */
    $subCategoryMobile = new Category();
    $subCategoryMobile->setName($subCategoriesTelephonieList[0]);
    $subCategoryMobile->setCategory($subCategoryMobile);
    $categoryTelephonie->addSubcategory($subCategoryMobile);

    $manager->persist($subCategoryMobile); /**Persit la sous categorie Mobile */


        // les sous categories de Mobile
        foreach ($underSubCategoryMobileList as $current) 
        {
            $UnderMobile = new Category;
            $UnderMobile->setName($current);
            $subCategoryMobile->addSubcategory($UnderMobile);
            $manager->persist($UnderMobile);

        }

/**===================================FIN=========================================== */

/**=======================Souscategorie telephonie Fix============================ */
    $subCategoryFix = new Category();
    $subCategoryFix->setName($subCategoriesObjetConnecteList[1]);
    $subCategoryFix->setCategory($subCategoryFix);
    $categoryTelephonie->addSubcategory($subCategoryFix);

    $manager->persist($subCategoryFix);


            // les sous-sous categories Fix
            foreach ($underSubCategoryFixList as $current) 
                    {
                        $underFix = new Category;
                        $underFix->setName($current);
                        $subCategoryFix->addSubcategory($underFix);
                        $manager->persist($underFix);

                    }

/**===========================FIN================================================== */
  

       







        
        

        $manager->flush();
    }
}
