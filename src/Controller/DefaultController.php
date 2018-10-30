<?php

/**
 * DefaultController file
 *
 * PHP Version 7.2
 *
 * @category Controller
 * @package  Controller
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */

namespace Controller;

/**
 * Class default controller.
 *
 * @category Controller
 * @package  Controller
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */
class DefaultController extends AbstractController
{
    /**
     * Displaying home page
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return string The rendered template
     */
    public function index()
    {
        if (!empty($_SESSION['role']))
        {
            if ($_SESSION['role'] == 2) {
                header('Location: /mom');
                return null;
            } elseif ($_SESSION['role'] == 1) {
                header('Location: /child');
                return null;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['role'] == 2) {
                $_SESSION['role'] = 2;
                header('Location: /mom');
            }

            elseif ($_POST['role'] == 1) {
                $_SESSION['role'] = 1;
                header('Location: /child');
            }
        }
        return $this->twig->render('index.html.twig');
    }

    public function disconnect()
    {
        session_destroy();
        header('Location: /');
    }
}