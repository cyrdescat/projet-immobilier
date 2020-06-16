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
    private $limitSlider = 3;

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
        $items = $propertyManager->selectSlider($this->limitSlider);

        // Favorite
        $item = $propertyManager->selectOneById($this->favorite);

        // Last 10 new properties 
        $newProperties = $propertyManager->selectNewProperty();

        return $this->twig->render('Home/index.html.twig', ['items' => $items, 'favorite' => $item, 'newProperties' => $newProperties]);
    }
}
