<?php

namespace ACA\ShopBundle\Controller;

use ACA\ShopBundle\Shop\Product;
use ACA\ShopBundle\Shop\DBCommon;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class CartController responsible for displaying and handling all shopping cart related functionality
 *
 * @package ACA\ShopBundle\Controller
 */
class CartController extends Controller
{
    /**
     * Session object
     * @var Session
     */
    protected $Session;

    public function __construct()
    {
        $this->Session = new Session();
        $this->Session->start();
    }

    /**
     * This method will handle displaying the shopping cart page
     * If there are no items in the cart, we will display a message saying "Cart is empty"
     */
    public function indexAction()
    {
        /** @var DBCommon $db */
        $db = $this->get('db');

        /**
         * Array of all productIds added to the shopping cart
         *
         * @var array
         */
        $cartItems = $this->Session->get('cart_items');

        // Make sure that we have no duplicates
        $cartItems = !empty($cartItems) ? array_unique($cartItems) : null;

        /** @var Product[] $Products Array of all Product objects added to the user's cart */
        $Products = array();

        if (!empty($cartItems)) {

            foreach ($cartItems as $productId) {
                $Product = new Product($productId);
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
     */
    public function addAction()
    {
        $productId = $_POST['product_id'];
        $cartItems = $this->Session->get('cart_items');

        if (empty($cartItems)) {
            $cartItems = array($productId);
        } else {
            $cartItems[] = $productId;
        }

        $this->Session->set('cart_items', $cartItems);

        return $this->redirect('/cart');
    }

    /**
     * Remove a product from the shopping cart
     */
    public function removeAction()
    {
        $productId = $_POST['product_id'];
        $cartItems = $this->Session->get('cart_items');

        foreach ($cartItems as $k => $v) {
            if ($v == $productId) {
                unset($cartItems[$k]);
            }
        }
        $this->Session->set('cart_items', $cartItems);

        return $this->redirect('/cart');
    }
}
