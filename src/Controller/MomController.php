<?php

/**
 * StaffController file
 *
 * PHP Version 7.2
 *
 * @category Controller
 * @package  Controller
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */

namespace Controller;

use Model\Adresse\Adresse;
use Model\Adresse\AdresseManager;

/**
 * Staff class controller
 *
 * @category Controller
 * @package  Controller
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */
class MomController extends AbstractController
{
    /**
     * Display staff's index
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return string The rendered template
     */
    public function index()
    {
        if ($_SESSION['role'] != 2) {
            header('Location: /');
            return null;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['adresse'])) {

                $adresseManager = new AdresseManager($this->getPdo());
                $adresse = new Adresse();
                $adresse->setLocation($_POST['adresse']);

                $adresseManager->addAdresse($adresse);

                return $this->twig->render('Mom/momindex.html.twig');
            }
            return $this->twig->render('Mom/momindex.html.twig');
        }
        return $this->twig->render('Mom/momindex.html.twig');

    }
}