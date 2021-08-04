<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\AddressRepository;
use App\Repository\OrderRepository;
use App\Repository\UserRepository;
use App\Service\SessionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class to send order with payment
 * 
 * @Route("/order/", name="order_")
 *  
 */
class OrderController extends AbstractController
{
 
    /**
     * Method to display informations at the order page
     * 
     * @Route("list", name="address_list")
     *  
     * 
     */
    public function customerOrder(SessionService $sessionService): Response
    {
          
        return $this->render('order/index.html.twig', [
            'items' => $sessionService->getCart(),
            'total' => $sessionService->getTotal(),
        ]);

    }

}
