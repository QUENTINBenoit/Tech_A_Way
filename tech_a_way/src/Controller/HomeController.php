<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(ProductRepository $reposRecent,ProductRepository $reposInPromotion,ProductRepository $reposPromotionByPercentage): Response
    {
        $productsRecent = $reposRecent->findByStatusRecent(1);

        $productsPromotion = $reposInPromotion->findByStatusPromotion(1);

        $productsByPromotionInPercent = $reposPromotionByPercentage->findByPercentagePromotion('40');

       // dd($productsPromotion, $productsRecent, $productsByPromotionInPercent);
        

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'productsRecent'=> $productsRecent,
            'productsPromotion'=> $productsPromotion,
            'productsByPromotionInPercent'=>$productsByPromotionInPercent


        ]);
    }

  
}
