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
     * @Route("/", name="home")
     */
    public function index(ProductRepository $reposRecent, ProductRepository $reposInPromotion, ProductRepository $reposPromotionByPercentage): Response
    {
        $productsRecent = $reposRecent->findBy([
            'statusRecent' => null,
        ], null, 6);

        $productsPromotion = $reposInPromotion->findBy([
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

  
}
