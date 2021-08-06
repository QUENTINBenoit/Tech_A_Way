<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Product;
use App\Form\SearchType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ProductType;
use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/product", name="product_")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('product/index.html.twig', [
            'category' => $categoryRepository->findCategoriesToDisplay(), // display hs  
        ]);
    }

    /**
     * @Route("/{id}", name="details", requirements={"id" ="\d+"})
     * @return Response
     */
    public function show(int $id, ProductRepository $productRepository )
    {       
        return $this->render('product/index.html.twig', [
            'product' => $productRepository->findOneByDetails($id),
        ]);
    }
     
/**
     * @Route("/display/{id}", name="brandst", requirements={"id" ="\d+"})
     * @return Response
     */

     public function brands(int $id,
                            Request $request, 
                              
                            BrandRepository $brandRepository, 
                            PaginatorInterface $paginator ) : Response
                {
                    $query = $brandRepository->findProductsByeBrand($id); 
             // $listProduits = $productRepository->find($id); 
            // dd($brandsCarr); 
            
                $brandsCarr = $paginator->paginate(
                $query, 
                $request->query->getInt('page', 1), 
                2
            ); 

            return $this->render('brands/brands_list.html.twig', [
                'productBrands' => $brandsCarr,
                //'listProduit' => $listProduits,
                ]);
                }
    }
