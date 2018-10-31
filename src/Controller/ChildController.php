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

use function GuzzleHttp\Psr7\str;
use Model\Adresse\AdresseManager;
use Model\Adresse\Adresse;

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

        $adresseManager = new AdresseManager($this->getPdo());
        $adresses = $adresseManager->selectAllNotVisited();

        return $this->twig->render('Child/childindex.html.twig', [
            'adresses' => $adresses,
            'inventory' => $_SESSION['inventory']
        ]);

    }

    public function adresseVisited($adresse)
    {
        $adresseV1 = str_replace(",+France", "", $adresse);
        $adresseComplete = str_replace("+", " ", $adresseV1);

        $adresseManager = new AdresseManager($this->getPdo());
        $adresseManager->AddVisiteAdresse($adresseComplete);
        if (empty($_SESSION['inventory']))
            $_SESSION['inventory'] = $this->giveRandomCandies();

        elseif (!empty($_SESSION['inventory']))
            $_SESSION['inventory'] += $this->giveRandomCandies();
        header('Location: /');
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


        return $this->twig->render('Child/selectinventory.html.twig', [
            'name' => $product->product_name_fr,
            'brand' => $product->brands,
            'quantity' => $product->quantity,
            'packaging' => $product->packaging_tags['0'],
            'countries' => $product->countries,
            'ingredients' => $product->ingredients_text_debug,
            'traces' => $product->traces_from_user,
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
