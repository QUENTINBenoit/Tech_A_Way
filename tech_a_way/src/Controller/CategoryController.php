<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
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
    public function displayParent(int $id,  CategoryRepository $categoryRepository ): Response
    {
        // récupération de liste des categories
        $categoparent = $categoryRepository->findBy(
            ['id' => $id]

        );
     //  dd( $categoparent);
        return $this->render('category/index.html.twig', [
            'categotype1' => $categoparent, 
        ]);
    }
    
}
