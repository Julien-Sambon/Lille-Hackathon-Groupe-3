<?php

/**
 * UserController file
 *
 * PHP Version 7.2
 *
 * @category Controller
 * @package  Controller
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */
namespace Controller;

use Model\User\User;
use Model\User\UserManager;

/**
 * User class controller.
 *
 * @category Controller
 * @package  Controller
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */

class UserController extends AbstractController
{
    /**
     * Login's page
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return string The rendered template
     */
    public function login()
    {
        /* You have to display a login form and check
        connection with a GET/POST condition.
        Don't forget to create a session ;)
        Write your code here ! */

        return $this->twig->render('User/login.html.twig');
    }

    /**
     * User's profile page
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return string The rendered template
     */
    public function profile()
    {
        /* After user's login, check if a session exists
        and send user's information to profile's view.
        Write your code here ! */

        return $this->twig->render('User/profile.html.twig');
    }
}
