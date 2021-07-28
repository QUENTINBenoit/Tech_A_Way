<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
     */
    public function index(SessionInterface $sessionInterface, ProductRepository $productRepository): Response
    {
        // Search the session with de 'cart' key if exist otherwise an empty array
        $cart = $sessionInterface->get('cart', []);

        // Create a new empty array to store the product and quantity data
        $cartWithData = [];

        // To fill the data in the array, we create a loop on the $cart array to find the key which represent the id of the product and the value which represent the quantity
        foreach($cart as $id => $quantity) {
            $cartWithData[] = [
                'product' => $productRepository->find($id),
                'quantity' => $quantity,
            ];
        }

        $total = 0;

        foreach($cartWithData as $item) {
            $totalItem = $item['product']->getinclTaxesPrice() * $item['quantity'];
            $total += $totalItem;
        }

        // Return the data at the view
        return $this->render('cart/index.html.twig', [
            'items' => $cartWithData,
            'total' => $total,
        ]);
    }

    /**
     * Method that allows to add an item to the shopping cart
     * 
     * @Route("/add/{id}", name="add", requirements={"id" ="\d+"})
     *
     */
    public function add(int $id, SessionInterface $sessionInterface)
    {   
        // Begin by storage a session array with the "cart" key if exist otherwise empty table
        $cart = $sessionInterface->get('cart', []);

        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        };

        $sessionInterface->set('cart', $cart);

        dd($sessionInterface->get('cart'));
        
    }

    
}
