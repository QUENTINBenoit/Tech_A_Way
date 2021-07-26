<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExampleIntegrationController extends AbstractController
{
    /**
     * @Route("/example/integration", name="example_integration")
     */
    public function index(): Response
    {
        return $this->render('example_integration/index.html.twig', [
            'controller_name' => 'ExampleIntegrationController',
        ]);
    }
}
