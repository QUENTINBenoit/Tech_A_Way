<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProductRepository $productRepository): Response
    {

        $productsRecent = $productRepository->findBy([
            'statusRecent' => null,
        ], null, 6);
      
        $productsPromotion = $productRepository->findBy([
            'statusPromotion' => null,
        ], null, 6);

        //$productsByPromotionInPercent = $reposPromotionByPercentage->findByPercentagePromotion('40');

       //dd($productsPromotion, $productsRecent);
        

        return $this->render('home/index.html.twig', [
            'productsRecent'=> $productsRecent,
            'productsPromotion'=> $productsPromotion,
            //'productsByPromotionInPercent'=>$productsByPromotionInPercent


        ]);
    }

    /**
     * @Route ("/search", name="search")
     * 
     * 
     * 
     * @return void
     */
    public function search(Request $request, ProductRepository $productRepository)
    {
        $searchValue = $request->get('query');

        $product= $productRepository->findSearchByName($searchValue);

        return $this->render('home/search.html.twig', [
            'product' => $product,
            'searchValue' => $searchValue
        ]);
    }

   
}


