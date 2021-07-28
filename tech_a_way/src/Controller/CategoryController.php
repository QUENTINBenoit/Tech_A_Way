<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CategoryController extends AbstractController
{

    /**
     * @Route("/category", name="category")
     
 
    **/

    /**
     * display categories parent
     * @Route("/category", name="category")
     */
    public function displayParent(CategoryRepository $categoryRepository ): Response
    {
        // récupération de liste des categories
        $listCategoryParent = $categoryRepository->findAll();
       
        return $this->render('category/index.html.twig', [
             'listCategoryParent' => $listCategoryParent,
           
        ]);
        
    }
    
}
