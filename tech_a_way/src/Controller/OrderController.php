<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{


    /**
     * @Route("/order/{id}", name="order_list", requirements={"id" = "\d+"})
     * 
     */
    public function customerOrder(int $id, OrderRepository $orderRepository,  UserRepository $userRepository, SessionInterface $sessionInterface): Response
    {
           //$orders= $orderRepository->find($id); 
           //$userOrder= $userRepository->findByUserOder($id); 
            //dd($orders, $userOrder); 
           
            $cart = $sessionInterface->get('cart', []);
          
        return $this->render('order/index.html.twig', [

             'order' => $orderRepository->find($id),
             'user' => $userRepository->findByUserOrder($id),
             'cart' => $cart,

   ]);

    }

    /**
     * Method to redirect the cart page at the order page to finalize the order
     *
     * @Route("/order/list", name="order_payement")
     * 
     * @return void
     */
    public function orderPage(SessionInterface $sessionInterface)
    {
        
        $cart = $sessionInterface->get('cart', []);
    }


}
