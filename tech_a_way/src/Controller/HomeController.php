<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

 
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProductRepository $repos): Response
    {
        $productsRecent = $repos->findByStatusRecent(1);
        dd($productsRecent);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'productsRecent'=> $productsRecent,
        ]);
    }
}
