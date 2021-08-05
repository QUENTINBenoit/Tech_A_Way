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
        $brands = $this->brandRepository->findAll();

      
        $brandsCarousel = array_chunk($brands, 4);
        
         
        return $brandsCarousel;
    }
     

    
}