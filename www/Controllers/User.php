<?php

namespace App\Controllers;

use App\Core\Sql;
use App\Core\Verificator;
use App\Core\View;
use App\Forms\AddUser;
use App\Forms\EditUser;
use App\Models\Article as ModelArticle;
use App\Models\Setting;
use App\Models\User as ModelUser;

class User extends Sql
{
    private array $errors = [];

    public function profil():void
    {
        $view = new View("Dash/profil");
        $user = new ModelUser();
        $front = new Setting();
        $user = $user->search(["id"=>$_SESSION["user"]["id"]]);
        $front = $front->search(["id"=>1]);
        $view->assign("user",$user);
        $view->assign("title","Profil");
        $view->assign("front",$front);

    }
    public function editProfil($requestData): false|string
    {
        if (!empty($requestData)) {
            $user = new ModelUser();
            $editUser = new ModelUser();
            $front = new Setting();
            $front = $front->search(["id"=>1]);
            $user = $user->search(["id"=>$_SESSION["user"]["id"]]);
            $editUser->setId($_SESSION["user"]["id"]);
            ($_SESSION["user"]["firstname"]  != $requestData["firstname"])? $editUser->setFirstname($requestData["firstname"]):$editUser->setFirstname($_SESSION["user"]["firstname"]);
            ($_SESSION["user"]["lastname"] != $requestData["lastname"])? $editUser->setLastname($requestData["lastname"]):$editUser->setLastname($_SESSION["user"]["lastname"]);
            ($_SESSION["user"]["email"] !=  $requestData["email"])? $editUser->setEmail($requestData["email"]):$editUser->setEmail($_SESSION["user"]["email"]);
            if($_SESSION["user"]["pwd"] != $user->verifPwd($requestData["password"]) ) { $editUser->setPassword($requestData["password"]);};
            ($front->getWebsiteName() !=  $requestData["websiteName"] && $requestData["websiteName"]!= "")? $front->setWebsiteName($requestData["websiteName"]):$front->setWebsiteName($front->getWebsiteName());
            $editUser->save();
            $front->save();
            $response = ["success" => true, "message" => "Modification done"];
        } else {
            $response = ["success" => false, "message" => "Error in profil edit"];
        }
        header("Content-Type: application/json");
        return json_encode($response);

    }

    public function listUser(): void
    {
        $view = new View("Dash/usersList");
        $users = new ModelUser();
        $addUser = new AddUser();
        $editUser = new EditUser();
        $users = $users->getAll();
        $view->assign("title", "Users");
        $view->assign("users", $users);
        $view->assign("addUser", $addUser->getConfig());
        $view->assign("editUser", $editUser->getConfig());
        if ($addUser->isSubmit() && $_POST["submit"] == "Add") {
            $verifUser = $this->addUser($addUser);
            if (!empty($verifUser)) {
                $view->assign("errors", $this->addUser($addUser));
            };
        }
        if ($editUser->isSubmit()  && $_POST["submit"] == "Save changes" ) {
             $this->editUser();
        }
    }

    public function addUser($addUser): bool|array
    {
        $this->errors = Verificator::form($addUser->getConfig(), $_POST);
        $email = $_POST["Email"];
        if (empty($this->errors)) {
            $user = new ModelUser();
            $verifyExistenceUser = $user->search(['email' => $email]);
            if (!empty($verifyExistenceUser)) {
                $this->errors[] = "L'utilisateur que vous essayez de créer existe déjà !";
            } else {
                $user->setEmail($email);
                $user->setFirstname($_POST["Firstname"]);
                $user->setLastname($_POST["Lastname"]);
                $user->setRole($_POST["Role"]);
                $user->setPassword($_POST["Password"]);
                $user->setToken($user->generateCode());
                $user->setDateInserted();
                $user->save();
                //send mail
                (new Security)->sendMail($user);
                return true;
            };
        };
        return $this->errors;
    }

    public function deleteUser(): void
    {
        $userToDelete = new  ModelUser();
        $userToDelete->setId($_POST["id"]);
        $userToDelete->delete();
    }

    public function editUser(): void
    {
       $users = new ModelUser();
        $user = $users->search(["id" => $_POST["id"]]);

        if (isset($_POST['submit']) == "Save changes"){
            //optimiser si temps avec boucle sur l'obj
            $users->setId($_POST["id"]);
            ($user->getPassword() != $_POST["Password"])? $users->setPassword($_POST["Password"]):$users->setPassword($user->getPassword());
            ($user->getLastname() != $_POST["Lastname"])? $users->setLastname($_POST["Lastname"]):$users->setLastname($user->getLastname());
            ($user->getEmail() != $_POST["Email"])? $users->setEmail($_POST["Email"]):$users->setEmail($user->getEmail());
            ($user->getRole() != $_POST["Role"])? $users->setRole($_POST["Role"]):$users->setRole($user->getRole());
            $users->save();
        }else {
            if ($user) {
                $userInfo = [
                    "id" => $user->getId(),
                    "lastname" => $user->getLastname(),
                    "email" => $user->getEmail(),
                    "role" => $user->getRole(),
                    "password" => $user->getPassword(),
                ];
                echo json_encode($userInfo);
            } else {
                echo json_encode(null);
            }
        }
    }

}