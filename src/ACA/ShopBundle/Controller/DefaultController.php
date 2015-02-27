<?php

namespace ACA\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $session = $this->get('session');

        $loggedIn = $session->get('logged_in');
        $name = $session->get('name');

        return $this->render(
            'ACAShopBundle:Default:index.html.twig',
            array(
                'loggedIn' => $loggedIn,
                'name' => $name
            )
        );
    }
}