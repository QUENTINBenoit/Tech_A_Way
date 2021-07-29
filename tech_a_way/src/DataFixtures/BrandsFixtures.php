<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Laminas\Code\Reflection\FunctionReflection;

class BrandsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
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
                        $manager->persist($brand);
                    }
                    $manager->flush();

    }
}