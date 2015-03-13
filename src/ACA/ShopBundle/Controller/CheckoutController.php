<?php

namespace ACA\ShopBundle\Controller;

use ACA\ShopBundle\Shop\Order;
use ACA\ShopBundle\Shop\DBCommon;
use ACA\ShopBundle\Shop\Factory;
use ACA\ShopBundle\Shop\Product;
use ACA\ShopBundle\Shop\OrderComplete;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class CartController responsible for displaying and handling all shopping cart related functionality
 *
 * @package ACA\ShopBundle\Controller
 */
class CheckoutController extends Controller
{
    /**
     * Session object persists data across requests
     *
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
     *
     * @return RedirectResponse
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

            //Set the newly created orderId in session
            $this->Session->set('order_id', $Order->getOrderId());
        }

        return $this->redirect('/receipt');
    }

    /**
     * Display the receipt
     * @return Response
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

    public function billingAction()
    {
        /** @var DBCommon $db */
        $db = $this->get('db');

        $session = $this->get('session');
        $userId = $session->get('user_id');

        $query = '
        select
            a.*
        from
            aca_user u
            inner join aca_address a on (u.billing_address_id = a.address_id)
        where
            u.user_id = "' . $userId . '"';

        $db->setQuery($query);
        $billingAddressRow = $db->loadObject();

        return $this->render('ACAShopBundle:Checkout:billing.html.twig',
            array(
                'billing' => $billingAddressRow
            )
        );
    }

    public function processBillingAction(Request $request)
    {
        try{

            $address = $request->get('address');
            pre($address, '$address');

            $city = $request->get('city');
            pre($city, '$city');

            $state = $request->get('state');
            pre($state, '$state');

            $zip = $request->get('zip');
            pre($zip, '$zip');

            // Validaate not empty

            // collect these values and create an insert query

            // Insert this into the database

        }catch(\Exception $e){

        }


        die();

    }

}