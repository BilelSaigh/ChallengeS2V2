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

        if (isset($data['db_name'])) {
            // Validation pour la page 1
            $errors = [];

            // Validation du nom de la base de données
            if (empty($data['db_name'])) {
                $errors['db_name'] = 'Le nom de la base de données est requis.';
            } elseif (strlen($data['db_name']) < 3) {
                $errors['db_name'] = 'Le nom de la base de données doit comporter au moins 3 caractères.';
            }

            // Validation du nom d'utilisateur
            if (empty($data['db_username'])) {
                $errors['db_username'] = 'L\'identifiant est requis.';
            }

            // Autres validations pour db_password, db_host, table_prefix, etc.

            if (!empty($errors)) {
                header('Content-Type: application/json');
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Validation failed.', 'errors' => $errors]);
                exit();
            }
        } elseif (isset($data['user_name'])) {
            // Validation pour la page 2
            $errors = [];

            // Validation du nom d'utilisateur
            if (empty($data['user_name'])) {
                $errors['user_name'] = 'Le nom d\'utilisateur est requis.';
            } elseif (strlen($data['user_name']) < 3) {
                $errors['user_name'] = 'Le nom d\'utilisateur doit comporter au moins 3 caractères.';
            }

            // Validation de l'adresse email
            if (empty($data['user_email'])) {
                $errors['user_email'] = 'L\'adresse email est requise.';
            } elseif (!filter_var($data['user_email'], FILTER_VALIDATE_EMAIL)) {
                $errors['user_email'] = 'L\'adresse email n\'est pas valide.';
            }

            // Autres validations pour user_password, confirm_password, etc.

            if (!empty($errors)) {
                header('Content-Type: application/json');
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Validation failed.', 'errors' => $errors]);
                exit();
            }
        }

        // Si tout est valide, vous pouvez poursuivre le traitement
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success']);
        exit();
    }






}



