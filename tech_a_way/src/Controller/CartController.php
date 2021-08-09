<?php

namespace App\Controller;

use App\Service\SessionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Undocumented class
 * 
 * @Route("/cart", name="cart_")
 */
class CartController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     * 
     * @return Response
     */
    public function index(SessionService $sessionService)
    {
        // Return the data at the view
        return $this->render('cart/index.html.twig',[
            'items' => $sessionService->getCart(),
            'total' => $sessionService->getTotal(),
        ]);
    }

    /**
     * Method that allows to add an item in the shopping cart
     * 
     * @Route("/add/{id}", name="add", requirements={"id" ="\d+"})
     *
     * @param integer $id
     * @return Response
     */
    public function add(int $id, SessionService $sessionService)
    {   
        $sessionService->add($id);

        // Return at the index method (cart list)
        return $this->redirectToRoute('cart_list');
        
    }


    /**
     * Method that allows to remove one quantity item to the shopping cart
     *
     * @Route("/remove/{id}", name="remove_one_quantity", requirements={"id" ="\d+"})
     * 
     * @param integer $id
     * @return Response
     */
    public function removeOneQuantity(int $id, SessionService $sessionService) 
    {        
        $sessionService->removeOneQuantity($id);

        return $this->redirectToRoute('cart_list');
    }

    /**
     * Method that allows to remove an item to the shopping cart
     *
     * @Route("/remove/all/{id}", name="remove_all_one_product", requirements={"id" ="\d+"})
     * 
     * @param integer $id
     * @return Response
     */
    public function removeAllQuantityOfOneProduct(int $id, SessionService $sessionService) 
    {        
        $sessionService->removeAllQuantityOfOneProduct($id);

        return $this->redirectToRoute('cart_list');
    }


    
}
