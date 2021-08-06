<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\User;
use App\Form\ModeOfPaymentType;
use App\Form\OrderType;
use App\Repository\AddressRepository;
use App\Repository\OrderRepository;
use App\Repository\UserRepository;
use App\Service\SessionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class to send order with payment
 * 
 * @Route("/order", name="order_")
 */
class OrderController extends AbstractController
{
 
    /**
     * Method to display informations at the order page
     * 
     * @Route("/list", name="address_list")
     * 
     */
    public function customerOrderAddressList(SessionService $sessionService)
    {
          
        return $this->render('order/index.html.twig',[
            'items' => $sessionService->getCart(),
            'total' => $sessionService->getTotal(),
        ]);

    }


    /**
     * Method that allows to send the user at the payement choices page
     *
     * @Route("/payment", name="payment_list")
     * 
     * @return void
     */
    public function customerOrderPayementList(Request $request, SessionService $sessionService): Response
    {
        $form = $this->createForm(OrderType::class);
        $formPayment = $this->createForm(ModeOfPaymentType::class);
        $form->handleRequest($request);
        $formPayment->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

        }

        if ($formPayment->isSubmitted() && $formPayment->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Votre commande a bien été envoyée');
            $sessionService->emptyCart();

            // return $this->redirectToRoute('email');

            return $this->redirectToRoute('home', [], 301);
        }

        return $this->render('order/payment.html.twig', [
            'form' => $form->createView(),
            'formPayment' => $formPayment->createView(),
        ]);
    }

}
