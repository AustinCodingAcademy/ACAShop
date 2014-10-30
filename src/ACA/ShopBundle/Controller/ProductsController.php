<?php

namespace ACA\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class ProductsController is responsible for product related functionality
 *
 * @package ACA\ShopBundle\Controller
 */
class ProductsController extends Controller
{
    /**
     * Product listing, display all products we have for sale
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listingAction()
    {
        return $this->render('ACAShopBundle:Products:list.html.twig');
    }

    /**
     * Show the add product form that allows us to add a product to the aca_product table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction()
    {
        return $this->render('ACAShopBundle:Products:add.html.twig');
    }
}
