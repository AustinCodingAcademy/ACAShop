<?php

namespace ACA\ShopBundle\Controller;

use ACA\ShopBundle\Shop\Order;
use ACA\ShopBundle\Shop\DBCommon;
use ACA\ShopBundle\Shop\Factory;
use ACA\ShopBundle\Shop\OrderComplete;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class CartController responsible for displaying and handling all shopping cart related functionality
 *
 * @package ACA\ShopBundle\Controller
 */
class CheckoutController extends Controller
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
     * Process this order
     */
    public function processAction()
    {
        /** @var DBCommon $db Database handle */
        $db = $this->get('db');

        /** @var array $cartItems Array of all productIds that have been added to the user's shopping cart */
        $cartItems = $this->Session->get('cart_items');

        /** @var Factory $Factory */
        $Factory = $this->get('factory');

        /** @var Product[] $Products */
        $Products = $Factory->getSomeProducts($cartItems);

        $Order = new Order($db);
        $Order->setProducts($Products);

        if ($Order->placeOrder()) {
            //Clear out cart items in session
            $this->Session->remove('cart_items');

            //Set the newly created orderId in session
            $this->Session->set('order_id', $Order->getOrderId());
        }

        return $this->redirect('/receipt');
    }

    /**
     * Display the receipt
     */
    public function receiptAction()
    {
        $orderId = $this->Session->get('order_id');

        $OrderComplete = new OrderComplete($orderId);
        /** @var DBCommon $db */
        $db = $this->get('db');
        $OrderComplete->setDb($db);
        $OrderComplete->loadOrder();

        $OrderProducts = $OrderComplete->getOrderProducts();

        return $this->render(
            'ACAShopBundle:Checkout:receipt.html.twig',
            array(
                'OrderProducts' => $OrderProducts
            )
        );
    }
}
