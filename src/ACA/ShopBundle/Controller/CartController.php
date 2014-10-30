<?php

namespace ACA\ShopBundle\Controller;

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
     */
    public function indexAction()
    {
        return $this->render('ACAShopBundle:Cart:index.html.twig');
    }
}
