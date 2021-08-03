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
     * @Route("list", name="list")
     *  
     * 
     */
    public function customerOrder(SessionService $sessionService): Response
    {
          
        return $this->render('order/index.html.twig', [
            'cart' => $sessionService->getCart(),
   ]);

    }


    /**
     * @Route("/address/update/{id}", name="update_address", methods={"PATCH","PUT"}, requirements={"id" = "\d+"})
     */
    public function updateAddress(int $id, AddressRepository $addressRepository, Request $request): Response
    {
        $address= $addressRepository->find($id);

        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Votre adresse a bien été mise à jour');

            return $this->redirectToRoute('order_list',[],301);
        }

        return $this->render('user/updateAddress.html.twig', [
            'address' => $address,
            'form' => $form->createView(),
        ]);
    }

}
