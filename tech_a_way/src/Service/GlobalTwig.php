<?php 
namespace App\Service;
use App\Repository\CategoryRepository;


class GlobalTwig
 {
    private $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function categories() {
        $categories = $this->categoryRepository->findBy(
            ['category' => null]
        );

         


        return $categories;
    }
     



    
}