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
    public function select()
    {
            if ($_SESSION['role'] != 1) {
                header('Location: /');
                return null;
            }


        $json_source = file_get_contents("https://fr.openfoodfacts.org/api/v0/produit/50251094.json");
        $json_data = json_decode($json_source);
        $product = $json_data->product;

        echo "Nom du produit : $product->product_name_fr" . "<br />";
        echo "Id du produit : $product->_id"  . "<br />";
        echo "Marque : $product->brands" . "<br />";
        echo "Quantité : $product->quantity" . "<br />";
        echo "Caractéristiques du produit" . "<br />";
        echo "Magasin : $product->stores" . "<br />";
        echo "Conditionnement : " . $product->packaging_tags['0'] . "<br />";
        echo "Pays de vente : " . $product->countries . "<br />";
        echo "Liste des ingrédients : " . $product->ingredients_text_debug . "<br />";
        echo "Traces éventuelles : " . $product->traces_from_user . "<br />";
        echo "<img src='$product->image_front_url'>" . "<br />";
    }
}
