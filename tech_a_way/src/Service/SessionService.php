<?php

namespace App\Service;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SessionService
{

    protected $session;
    protected $productRepository;

    public function __construct(SessionInterface $sessionInterface, ProductRepository $productRepository)
    {
        $this->session = $sessionInterface;
        $this->productRepository = $productRepository;
    }


    /**
     * Method that allows to add the spécific product in the cart with the help of it's ID
     *
     * @return array
     */
    public function getCart(): array
    {
        // Search the session with de 'cart' key if exist otherwise an empty array
        $cart = $this->session->get('cart', []);

        // Create a new empty array to store the product(s) and quantity data
        $cartWithData = [];

        // To fill the data in the array, we create a loop on the $cart array to find the key which represent the id of the product and the value which represent the quantity
        foreach ($cart as $id => $quantity) {
            $cartWithData[] = [
                'product' => $this->productRepository->find($id),
                'quantity' => $quantity,
            ];
        }

        // return the array which contain the data
        return $cartWithData;
        
    }

    /**
     * Method that allows to calculate the global total of all quantities in the cart
     *
     * @return float
     */
    public function getTotal(): float
    {
        // declared variable for total price in the cart
        $total = 0;

        // Loop to calculate the total for each product and total global
        foreach ($this->getCart() as $item) {
            $total += $item['product']->getInclTaxesPrice() * $item['quantity'];
        }

        // Return the float data
        return $total;
    }

    /**
     * Method that allows to add one quantity product to the cart
     *
     * @param integer $id
     * @return void
     */
    public function add(int $id)
    {
        // Begin by storage a session array with the "cart" key if exist otherwise empty table
        $cart = $this->session->get('cart', []);
        
        // for each product, if it exist the quantity is increment to one more otherwise start to one
        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        // Set the array variable "$cart" which contain the data into the session
        $this->session->set('cart', $cart);
    }
        
    /**
     * Method that allows to delete one quantity product
     *
     * @param integer $id
     * @return void
     */
    public function removeOneQuantity(int $id)
    {
        $cart = $this->session->get('cart', []);

        if (!empty($cart[$id])) {
            $cart[$id]--;

            if($cart[$id] < 1){
                unset($cart[$id]);
            }
        }

        $this->session->set('cart', $cart);
    }


    /**
     * Method that allows to delete all quantity of one product
     *
     * @param integer $id
     * @return void
     */
    public function removeAllQuantityOfOneProduct(int $id)
    {
        $cart = $this->session->get('cart', []);

        if (!empty($cart[$id])) {

            unset($cart[$id]);
        }

        $this->session->set('cart', $cart);
    }


    /**
     * Method that allows to empty the session cart
     *
     * @return void
     */
    public function emptyCart()
    {
        $this->session->clear();
    }
        
   
}