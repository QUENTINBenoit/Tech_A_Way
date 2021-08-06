<?php

namespace App\Controller;

use App\Entity\ModeOfPayment;
use App\Entity\Order;
use App\Entity\OrderLine;
use App\Entity\User;
use App\Form\ModeOfPaymentType;
use App\Form\OrderType;
use App\Repository\AddressRepository;
use App\Repository\OrderRepository;
use App\Repository\StatusRepository;
use App\Repository\UserRepository;
use App\Service\SendEmail;
use App\Service\SessionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

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
     * @Route("/payment/{id}", name="payment_list", requirements={"id" = "\d+"})
     * 
     * @return 
     */
    public function customerOrderPayementList(Request $request, SessionService $sessionService, StatusRepository $statusRepository, User $user, SendEmail $sendEmail, UserInterface $userInterface): Response
    {
        $order = new Order();
        $modeOfPayment = new ModeOfPayment();

        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        $formPayment = $this->createForm(ModeOfPaymentType::class, $modeOfPayment);
        $formPayment->handleRequest($request);

        $cart = $sessionService->getCart();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
                
            $order->setModeOfPayment($modeOfPayment);
            $order->setUser($user);

            $status = $statusRepository->find(1);
            $order->setStatus($status); 
            $entityManager->persist($modeOfPayment);  

                foreach ($cart as $item) {
                        $orderLine = new OrderLine();
                        // dd($item['product']->getName());
                        $orderLine->setProductName($item['product']->getName());
                        $orderLine->setexclTaxesUnitPrice($item['product']->getExclTaxesPrice());
                        $orderLine->setSalesTax($item['product']->getSalesTax());
                        $orderLine->setInclTaxesUnitPrice($item['product']->getInclTaxesPrice());
                        $orderLine->setQuantity($item['quantity']);
                        $order->addOrderLine($orderLine);
                        $entityManager->persist($orderLine);
                        $entityManager->persist($order);  
                }
                    
                $entityManager->flush();
      
            
            $sessionService->emptyCart();
            $this->addFlash('success', 'Votre commande a bien été envoyée');
            // dd($sessionService->getTotal());
            $sendEmail->sendEmail($userInterface, 'Confirmation de votre commande', 'order.confirmed', 'de confirmation de commande', $sessionService->getCart(), $sessionService->getTotal());
            
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






