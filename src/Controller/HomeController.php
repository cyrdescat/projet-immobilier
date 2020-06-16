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
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        //Slider
        $propertyManager = new PropertyManager();
        $items = $propertyManager->selectSlider($this->limitSlider);

        //Coup de coeur


        return $this->twig->render('Home/index.html.twig', ['items' => $items]);
    }
}
