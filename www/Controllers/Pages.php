<?php

namespace App\Controllers;

use App\Core\Sql;
use App\Core\View;
use App\Models\Category;
use App\Models\Page as Build;
class Pages extends Sql
{
    public function index():void
    {
        $view = new View("Dash/pageBuilder","builder");
        $categories = new Category();
        $categories = $categories->getAll();
        $view->assign("title","Pages");
        $view->assign("categories",$categories);
    }
    public function pages($requestData): string|bool
    {
        $pageBuild = new Build();
        if (empty($requestData["pageId"])){
            if (!($pageBuild->search(["title"=> trim(ucfirst(strtolower($requestData["title"])))]))){
                $pageBuild->setContent($requestData["content"][0]);
                $pageBuild->setTitle($requestData["title"]);
                $pageBuild->setUpdatedAt();
                $pageBuild->setSlug();
                $pageBuild->setCategory((!empty($requestData["id"]))?$requestData["id"]:null);
                $pageBuild->setDescription($requestData["description"]);
                $pageBuild->save();
                $response = array("success" => true, "message" => "Page saved");
            }else {
                $response = array("success" => false, "message" => "Pages Already exist !");
            }
        }else{
            $pageAlreadyExist = $pageBuild->search(["id"=> $requestData["pageId"]]);
            $pageBuild->setId($requestData["pageId"]);
            $pageBuild->setUpdatedAt();
            ($pageAlreadyExist->getContent() != $requestData["content"][0])? $pageBuild->setContent($requestData["content"][0]):$pageBuild->setContent($pageAlreadyExist->getContent());
            if ($pageAlreadyExist->getTitle() != $requestData["title"]) {
                $pageBuild->setTitle($requestData["title"]);
                $pageBuild->setSlug();
            } else {
                $pageBuild->setTitle($pageAlreadyExist->getTitle());
            }
            ($pageAlreadyExist->getCategory() != $requestData["id"])? $pageBuild->setCategory((!empty($requestData["id"]))?$requestData["id"]:null):$pageBuild->setCategory($pageAlreadyExist->getCategory());
            ($pageAlreadyExist->getDescription() != $requestData["description"])? $pageBuild->setDescription($requestData["description"]):$pageBuild->setDescription($pageAlreadyExist->getDescription());
            $pageBuild->save();
            $response = array("success" => true, "message" => "Modifications saved");
        }
            return json_encode($response);
    }

    public function listPage():void
    {
        $view = new View("Dash/pagesList");
        $pages = new Build();
        $pages = $pages->getAll();
        $view->assign("title", "Pages");
        $view->assign("pages", $pages);

    }
    public function deletePage(): void
    {
        $pageToDelete = new Build();
        $pageToDelete->setId($_POST["id"]);
        $pageToDelete->delete();
    }

    public function statusPage($requestData): string|bool
    {
        if (!empty($requestData)) {
            $pageId = $requestData["id"];
            $page = new Build();
            $page = $page->search(["id" => $pageId]);
            if ($page) {
                $currentStatus = $page->getStatus();
                $newStatus = !$currentStatus;
                $page->setStatus($newStatus);
                $page->save();
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


    public function editPage():void
    {
        $view = new View("Dash/editPage","builder");
        $page = new Build();
        $page = $page->search(["id" =>  $_GET["id"]]);
        if (!empty($page)){
            $view->assign("page", $page);
            $categories = new Category();
            $categories = $categories->getAll();
            $view->assign("categories", $categories);
        }else{
            $error[]= "La page n'existe pas";
            $view->assign("errors", $error );
        }
        $view->assign("title", "Edit Page");
    }
}