<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="order")
     */
    public function index(): Response
    {
        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }

    /**
     * @Route("/order/{id}", name="order_list", requirements={"id" = "\d+"})
     * 
     */
    public function customerOrder(int $id, OrderRepository $orderRepository,  UserRepository $userRepository): Response
    {
           //$orders= $orderRepository->find($id); 
           //$userOrder= $userRepository->findByUserOder($id); 
            //dd($orders, $userOrder); 
           
          
        return $this->render('order/index.html.twig', [

             'order' => $orderRepository->find($id),
             'user' => $userRepository->findByUserOder($id)

   ]); 
          
    
        
    }


}
