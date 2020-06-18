<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\PropertyManager;

class HomeController extends AbstractController
{

    /**
     * @var integer
     */
    private $limitSlider = 10;

     /**
     * @var integer
     */
    private $favorite  = 1;

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        // Slider
        $propertyManager = new PropertyManager();
        $properties = $propertyManager->selectSlider($this->limitSlider);

        // Coup de coeur
        $favorite = $propertyManager->selectFavorite();

        // Last 10 new properties
        $propertyNum = 10;
        $newProperties = $propertyManager->selectNewProperty($propertyNum);
        
        $pageURL = strtolower(strtok($_SERVER['REQUEST_URI'], '?'));

        return $this->twig->render('Home/index.html.twig', [
            'properties' => $properties,
            'favorite' => $favorite,
            'newProperties' => $newProperties,
            'pageURL' => $pageURL
        ]);
    }
}
