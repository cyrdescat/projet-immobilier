<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\AgenceManager;

/**
 * Class AgenceController
 *
 */
class AgenceController extends AbstractController
{


    /**
     * Display agence listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $agenceManager = new AgenceManager();
        $agences = $agenceManager->selectAll();

        $pageURL = strtolower(strtok($_SERVER['REQUEST_URI'], '?'));

        return $this->twig->render('Agence/index.html.twig', [
            'agences' => $agences,
            'pageURL' => $pageURL,
        ],);
    }


    /**
     * Display agence informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $agenceManager = new AgenceManager();
        $agence = $agenceManager->selectOneById($id);

        return $this->twig->render('Agence/show.html.twig', ['agence' => $agence]);
    }


    /**
     * Display agence edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $agenceManager = new AgenceManager();
        $agence = $agenceManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $agence['title'] = $_POST['title'];
            $agenceManager->update($agence);
        }

        return $this->twig->render('Agence/edit.html.twig', ['agence' => $agence]);
    }


    /**
     * Display agence creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $agenceManager = new AgenceManager();
            $agence = [
                'title' => $_POST['title'],
            ];
            $id = $agenceManager->insert($agence);
            header('Location:/agence/show/' . $id);
        }

        return $this->twig->render('Agence/add.html.twig');
    }


    /**
     * Handle agence deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $agenceManager = new AgenceManager();
        $agenceManager->delete($id);
        header('Location:/agence/index');
    }
}
