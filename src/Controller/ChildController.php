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

use GuzzleHttp\Client;

use Model\User\User;
use Model\User\UserManager;

/**
 * User class controller.
 *
 * @category Controller
 * @package  Controller
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */

class ChildController extends AbstractController
{
    public function index()
    {
            if ($_SESSION['role'] != 1) {
                header('Location: /');
                return null;
            }


        $json_source = file_get_contents("https://fr.openfoodfacts.org/api/v0/produit/5010477352712.json");
        $json_data = json_decode($json_source);
        $product = $json_data->product;

        echo "Magasin : $product->stores" . "<br />";
        echo "Quantité : $product->quantity" . "<br />";

        die();
    }
}
