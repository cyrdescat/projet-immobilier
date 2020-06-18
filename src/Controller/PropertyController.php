<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\PropertyManager;

/**
 * Class PropertyController
 *
 */
class PropertyController extends AbstractController
{
    const PAGES_NUMBER = [10, 20, 50];
    const PAGES_SORT = [
        'plus récentes',
        'plus anciennes',
        'plus grandes',
        'plus petites',
        'prix croissants',
        'prix décroissants'
    ];
    const NEARBY_PAGES_LIMIT = 3;

    /**
     * Display item listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $propertyManager = new PropertyManager();
        $items = $propertyManager->selectAll();

        return $this->twig->render('Property/index.html.twig', ['items' => $items]);
    }

    /**
     *
     */
    public function searchProperties()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            session_start();
            if (!empty($_POST['surface'])) {
                $_SESSION['surface'] = $_POST['surface'];
            } else {
                $_SESSION['surface'] = 0;
            }
            if (!empty($_POST['room'])) {
                $_SESSION['room'] = $_POST['room'];
            } else {
                $_SESSION['room'] = 0;
            }
            if (!empty($_POST['city'])) {
                $_SESSION['city'] = strtolower($_POST['city']);
            } else {
                $_SESSION['city'] = "";
            }
            if (!empty($_POST['price'])) {
                $_SESSION['price'] = $_POST['price'];
            } else {
                $_SESSION['price'] = 0;
            }

            header("Location:/Property/showSearchedProperties?page=1&nbElements=10&filter=0");
        } else {
            header("Location:index");
        }
    }

    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function showSearchedProperties()
    {
        session_start();
        if (isset($_SESSION['price'])) {
            if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] >= 1) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }

            if (isset($_GET['nbElements']) && is_numeric($_GET['nbElements']) && $_GET['nbElements'] >= 1) {
                $nbElements = $_GET['nbElements'];
            } else {
                $nbElements = 10;
            }

            if (isset($_GET['filter']) && array_key_exists($_GET['filter'], self::PAGES_SORT)) {
                $filterId = $_GET['filter'];
            } else {
                $filterId = 0;
            }
            $filter = self::PAGES_SORT[$filterId];

            $propertyManager = new PropertyManager();
            $properties = $propertyManager->searchProperty(
                $_SESSION['surface'],
                $_SESSION['room'],
                $_SESSION['city'],
                $_SESSION['price'],
                $page,
                $nbElements,
                $filterId
            );

            $totalElements = $propertyManager->countSearchedProperties(
                $_SESSION['surface'],
                $_SESSION['room'],
                $_SESSION['city'],
                $_SESSION['price']
            );

            $maxPages = ceil($totalElements / $nbElements);
            $pageURL = strtok($_SERVER['REQUEST_URI'], '?');

            var_dump(self::PAGES_SORT);
            return $this->twig->render('Property/index.html.twig', [
                'properties' => $properties,
                'currentFilter' => $filter,
                'currentFilterId' => $filterId,
                'filters' => self::PAGES_SORT,
                'maxPages' => $maxPages,
                'currentPage' => $page,
                'nbElements' => $nbElements,
                'pageURL' => $pageURL,
                'nearbyPagesLimit' => self::NEARBY_PAGES_LIMIT,
                'pagesNumber' => self::PAGES_NUMBER,
            ]);
        } else {
            header("Location:index");
        }
    }

    /**
     * Display item informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {

        $propertyManager = new PropertyManager();
        $item = $propertyManager->selectOneById($id);

        return $this->twig->render('Property/show.html.twig', ['item' => $item]);
    }


    /**
     * Display item edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $propertyManager = new PropertyManager();
        $item = $propertyManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $item['title'] = $_POST['title'];
            $propertyManager->update($item);
        }

        return $this->twig->render('Property/edit.html.twig', ['item' => $item]);
    }


    /**
     * Display item creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $propertyManager = new PropertyManager();
            $item = [
                'title' => $_POST['title'],
            ];
            $id = $propertyManager->insert($item);
            header('Location:/Property/show/' . $id);
        }

        return $this->twig->render('Property/add.html.twig');
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function showOne()
    {
        $propertyManager = new PropertyManager();
        $property = $propertyManager->selectAllFromOne($_GET["id"]);
        $pictures = $propertyManager->selectPicturesFromOne($_GET["id"]);
        $agences = $propertyManager->selectAgenceFromOne($_GET["id"]);        
        $pageURL = strtok($_SERVER['REQUEST_URI'], '?');

        return $this->twig->render('/Property/showOne.html.twig', [
            'property' => $property, 
            'pictures' => $pictures, 
            'agences' => $agences,
            'pageURL' => $pageURL
            ]);

    }

    /**
     * Handle item deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $propertyManager = new PropertyManager();
        $propertyManager->delete($id);
        header('Location:/Property/index');
    }
}
