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
            $homeCandie = $this->giveRandomCandies();

        return $this->twig->render('Child/childindex.html.twig');
    }
  
    public function inventory()
    {
        if ($_SESSION['role'] != 1) {
            header('Location: /');
            return null;
        }
        $homeCandie = $this->giveRandomCandies();

        return $this->twig->render('Child/inventory.html.twig', ['inventory' => $homeCandie]);
    }
  
    public function select($id)
    {
            if ($_SESSION['role'] != 1) {
                header('Location: /');
                return null;
            }
      
        $json_source = file_get_contents("https://fr.openfoodfacts.org/api/v0/produit/$id.json");
        $json_data = json_decode($json_source);
        $product = $json_data->product;

       /* echo "Nom du produit : $product->product_name_fr" . "<br />";
        echo "Id du produit : $product->_id"  . "<br />";
        echo "Marque : $product->brands" . "<br />";
        echo "Quantité : $product->quantity" . "<br />";
        echo "Caractéristiques du produit" . "<br />";
        echo "Conditionnement : " . $product->packaging_tags['0'] . "<br />";
        echo "Pays de vente : " . $product->countries . "<br />";
        echo "Liste des ingrédients : " . $product->ingredients_text_debug . "<br />";
        echo "Traces éventuelles : " . $product->traces_from_user . "<br />";
        echo "<img src='$product->image_front_url'>" . "<br />";*/

        return $this->twig->render('Child/selectinventory.html.twig', [
            'name' => $product->product_name_fr,
            'brand' => $product->brands,
            'quantity' => $product->quantity,
            'packaging' => $product->packaging_tags['0'],
            'countries' => $product->countries,
            'ingredients' => $product->ingredients_text_debug,
            'image' => $product->image_front_url
        ]);
    }

    public function giveRandomCandies(): array
    {
        $randomPage = rand(1, 50);
        $randomCandies = rand(8, 14);


        for ($i = 1; $i <= 2; $i++) {
            $randomPage++;
            $candies = [];

            $json_source = file_get_contents("https://ssl-api.openfoodfacts.org/category/candies/$randomPage.json");
            $json_data = json_decode($json_source);
            $products = $json_data->products;

            foreach ($products as $product) {
                if (!empty($product->product_name_fr))
                    $candies[$product->product_name_fr] = $product->id;
            }
        }
        for ($i = 0; $i <= $randomCandies; $i++) {
            array_shift($candies);
        }
        return $candies;
    }
}
