<?php

namespace ACA\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ACA\ShopBundle\Shop\Test\ChildTable;
use ACA\ShopBundle\Shop\Test\NephewTable;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $session = $this->get('session');

        $loggedIn = $session->get('logged_in');
        $name = $session->get('name');
        $isError = $session->get('is_error');
        $msg = $session->get('msg');

        return $this->stream(
            'ACAShopBundle:Default:index.html.twig',
            array(
                'loggedIn' => $loggedIn,
                'name' => $name,
                'isError' => $isError,
                'msg' => $msg
            )
        );
    }
}