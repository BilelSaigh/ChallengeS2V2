<?php
namespace App\Controllers;
use App\Core\View;
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Models\PageViews;
use App\Models\Setting;
use App\Models\User;

class Main{
    public function index(): void
    {
        $view = new View("Page/home","cleanPage");
        $articles = new Article();
        $articles = $articles->getAll();
        $categories = new Category();
        $categories = $categories->multipleSearch(["menu"=>1]);
        $setting = new Setting();
        $setting = $setting->search(["id"=>1]);
        $pages = new Page();
        $pages = $pages->multipleSearch(["menu"=>1]);
        $users = new User();
        $view->assign("articles",$articles);
        $view->assign("users",$users);
        $view->assign("categories",$categories);
        $view->assign("front",$setting);
        $view->assign("pages",$pages);
        $view->assign("title","Home");
    }

    public function dashboard(): void
    {
        $view = new View("Dash/index");
        $usersModel = new User();
        $users = $usersModel->getStats();
        $pageViews = PageViews::getInstance();
        $views = $pageViews->getStats();
        $front = new Setting();
        $front = $front->search(["id"=>1]);

        $view->assign("title", 'Home');
        $view->assign("users",$users);
        $view->assign("views",$views);
        $view->assign("front",$front);
    }
}