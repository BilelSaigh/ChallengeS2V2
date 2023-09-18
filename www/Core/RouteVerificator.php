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

}

