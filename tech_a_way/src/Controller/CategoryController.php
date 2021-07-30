<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\Migrations\Query\Query;
use Doctrine\ORM\Mapping\Id;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

    /**
     * @Route("/category", name="category_")
     
    **/

class CategoryController extends AbstractController
{

    /**
     * display of products according to categories
     * @Route("/{id}", name="parent", requirements={"id" = "\d+"})
     **/
    public function displayParent(int $id, CategoryRepository $categoryRepository, ProductRepository $productRepository, PaginatorInterface $paginator, Request $request): Response
    {
        // récupération de liste des categories par leur id
        //$categoparent = $categoryRepository->findBy(
          //  ['id' => $id]
        //);

      

        $query =$categoryRepository->findBy(
            ['id' => $id]);
                
      
            $produits = $productRepository->findAll(); 

            $produits = $paginator->paginate(
                $query, 
                $request->query->getInt('page', 1), 
                10
            ); 
         
      dump($produits);

        return $this->render('category/index.html.twig', [
            'categotype1' => $produits,
            //'pagination' => $produits,
        ]);
    }
    /**
    * @Route("/pagination ", name="pagination")
    */
    public function pagination(ProductRepository $productRepository, PaginatorInterface $paginator, Request $request): Response


    {
          $produits = $productRepository->findAll(); 

                $produits = $paginator->paginate(
                    $produits, 
                    $request->query->getInt('page', 1), 
                    10
                ); 
             

          return $this->render('pagination/test.html.twig',[
              'produits' => $produits,
          ]);
        
         
    } 
   
}