<?php

namespace App\Controllers;

use App\Core\Sql;
use App\Forms\AddComment;
use App\Models\Comment as ModelComment;
use App\Core\View;


// use ChallengeS2\Models\Comment;

class Comment extends Sql
{

    private array $errors = [];

    public function listComment():void
    {
        $view = new View("Dash/commentList");
        $comments = new ModelComment();
        $comments = $comments->getAll();
        $view->assign("title", "Comments");
        $view->assign("comments", $comments);
    }

    public function reportComment($requestData): string|bool
    {
        $comment = new ModelComment();
        $comment = $comment->search(["id"=>$requestData['id']]);
        if ($comment->getReport() < 5){
            $comment->setReport($comment->getReport());
            $comment->save();
            $response = array("success" => true, "message" => "Report saved");
        }else{
            $comment->delete();
            $response = array("success" => false, "message" => "Comment delete");
        }
        header('Content-Type: application/json');
        return json_encode($response);
    }
    public function addComment($requestData): string|bool
    {
        $comment= new ModelComment();
        $comment->setComment($requestData["comment"]);
        $comment->setCreatedAt();
        $comment->setAuthor($_SESSION["user"]["id"]);
        $comment->setArticleId($requestData["article_id"]);
        $comment->save();
        $response = array("success" => true, "message" => "Comment add");

        header('Content-Type: application/json');
        return json_encode($response);
    }


    public function deleteComment(): void
    {
        $commentToDelete = new ModelComment();
        $commentToDelete->setId($_POST["id"]);
        $commentToDelete->delete();
    }

}

