<?php

namespace App\DataFixtures;

//use App\DataFixtures\ProductsFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Category;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoriesFixtures extends Fixture
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

        $subCategoriesInformatiqueList =[
            'peripherique',
            'Portable',
            'Ordinateur Fix'
        ];

        $underSubCategoryPeripheriqueList =[
            37=>['under'=>'Ecran PC'],
            36=>['under'=>'Clavier/Souris'],
            35=>['under'=>'Disque dur'],
            34=>['under'=>'Imprimante/Scanner'],
           
        ];

        $underSubCategoryPortableList =[
            33=>['under'=>'Neuf'],
            32=>['under'=>'Reconditionne'],
            31=>['under'=>'Sation d\'accueil'],
            30=>['under'=>'Sacoches'],
            
        ];

        $underSubCategoryOrdinateurFixList =[
            29=>['under'=>'Neuf'],
            28=>['under'=>'Reconditionne'],
            27=>['under'=>'Tour'],

        ];

        $subCategoriesObjetConnecteList = [
            'Maison',
            'Sport',
            'Sécurité'
        ];

        $underSubCategoryMaisonList =[
            26=>['under'=>'Ampoule Connecte'],
            25=>['under'=>'Prise Connecte'],
            24=>['under'=>'Traitement de l\'aire'],
            23=>['under'=>'Aspirateur connecte'],
        ];

        $underSubCategorySportList = [
            22=>['under'=>'Montre connecte'],
            21=>['under'=>'Drone'],
            20=>['under'=>'Balance connecte'],
           
        ];

        $underSubCategorySecuriteList = [
            19=>['under'=>'Camera de surveillance'],
            18=>['under'=>'Alarme'],
            17=>['under'=>'Detecteur de fumer'],
            16=>['under'=>'Interphone Connecté'],
            
        ];

        $subCategoriesTelephonieList = [
            'Mobile',
            'Fix',
        ];

        $underSubCategoryMobileList = [
            15=>['under'=>'Smartphone neuf'],
            14=>['under'=>'Smartphone Reconditione'],
            13=>['under'=>'Protection'],
            12=>['under'=>'Chargeur/Cable'],
            
            
            

        ];
        $underSubCategoryFixList = [
            11=>['under'=>'Sans fil'],
            10=>['under'=>'Fax'],
            9=>['under'=>'Filaire'],
            
            


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

            'Informatiques'=>[
                'peripherique'=>[
                    'Ecran PC',
                    'Clavier/Souris',
                    'Disque dur',
                    'Imprimante/Scanner',
                ],
                'Portable'=>[
                    'Neuf',
                    'Reconditionne',
                    'Sation d\'accueil ',
                    'Sacoches',

                ] ,
                'Ordinateur Fix'=>[
                    'Neuf',
                    'Reconditionne',
                    'Tour',
                ]
            ],

            'Objet connecté'=>[
                'Maison'=>[
                    'Ampoule Connecte',
                    'Prise Connecte',
                    'Traitement de l\'aire',
                    'Aspirateur connecte'
                ],

                'Sport'=>[
                    'Montre connecte',
                    'Drone',
                    'Balance connecte',

                ],

                'Sécurité'=>[
                    'Camera de surveillance',
                    'Alarme',
                    'Detecteur de fumer',
                    'Interphone Connecté',
                ]

            ],

            'Téléphonie'=>[
                'Mobile'=>[
                    'Smartphone neuf',
                    'Smartphone Reconditione',
                    'Chargeur/Cable',
                    'Protection',
                ],

                'Fix'=>[
                    'Sans fil',
                    'Filaire',
                    'Fax',
                ],
            ],

            
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
            
        // $categorySonAndImage = new Category();
        // $categorySonAndImage->setName($majorCategoriesList[0]);
        // $categorySonAndImage->setSubtitle('Catégorie, Son et Image');

        // $manager->persist($categorySonAndImage);

        // /**====================Fin========================== */

        // /**=======les sous categories de son ============= */

        // $subCategorySon = new Category;
        // $subCategorySon->setName($subCategoriesSonAndImageList[0]) ;
        // $subCategorySon->setSubtitle('Le meilleur de l\'audio');
        // $subCategorySon->setCategory($subCategorySon);
        // $categorySonAndImage->addSubcategory($subCategorySon);


        // $manager->persist($subCategorySon);

        // /**=====Subcategories of the category Sound======== */

        // foreach ($underSubCategorySonList as $key => $value) {
        //     $underSon = new Category;
        //     $underSon->setName($value['under']);
        //     $subCategorySon->addSubcategory($underSon);
        //     $manager->persist($underSon);
        //     $this->setReference('category_'.$key,$underSon);
        // }


        // /**==========================Fin============================= */

        // /**==================Sous categorie Image==================== */
        // $subCategoryImage = new Category;
        // $subCategoryImage->setName($subCategoriesSonAndImageList[1]);
        // $subCategoryImage->setSubtitle('les dernière definition sont chez nous');
        // $categorySonAndImage->addSubcategory($subCategoryImage);

        // $manager->persist($subCategoryImage); /** Ici on persist la sous categorie Image */


        // /**========Subcategories of the Image category============*/
        // foreach ($underSubCategoryImageList as $key => $value) {
        //     $underImage = new Category;
        //     $underImage->setName($value['under']);
        //     $subCategoryImage->addSubcategory($underImage);
        //     $manager->persist($underImage);
        //     $this->setReference('category_'.$key,$underImage);
        // }

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
        $categoryInformatique->setSubtitle('A la point de la technologie');

        $manager->persist($categoryInformatique); /**Persit la major categorie Informatique */
        /**==============================Fin============================================== */
    
    
        /**========================Sous Categorie Peripherique ======================= */
        $subCategoryPeripherique = new Category();
        $subCategoryPeripherique->setName($subCategoriesInformatiqueList[0]);
        $subCategoryPeripherique->setSubtitle('Besoins de pièces de rechange?');
        $subCategoryPeripherique->setCategory($subCategoryPeripherique);
        $categoryInformatique->addSubcategory($subCategoryPeripherique);

        $manager->persist($subCategoryPeripherique); /**Persit la sous categorie Peripherique */


        // les sous categories de peripherique
        foreach ($underSubCategoryPeripheriqueList as $key => $value) {
            $underPeripherique = new Category;
            $underPeripherique->setName($value['under']);
            $subCategoryPeripherique->addSubcategory($underPeripherique);
            $manager->persist($underPeripherique);
            $this->setReference('category_'.$key,$underPeripherique);

        }

        /**===================================FIN=========================================== */

        /**=======================Sou scategorie OrdiPortable============================ */
        $subCategoryPortable = new Category();
        $subCategoryPortable->setName($subCategoriesInformatiqueList[1]);
        $subCategoryPortable->setSubtitle('Plus besoins de rester au bureau');
        $subCategoryPortable->setCategory($subCategoryPortable);
        $categoryInformatique->addSubcategory($subCategoryPortable);

        $manager->persist($subCategoryPortable);


        // les sous-sous categories de ordi portable
        foreach ($underSubCategoryPortableList as $key => $value) {
            $underPortable = new Category;
            $underPortable->setName($value['under']);
            $subCategoryPortable->addSubcategory($underPortable);
            $manager->persist($underPortable);
            $this->setReference('category_'.$key,$underPortable);
        }

        /**===========================FIN================================================== */
      

        /**====================Sous categorie Pc Fix=============================== */
        $subCategoryOrdiFix = new Category();
        $subCategoryOrdiFix->setName($subCategoriesInformatiqueList[2]);
        $subCategoryOrdiFix->setSubtitle('Obtez pour le confort et la puissance');
        $subCategoryOrdiFix->setCategory($subCategoryOrdiFix);
        $categoryInformatique->addSubcategory($subCategoryOrdiFix);

        $manager->persist($subCategoryOrdiFix); /** Ici on persist */


        foreach ($underSubCategoryOrdinateurFixList as $key => $value) {
            $underOrdiFix = new Category;
            $underOrdiFix->setName($value['under']);
            $subCategoryOrdiFix->addSubcategory($underOrdiFix);
            $manager->persist($underOrdiFix);
            $this->setReference('category_'.$key,$underOrdiFix);
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
        $categoryConnectedObject->setSubtitle('Rester connecté jusqu\'au bout des prises');

        $manager->persist($categoryConnectedObject); /**Persit la major categorie Informatique */
        /**==============================Fin============================================== */


        /**========================Sous Categorie Maison ======================= */
        $subCategoryMaison = new Category();
        $subCategoryMaison->setName($subCategoriesObjetConnecteList[0]);
        $subCategoryMaison->setCategory($subCategoryMaison);
        $subCategoryMaison->setSubtitle('Enfin un interieur qui vous ressemble, maison intéligente a votre disposition');
        $categoryConnectedObject->addSubcategory($subCategoryMaison);

        $manager->persist($subCategoryMaison); /**Persit la sous categorie Maison */


        // les sous categories de Maison
        foreach ($underSubCategoryMaisonList as $key => $value) {
            $UnderMaison = new Category;
            $UnderMaison->setName($value['under']);
            $subCategoryMaison->addSubcategory($UnderMaison);
            $manager->persist($UnderMaison);
            $this->setReference('category_'.$key,$UnderMaison);
        }

        /**===================================FIN=========================================== */

        /**=======================Souscategorie Sport============================ */
        $subCategorySport = new Category();
        $subCategorySport->setName($subCategoriesObjetConnecteList[1]);
        $subCategorySport->setSubtitle('Retrouver vos produits sport et bien être');
        $subCategorySport->setCategory($subCategorySport);
        $categoryConnectedObject->addSubcategory($subCategorySport);

        $manager->persist($subCategorySport);


        // les sous-sous categories Sport
        foreach ($underSubCategorySportList as $key => $value) {
            $underSport = new Category;
            $underSport->setName($value['under']);
            $subCategorySport->addSubcategory($underSport);
            $manager->persist($underSport);
            $this->setReference('category_'.$key,$underSport);

        }

        /**===========================FIN================================================== */
  

        /**====================Sous sécurité=============================== */
        $subCategorySecurity = new Category();
        $subCategorySecurity->setName($subCategoriesObjetConnecteList[2]);
        $subCategorySecurity->setSubtitle('Faites de votre interieur un havre de paix');
        $subCategorySecurity->setCategory($subCategorySecurity);
        $categoryConnectedObject->addSubcategory($subCategorySecurity);

        $manager->persist($subCategorySecurity); /** Ici on persist */


        foreach ($underSubCategorySecuriteList as $key => $value) {
            $underSecurity = new Category;
            $underSecurity->setName($value['under']);
            $subCategorySecurity->addSubcategory($underSecurity);
            $manager->persist($underSecurity);
            $this->setReference('category_'.$key,$underSecurity);
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
        $categoryTelephonie->setSubtitle('Dring, Dring, Dring, \'dernier smartphone a votre écoute\' ');

        $manager->persist($categoryTelephonie); /**Persit la major categorie Informatique */
        /**==============================Fin============================================== */


        /**========================Sous Categorie Mobile ======================= */
        $subCategoryMobile = new Category();
        $subCategoryMobile->setName($subCategoriesTelephonieList[0]);
        $subCategoryMobile->setCategory($subCategoryMobile);
        $subCategoryMobile->setSubtitle('Tout les dernier smarthpone sont ici');
        $categoryTelephonie->addSubcategory($subCategoryMobile);

        $manager->persist($subCategoryMobile); /**Persit la sous categorie Mobile */


        // les sous categories de Mobile
        foreach ($underSubCategoryMobileList as $key => $value) {
            $underMobile = new Category;
            $underMobile->setName($value['under']);
            $subCategoryMobile->addSubcategory($underMobile);
            $manager->persist($underMobile);
            $this->setReference('category_'.$key,$underMobile);
           
        }

        /**===================================FIN=========================================== */

        /**=======================Souscategorie telephonie Fix============================ */
        $subCategoryFix = new Category();
        $subCategoryFix->setName($subCategoriesTelephonieList[1]);
        $subCategoryFix->setCategory($subCategoryFix);
        $subCategoryFix->setSubtitle('Nos téléphone filaire');
        $categoryTelephonie->addSubcategory($subCategoryFix);

        $manager->persist($subCategoryFix);


        // les sous-sous categories Fix
        foreach ($underSubCategoryFixList as $key => $value) {
            $underFix = new Category;
            $underFix->setName($value['under']);
            $subCategoryFix->addSubcategory($underFix);
            $manager->persist($underFix);
            $this->setReference('category_'.$key,$underFix);
        }

        /**===========================FIN================================================== */
  
        
        
        $manager->flush(); // Flush de tout les éléments
    }


    // public function getDependencies()
    // {
    //     return[
    //         ProductsFixtures::class,
    //     ];
    // }
}
