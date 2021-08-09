<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;
use App\Form\SearchType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
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
        // phpinfo();
        $session = $sessionInterface->get('cart', []);
        
      
        // Total quantity of the session array values (corresponding of the product quantity add to the cart)
        $totalQuantity = array_sum($session);

        $productsRecent = $productRepository->findBy([
            'statusRecent' => 1,
        ], null, 6);
      
        $productsPromotion = $productRepository->findBy([
            'statusPromotion' => 1,
        ], null, 3);

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
    
    public function search(Request $request,
                            PaginatorInterface $paginator, 
                            ProductRepository $productRepository 
                            ) 
    {
        $searchValue = $request->get('query');
      
        // dd($searchValue);
        $query=  $productRepository->findBySearchByName($searchValue );
        //dd($products);
        $products = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            3
        );
        return $this->render('home/search.html.twig', [
            'products' => $products,
            'searchValue' => $searchValue,
            
        ]);
    }   
}


