<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProductRepository $productRepository, SessionInterface $sessionInterface): Response
    {
        $session = $sessionInterface->get('cart', []);
        
        // Total quantity of the session array values (corresponding of the product quantity add to the cart)
        $totalQuantity = array_sum($session);

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
            'quantity' => $totalQuantity,
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

       // dd($searchValue);

        $products=  $productRepository->findBySearchByName($searchValue);
        //dd($products);

        return $this->render('home/search.html.twig', [
            'products' => $products,
            'searchValue' => $searchValue,
            
            
            
        ]);
    }

   
}


