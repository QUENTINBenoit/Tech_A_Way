<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeFredController extends AbstractController
{
    /**
     * @Route("/", name="home_fred")
     */
    public function index(): Response
    {
        return $this->render('home_fred/index.html.twig', [
            'controller_name' => 'HomeFredController',
        ]);
    }
}
