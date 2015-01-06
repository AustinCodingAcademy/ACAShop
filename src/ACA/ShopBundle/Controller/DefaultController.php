<?php

namespace ACA\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ACAShopBundle:Default:index.html.twig');
    }
}