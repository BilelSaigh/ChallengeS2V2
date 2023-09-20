<?php

namespace App\Core;

use App\Models\Article;
use App\Models\Category;
use App\Models\Page;

class RouteVerificator extends Sql
{
    public static function checkConnexion():bool
    {
        return isset($_SESSION['user']['token']);
    }

    public static function checkSlugExists(): bool
    {
        $uriExploded = explode("/", $_SERVER["REQUEST_URI"]);
        $uri = trim($uriExploded[1], "/");
        $article = new Article();
        $page = new Page();
        $category = new Category();
        $articleResults = $article->search(['slug' => $uri]);
        $pageResults = $page->search(['slug' => $uri]);
        $categoryResults = $category->search(['slug' => $uri]);
        return !empty($articleResults) || !empty($pageResults) || !empty($categoryResults) ;
    }

    public static function checkWhoIAm($roleNeeded):bool
    {
        if (self::checkConnexion()){
            return in_array($_SESSION['user']['role'], $roleNeeded) || empty($roleNeeded);
        }
         return empty($roleNeeded);
    }

    public function isInstallationComplete(): bool
    {
        // Vérifier l'en-tête Origin de la requête
        $allowedOrigins = ["http://localhost:81/installer"]; // Liste des origines approuvées
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
        var_dump($origin);
        if (in_array($origin, $allowedOrigins)) {
            // L'origine est approuvée, autorisez l'accès
            header('Access-Control-Allow-Origin: ' . $origin);
            echo "ok";
        } else {
            // L'origine n'est pas autorisée, renvoyez une réponse CORS invalide
            $this->sendCorsError();
            return false;
        }

        // Vérifier si la requête est une requête de pré-vérification CORS (preflight)
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            // Requête de pré-vérification CORS (preflight)
            header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
            header('Access-Control-Allow-Headers: X-Custom-Header, Authorization');
            header('Access-Control-Allow-Credentials: true');
            exit();
        }
        // Le reste de votre code pour vérifier si l'installation est complète
        // ...

        return true; // Retourne true si tout est OK
    }

    private function sendCorsError(): void
    {
        header('Access-Control-Allow-Origin: *'); // Vous pouvez personnaliser cette réponse selon vos besoins
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: X-Custom-Header, Authorization');
        header('Access-Control-Allow-Credentials: true');
        $error = new Error();
        $error->errorRedirection(404);
    }

}

