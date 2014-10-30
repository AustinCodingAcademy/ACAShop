<?php

namespace ACA\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ACA\ShopBundle\Shop\Product;
use ACA\ShopBundle\DB\DBCommon;

class DefaultController extends Controller
{
    public function indexAction()
    {
        /** @var DBCommon $DB */
        $DB = $this->get('db');

        $query = 'select * from aca_user';
        $DB->setQuery($query);
        $rows = $DB->loadObjectList();
        pre($rows,'$rows');

        return $this->render('ACAShopBundle:Default:index.html.twig');
    }
}
