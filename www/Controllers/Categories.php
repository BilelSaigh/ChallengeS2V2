<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Category as ModelCategory;

class Categories extends \App\Core\Sql
{
    public function listCategorie():void
    {
        $categories = new ModelCategory();
        $view = new View("Dash/categoryList");
        $categories = $categories->getAll();
        $view->assign("title", "Category");
        $view->assign("categories", $categories);
        if (isset($_POST["add"])){
            $category = new ModelCategory();
            $category->setTitle($_POST['title']);
            $category->setSlug();
            $category->save();
            header("refresh: 1");
        }if (isset($_POST["edit"])){
            $this->editCategory();
            header("refresh: 1");
    }if (isset($_POST["delete"])){
            $this->deleteCategory();
        }
    }

    public function deleteCategory(): void
    {
        $categoryToDelete = new  ModelCategory();
        $categoryToDelete->setId($_POST["id"]);
        $categoryToDelete->delete();
    }

    public function editCategory(): void
    {
        $category = new ModelCategory();
        $category = $category->search(["id" => $_POST["id"]]);
        if (isset($_POST['edit'])){
            $category->setId($_POST["id"]);
            ($category->getTitle() != $_POST["title"])? $category->setTitle($_POST["title"]):$category->setTitle($category->getTitle());
            $category->save();
        }else {
            if ($category) {
                $category = [
                    "id" => $category->getId(),
                    "title" => $category->getTitle()
                ];
                echo json_encode(["success" => true, "content" => $category]);
            }else{
                echo json_encode(["success" => false, "message" => "Invalid request"]);
            }
        }
    }
}