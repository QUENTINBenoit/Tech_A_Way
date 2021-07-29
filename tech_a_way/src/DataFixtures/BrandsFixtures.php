<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Laminas\Code\Reflection\FunctionReflection;

class BrandsFixtures extends Fixture
{

    public const BRAND_REFERENCE = 'brand_';
    public function load(ObjectManager $manager)
    
    {
        $brandList = [
                       1=> ['name' => 'Acer', 'picture' => 'acer.png'],
                       2=> ['name' => 'Apple', 'picture' => 'apple.jpg'],
                       3=> ['name' => 'Asus', 'picture' => 'asus.png'],
                       4=> ['name' => 'Dell', 'picture' => 'dell.png'],
                       5=> ['name' => 'Lg', 'picture' => 'lg.jpg'],
                       6=> ['name' => 'Nokia', 'picture' => 'nokia.png'],
                       7=> ['name' => 'Panasonic', 'picture' => 'panasonic.png'],
                       8=> ['name' => 'Philips', 'picture' => 'philips.png'],
                       9=> ['name' => 'Samsung', 'picture' => 'samsung.png'],
                       10=> ['name' => 'Sony', 'picture' => 'sony.jpg'],
                       11=> ['name' => 'Toshiba', 'picture' => 'toshiba.jpg'],
                       12=> ['name' => 'Xiaomi', 'picture' => 'xiaomi.png']
                    ];
                    
                    foreach ($brandList as $key => $value) {
                        $brand = new Brand();
                        $brand->setName($value['name']);
                        $brand->setLogo($value['picture']);
                        $manager->persist($brand);
                        $this->setReference('brand_'.$key, $brand);
                    }

                   
                    $manager->flush();

    }
}