<?php

namespace App\Controllers;

use App\Core\View;

class FormInstaller
{
    public function index(): void
    {
        // Créer une nouvelle vue pour le formulaire
        $view = new View("Installer/form");

        // Assigner les variables nécessaires
        $view->assign("title", "Mon Formulaire");

        // etc...
    }


    public function validate()
    {

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $name = $data['name'];
        $email = $data['email'];

        header('Content-Type: application/json');

        if ($name !== 'Bilel' && $email !== '') {
            echo json_encode(['status' => 'success']);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Please fill in the form']);
        }

        exit();
    }
}



