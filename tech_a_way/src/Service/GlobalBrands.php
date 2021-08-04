<?php 
namespace App\Service;

use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;


class GlobalBrands
 {
    private $brandRepository;
    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }
    public function brandsCarousel() {
        $brandsCarousel = $this->brandRepository->findAll();


        
         
        return $brandsCarousel;
    }
     



    
}