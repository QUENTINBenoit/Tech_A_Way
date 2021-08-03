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
     * 
     * @return Response
     */
    public function index(SessionInterface $sessionInterface, ProductRepository $productRepository)
    {
        // dd($sessionInterface->get('cart'));
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
        
        // declared variable for total price in the cart
        $total = 0;
        //dd($cart); 
        // Loop to calculate the total for each product and total global
        foreach($cartWithData as $item) {
           //  dd($cartWithData ); 
            $totalItem = $item['product']->getInclTaxesPrice() * $item['quantity'];
            
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
     * @param integer $id
     * @return Response
     */
    public function add(int $id, SessionInterface $sessionInterface)
    {   
        // Begin by storage a session array with the "cart" key if exist otherwise empty table
        $cart = $sessionInterface->get('cart', []);

        // for each product, if it exist the quantity is increment to one more otherwise start to one
        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        // Set the array variable "$cart" which contain the data into the session
        $sessionInterface->set('cart', $cart);
      
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
    public function removeOneQuantity(int $id, SessionInterface $sessionInterface) {

        $cart = $sessionInterface->get('cart', []);

        if (!empty($cart[$id])) {
            $cart[$id]--;

            if($cart[$id] < 1){
                unset($cart[$id]);
            }
        }

        $sessionInterface->set('cart', $cart);

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
    public function removeAllOneProduct(int $id, SessionInterface $sessionInterface) {

        $cart = $sessionInterface->get('cart', []);

        if (!empty($cart[$id])) {

            unset($cart[$id]);
        }

        $sessionInterface->set('cart', $cart);

        return $this->redirectToRoute('cart_list');

    }


    
}
