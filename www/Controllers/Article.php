<?php

namespace App\Controllers;

use App\Core\Verificator;
use App\Core\View;
use App\Forms\AddArticle;
use App\Models\Article as ModelArticle;
use App\Models\Category;
use App\Models\User as ModelUser;
use App\Models\Version;
use App\Models\VersionMemento;

class Article extends \App\Core\Sql
{
    private array $errors = [];

    public function listArticle():void
    {
        $view = new View("Dash/articlesList");
        $articles = new ModelArticle();
        $addArticle = new AddArticle();
        $articles = $articles->getAll();
        $view->assign("title", "Articles");
        $view->assign("articles", $articles);
        $view->assign("addArticle", $addArticle->getConfig());

    }
    public function deleteArticle(): void
    {
        $articleToDelete = new  ModelArticle();
        $articleToDelete->setId($_POST["id"]);
        $articleToDelete->delete();
    }

    public function newArticle():void
    {
        //AFFICHAQUE DE LA CREATION D'ARTICLE
            $options = [];
            $view = new View("Dash/article");
            $articles = new ModelArticle();
            $addArticle = new AddArticle();
            $categories = new Category();
            $categories = $categories->getAll();
             $view->assign("category",$categories);
            $view->assign("title", "New Article");
            $view->assign("articles", $articles);
            $view->assign("addArticle", $addArticle->getConfig());

    }
    public function newArticles($requestData): string|bool
    {
        // AJOUT DES ARTICLES
        $article = new ModelArticle();
        $firstVersion = new Version();
        $articleAlreadyExist =$article->search(["title"=> trim($requestData["title"])]);
        if (!empty($requestData["id"])){
            $article->setId($requestData["id"]);
        }
        //SI NON EXISTANT  ALORS ON AJOUT SINON ERREUR
        if (empty($articleAlreadyExist) || $article->getId()){
            $article->setTitle($requestData["title"]);
            $article->setAuthor($_SESSION["user"]["id"]);
            $article->setCategory($requestData["category"]);
            $article->setCreatedAt();
            $article->setComment($requestData["comment"]);
            $article->setSlug();
            $article->setImgUrl($requestData["img"]);
            $article->save();
            $article = $article->search(["title"=> $article->getTitle()]);
            $firstVersion->setArticleId($article->getId());
            $firstVersion->setUserId($_SESSION["user"]["id"]);
            $firstVersion->setContent(json_encode($requestData["article"]));
            $firstVersion->setCreatedAt();
            $firstVersion->save();
            $response = array("success" => true, "message" => "Article saved");
        }else{
            $response = array("success" => false, "message" => "Article exist");
        }
        header('Content-Type: application/json');
        return json_encode($response);
    }

    public function editArticle():void
    {
        $view = new View("Dash/editArticle");
        $article = new ModelArticle();
        $addArticle = new AddArticle();
        $version = new Version();
        $articleId = $_GET["id"];
        $latestVersion = $version->selectOrder(["article_id"=>$articleId],"created_at","DESC");
        if ($latestVersion) {
            $memento = new VersionMemento($latestVersion->getContent());
            $version->setContent($memento->getContent());
        }else{
            $version->setContent("{}");
        }
        $article = $article->search(["id" => $articleId]);
        if (!empty($article)){
            $view->assign("article", $article);
            $categories = new Category();
            $categories = $categories->getAll();
            $view->assign("category", $categories);
            $view->assign("version", $version);
            $view->assign("addArticle", $addArticle->getConfig());
        }else{
            $error[]= "L'article n'existe pas";
            $view->assign("errors", $error );
        }
        $view->assign("title", "Edit Article");

    }
    public function statusArticle($requestData): string|bool
    {
        if (!empty($requestData)) {
            $articleId = $requestData["id"];
            $article = new ModelArticle();
            $article = $article->search(["id" => $articleId]);
            if ($article) {
                $currentStatus = $article->isStatus();
                $newStatus = !$currentStatus;
                $article->setStatus($newStatus);
                $article->save();

                $response = ["success" => true, "message" => $newStatus ? "Article published" : "Article unpublished"];
            } else {
                $response = ["success" => false, "message" => "Article not found"];
            }
        } else {
            $response = ["success" => false, "message" => "Invalid request"];
        }
        header("Content-Type: application/json");
        return json_encode($response);
    }

    public function filterArticles($requestData): string|bool
    {
        $categoryId = $requestData['id'];
        $articles = new ModelArticle();
        $articles = ($categoryId === 'all') ? $articles->getAll() : $articles->multipleSearch(["category"=>$categoryId]);
        $filteredHTML = [];
        if (!empty($articles)){
            foreach ($articles as $article) {
                $filteredHTML[] = [
                    'id' => $article->getId(),
                    'title' =>$article->getTitle(),
                    'created_at' => date('d / m', strtotime($article->getCreatedAt())),
                    'slug' => $article->getSlug(),
                    'img' => $article->getImgUrl()
                ];
            }
            $response = ['success' => true, 'content' => $filteredHTML];
        }else{
            $response = ['success' => false];
        }
        header('Content-Type: application/json');
        return json_encode($response);
    }

}