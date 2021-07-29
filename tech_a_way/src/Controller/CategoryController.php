<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

    /**
     * @Route("/category", name="category_")
     
    **/

class CategoryController extends AbstractController
{

    /** 
     * display of products according to categories
     * @Route("/{id}", name="parent")
     **/
    public function displayParent(int $id,  CategoryRepository $categoryRepository, ProductRepository $productRepository ): Response
    {
        // récupération de liste des categories par leur id 
            $categoparent = $categoryRepository->findBy(
            ['id' => $id] );

          
               
          
               
       
        return $this->render('category/index.html.twig', [
            'categotype1' => $categoparent, 
            //'product'  =>    $product, 
        ]);
    }




}
