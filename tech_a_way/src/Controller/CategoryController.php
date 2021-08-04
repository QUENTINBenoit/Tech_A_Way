<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Form\SearchType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
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
     * display of products according to categories.
     *
     * @Route("/{id}", name="parent", requirements={"id" = "\d+"})
     */
    public function displayParent(int $id, CategoryRepository $categoryRepository): Response
    {
        // récupération de liste des categories par leur id
        //$categoparent = $categoryRepository->findBy(
        //  ['id' => $id]
        //);
        $catgoType = $categoryRepository->findBy(
            ['id' => $id]
        );

        return $this->render('category/index.html.twig', [
            'categotype1' => $catgoType,
        ]);
    }

    /**
     * @Route("/{id}/pagination ", name="pagination")
     */
    public function pagination(
                    Category $category,
                    PaginatorInterface $paginator,
                    Request $request,
                    ProductRepository $productRepository
                                ): Response 
                                {

        $filter = $request->query->all();
        // je lie le formulaire à l'entité Product
        $form = $this->createForm(SearchType::class, null, [
            'category' => $category->getId(),
            'action' => $this->generateUrl('category_pagination', ['id' => $category->getId()]),
        ]);

            $form->handleRequest($request);
            
            if(isset($filter['search'])){
                $query= $productRepository->findByFilter($filter['search']);
            }else{
                $query= $category->getProducts();           
           }        
            dump(count($query));
            //dd($query );
            $products = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            3
        );
        return $this->render('product/product_list.html.twig', [
            'products' => $products,  
            'form' => $form->createView(),
        ]);
    }
}
