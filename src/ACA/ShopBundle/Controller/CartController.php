<?php

namespace ACA\ShopBundle\Controller;

use ACA\ShopBundle\Shop\Product;
use ACA\ShopBundle\Shop\DBCommon;

use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class CartController responsible for displaying and handling all shopping cart related functionality
 *
 * @package ACA\ShopBundle\Controller
 */
class CartController extends Controller
{
    /**
     * This method will handle displaying the shopping cart page
     * If there are no items in the cart, we will display a message saying "Cart is empty"
     *
     * @return Response
     */
    public function indexAction()
    {
        /** @var DBCommon $db */
        $db = $this->get('db');

        /** @var Session $session */
        $session = $this->get('session');

        /**
         * Array of all productIds added to the shopping cart
         *
         * @var array
         */
        $cartItems = $session->get('cart_items');

        // Make sure that we have no duplicates
//        $cartItems = !empty($cartItems) ? array_unique($cartItems) : null;

        /** @var Product[] $Products Array of all Product objects added to the user's cart */
        $Products = array();

        if (!empty($cartItems)) {

            foreach ($cartItems as $cartItem) {

                $Product = new Product($cartItem['productId']);
                $Product->setQuantity($cartItem['quantity']);
                $Product->setDb($db);
                $Product->load();
                $Products[] = $Product;
            }
        }

        return $this->render(
            'ACAShopBundle:Cart:index.html.twig',
            array(
                'Products' => $Products
            )
        );
    }

    /**
     * Add a product to the shopping cart
     *
     * @return RedirectResponse
     */
    public function addAction()
    {
        /** @var Session $session */
        $session = $this->get('session');

        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        $cartItems = $session->get('cart_items');

        if (empty($cartItems)) {

            $cartItems = array(
                array(
                    'productId' => $productId,
                    'quantity' => $quantity
                )
            );

        } else {

            $cartItems[] = array(
                'productId' => $productId,
                'quantity' => $quantity
            );
        }

        $session->set('cart_items', $cartItems);

        return $this->redirect('/cart');
    }

    /**
     * Remove a product from the shopping cart
     *
     * @return RedirectResponse
     */
    public function removeAction()
    {
        /** @var Session $session */
        $session = $this->get('session');

        $productId = $_POST['product_id'];
        $cartItems = $session->get('cart_items');

        foreach ($cartItems as $k => $v) {
            if ($v == $productId) {
                unset($cartItems[$k]);
            }
        }

        $session->set('cart_items', $cartItems);

        return $this->redirect('/cart');
    }
}
