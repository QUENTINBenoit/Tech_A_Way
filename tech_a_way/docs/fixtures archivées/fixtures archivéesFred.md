/***********************************PART 1: CATEGORY/PRODUCT/BRAND/PICTURE*************************************************************/   
        // List of main Categories
        $categoryListName = [
            'Audio et Hi-Fi',
            'Vidéo',
            'Informatique',
            'Téléphones Portables et Fixes'
        ];
        
        // creation of array empty to put object category in order to associate them later with the products 
        $arrayofObjectCategory = [];

        // On boucle d'abord sur le tableau $categoryListName
        for ($i = 0; $i< count($categoryListName); $i++) {
            $category = new Category();
            $category->setName($categoryListName[$i]);
            $category->setSubtitle("subtitle Catégorie : " . $faker->name);
            $category->setPicture($faker->firstname() . ".jpg");

                for ($subCategoryNumber = 0; $subCategoryNumber < $faker->numberBetween(2, 4); $subCategoryNumber++) {
                    $subCategory = new Category();
                    $subCategory->setName($faker->name());
                    $subCategory->setSubtitle("subtitle sous-catégorie ! " . $faker->name);
                    $subCategory->setPicture($faker->firstname() . ".jpg");

                        for ($subSubCategoryNumber = 0; $subSubCategoryNumber < $faker->numberBetween(2, 5); $subSubCategoryNumber++) {
                            $subSubCategory = new Category();
                            $subSubCategory->setName($faker->name());
                            $subSubCategory->setSubtitle("subtitle sous-sous-catégorie ! " . $faker->name);
                            $subSubCategory->setPicture($faker->firstname() . ".jpg");

                            $subCategory->addSubcategory($subSubCategory);
                            $arrayofObjectCategory[]= $subSubCategory;
                            $manager->persist($subSubCategory);
                        }
                    
                    $category->addSubcategory($subCategory);
                    // Include the data waiting list
                    $manager->persist($subCategory);
                }
            $manager->persist($category);
        }

        $brandList = [
            ['name' => 'Acer', 'picture' => 'acer.png'],
            ['name' => 'Apple', 'picture' => 'apple.jpg'],
            ['name' => 'Asus', 'picture' => 'asus.png'],
            ['name' => 'Dell', 'picture' => 'dell.png'],
            ['name' => 'Lg', 'picture' => 'lg.jpg'],
            ['name' => 'Nokia', 'picture' => 'nokia.png'],
            ['name' => 'Panasonic', 'picture' => 'panasonic.png'],
            ['name' => 'Philips', 'picture' => 'philips.png'],
            ['name' => 'Samsung', 'picture' => 'samsung.png'],
            ['name' => 'Sony', 'picture' => 'sony.jpg'],
            ['name' => 'Toshiba', 'picture' => 'toshiba.jpg'],
            ['name' => 'Xiaomi', 'picture' => 'xiaomi.png']
        ];
        foreach ($brandList as $currentBrand) {
            $brand = new Brand();
            $brand->setName($currentBrand['name']);
            $brand->setLogo($currentBrand['picture']);

            for ($productNumber = 0; $productNumber < $faker->numberBetween(15, 70); $productNumber++) {
                $ExclTaxesPrice = $faker->numberBetween(0, 1000).".".$faker->numberBetween(0, 99);
                $setSalesTax = 20;
                $InclTaxesPrice = $ExclTaxesPrice + ($ExclTaxesPrice * ($setSalesTax/100));

                $product = new Product();
                $product->setName($faker->sentence($nbWords = 1, $variableNbWords = true));
                $product->setExclTaxesPrice($ExclTaxesPrice);
                $product->setSalesTax($setSalesTax);
                $product->setInclTaxesPrice(round($InclTaxesPrice, 2));
                $product->setReference($faker->numberBetween(11, 99));
                $product->setDescription($faker->text());
                $product->setStock($faker->numberBetween(0, 500));

                    for ($pictureNumber = 0; $pictureNumber <=$faker->numberBetween(1, 10); $pictureNumber++) {
                        $picture = new Picture();
                        $picture->setName($faker->firstname() . ".jpg");

                        $product->addPicture($picture);
                        $manager->persist($picture);
                    }
                
                $brand->addProduct($product);

                // we generate randomNumber to link products on category and link the same product with subcategory of category, and link the same product with subsubcategory of subcategory
                $randomNumber = intval($faker->numberBetween(0, (count($arrayofObjectCategory)-1)));
                $product->addCategory($arrayofObjectCategory[$randomNumber]);
                $product->addCategory($arrayofObjectCategory[$randomNumber]->getCategory());
                $product->addCategory($arrayofObjectCategory[$randomNumber]->getCategory()->getCategory());
               
                // Include the data waiting list
                $manager->persist($product);
            }
            // Include the data waiting list
            $manager->persist($brand);
        }