<?php

namespace App\Controller;

use App\Entity\ModeOfPayment;
use App\Entity\Order;
use App\Entity\OrderLine;
use App\Entity\User;
use App\Form\OrderType;
use App\Form\UserReductforAddressType;
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
     * @Route("/{id}/create", name="create")
     */
    public function customerOrderAddressList(Request $request, SessionService $sessionService, User $user, StatusRepository $statusRepository, SendEmail $sendEmail): Response
    {
        $empty = null;

        $addressBillAlreadyCreated = true;
        $addressBill = [];
        $numberAddressBill = 0;

        $addressDeliveryAlreadyCreated = true;
        $addressDelivery = [];
        $numberAddressDelivery = 0;

        foreach ($user->getAddresses() as $address){
            if(($address->getType() == 'Facturation')){
                $addressBill['street'] = $address->getStreet();
                $addressBill['zipcode'] = $address->getZipcode();
                $addressBill['city'] = $address->getCity();
                $numberAddressBill++;
            }
            if(($address->getType() == 'Livraison')){
                $addressDelivery['street'] = $address->getStreet();
                $addressDelivery['zipcode'] = $address->getZipcode();
                $addressDelivery['city'] = $address->getCity();
                $numberAddressDelivery++;
            }
        }
       if ($numberAddressBill != 1){
           $this->addFlash('danger', 'Vous n\'avez pas spécifié d\'adresse de FACTURATION. Veuillez en attribuer une dans votre compte client ou en créer une en cliquant sur le bouton ci-dessous');
           $addressBillAlreadyCreated = false;
       }
       if ($numberAddressDelivery != 1){
        $this->addFlash('danger', 'Vous n\'avez pas spécifié d\'adresse de LIVRAISON. Veuillez en attribuer une dans votre compte client ou en créer une en cliquant sur le bouton ci-dessous');
        $addressDeliveryAlreadyCreated = false;
    }
      if($addressDeliveryAlreadyCreated == false && $addressBillAlreadyCreated == false){
         $empty = true;
      }
        $order = new Order();
        $form = $this->createForm(OrderType::class, $order);
        
        if ($addressBill){
            $order->setStreetBill($addressBill['street']);
            $order->setZipcodeBill($addressBill['zipcode']);
            $order->setCityBill($addressBill['city']);
        }
        if ($addressDelivery){
            $order->setStreetDelivery($addressDelivery['street']);
            $order->setZipcodeDelivery($addressDelivery['zipcode']);
            $order->setCityDelivery($addressDelivery['city']);
        }
        
        $form->handleRequest($request);
        $cart = $sessionService->getCart();
        
        if ($form->isSubmitted() && $form->isValid()) {
            // dd('je suis là');

            $entityManager = $this->getDoctrine()->getManager();
            $order->setUser($user);

            $status = $statusRepository->find(1);
            $order->setStatus($status);

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
            $sendEmail->sendEmail($user, 'Confirmation de votre commande', 'order.confirmed', 'de confirmation de commande', $sessionService->getCart(), $sessionService->getTotal());

            $sessionService->emptyCart();

            // return $this->redirectToRoute('email');
            return $this->redirectToRoute('home', [], 301);
        }
        
        
      

        return $this->render('order/create.html.twig', [
            'form' => $form->createView(),
            'items' => $sessionService->getCart(),
            'total' => $sessionService->getTotal(),
            'addressBillAlreadyCreated' => $addressBillAlreadyCreated,
            'addressDeliveryAlreadyCreated' => $addressDeliveryAlreadyCreated,
            'empty' => $empty,
        ]);
    }

    
}
