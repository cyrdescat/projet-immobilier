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
