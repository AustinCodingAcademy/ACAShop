<?php

namespace ACA\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ACA\ShopBundle\Shop\Product;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $DB = $this->get('db');
        print_r($DB);

//        $Product = new Product(124);

        return $this->render('ACAShopBundle:Default:index.html.twig');
    }
}
