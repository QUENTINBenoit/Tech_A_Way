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
        $order = new Order();
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        $cart = $sessionService->getCart();

        if ($form->isSubmitted() && $form->isValid()) {

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
        ]);
    }

    
}
