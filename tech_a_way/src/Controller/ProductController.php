<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
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
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    /**
     * @Route("/{id}", name="details", requirements={"id" ="\d+"})
     * @return Response
     */
    public function show(int $id, ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $allCategories = $categoryRepository->findAll();
        dd($allCategories);

        $product = $productRepository->find($id);
        dd($product->getCategories());
       
        return $this->render('product/index.html.twig', [
            'product' => $productRepository->findOneByDetails($id),
        ]);

    }
}
