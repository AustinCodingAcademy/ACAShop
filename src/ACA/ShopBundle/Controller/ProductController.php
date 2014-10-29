<?php

namespace ACA\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    public function addAction()
    {
        return $this->render('ACAShopBundle:Product:add.html.twig');
    }
}
