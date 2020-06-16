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
    /**
     * Display contact listing
     *
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
                'lastname' => $_POST['lastname'],
                'firstName' => $_POST['firstName'],
                'mail' => $_POST['mail'],
                'phone' => $_POST['phone'],
                'subject' => $_POST['subject'],
                'message' => $_POST['message'],
            ];
            $id = $contactManager->insert($contact);
            header('Location:/Contact/add/');
        }

        return $this->twig->render('Contact/add.html.twig');
    }
}
