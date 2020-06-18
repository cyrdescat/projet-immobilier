<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\ContactManager;

class ContactController extends AbstractController
{

    public function showOne()
    {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];

            $contactManager = new ContactManager();
            $contact = $contactManager->getOne(intval($id));

            if ($contact != []) {
                return $this->twig->render('Contact/showOne.html.twig', ['contact' => $contact, 'id' => $id]);
            }
        }
        header('Location:/Contact/showAll');
    }

    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function showAll()
    {
        $contactManager = new ContactManager();
        $contacts = $contactManager->getAll();

        if (isset($_GET['id'])) {
            if (is_numeric($_GET['id']) && array_key_exists($_GET['id'], $contacts)) {
                $contactManager->delete(intval($_GET['id']));
            } elseif ($_GET['id'] === "ALL") {
                $contactManager->deleteAll();
            }
            $contacts = $contactManager->getAll();
        }

        return $this->twig->render('Contact/showAll.html.twig', ['contacts' => $contacts]);
    }

    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        $contactManager = new ContactManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contact = [
                'lastName' => $_POST['lastname'],
                'firstName' => $_POST['firstName'],
                'mail' => $_POST['mail'],
                'phone' => $_POST['phone'],
                'subject' => $_POST['subject'],
                'message' => $_POST['message'],
            ];
            $contactManager->insert($contact);
            header('Location:/Home/index/');
        }

        $pageURL = strtolower(strtok($_SERVER['REQUEST_URI'], '?'));
        return $this->twig->render('Contact/add.html.twig', ['pageURL' => $pageURL]);
    }
}
