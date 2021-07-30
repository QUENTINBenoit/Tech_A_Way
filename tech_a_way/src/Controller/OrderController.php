<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
 
    /**
     * @Route("/order", name="order_list")
     *  
     * 
     */
    public function customerOrder(SessionInterface $sessionInterface): Response
    {
        

        $cart = $sessionInterface->get('cart', []);
          
        return $this->render('order/index.html.twig', [

            'cart' => $cart,
   ]);

    }

}
