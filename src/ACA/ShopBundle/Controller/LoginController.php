<?php

namespace ACA\ShopBundle\Controller;

use ACA\ShopBundle\Shop\DBCommon;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LoginController extends Controller
{
    /**
     * Handle login
     */
    public function processLoginAction()
    {
        /** @var DBCommon $db */
        $db = $this->get('db');

        /** @var Session $session */
        $session = $this->get('session');

        $username = $_POST['username'];
        $password = $_POST['password'];

        // Check if this is in the DB or not.
        $query = 'select * from aca_user where username = "' . $username . '" and password = "' . $password . '"';

        $db->setQuery($query);
        $user = $db->loadObject();

        // If the user is in the database, set a value in session that says they are logged in
        // Otherwise, redirect them back to the home page

        if (empty($user)) {

            return new RedirectResponse('/');
        } else {

            // we are logged in!

            $name = $user->name;

            // We want to store this in session, and indicate the user is logged in
            $session->set('logged_in', true);
            $session->set('name', $name);

            return new RedirectResponse('/');
        }
    }

    public function processLogoutAction()
    {
        /** @var Session $session */
        $session = $this->get('session');

        $session->clear();

        return new RedirectResponse('/');
    }
}