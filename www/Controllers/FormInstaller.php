<?php

namespace App\Controllers;

use App\Core\View;

class FormInstaller
{
    public function index(): void
    {
        // Créer une nouvelle vue pour le formulaire
        $view = new View("Installer/form", "front");

        // Assigner les variables nécessaires
        $view->assign("title", "Mon Formulaire");

        // etc...
    }


    public function validate()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        // Vous pouvez utiliser l'opérateur de coalescence null
        // Pour éviter des notices en cas de clés 'name' ou 'email' absentes
        $name = $data['name'] ?? null;
        $email = $data['email'] ?? null;

        if (!is_null($name) && $name !== '') {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success']);
            exit();
        }
        if (!is_null($email) && $email !== '') {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success']);
            exit();
        }
        // Là, si nous n'avions ni name correct, ni email correct, nous répondons une erreur.
        header('Content-Type: application/json');
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Please fill in the form']);
        exit();
    }
}



