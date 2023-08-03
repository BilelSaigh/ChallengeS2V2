<?php

namespace App\Controllers;

use App\Core\Sql;
use App\Core\Verificator;
use App\Core\View;
use App\Forms\AddUser;
use App\Forms\EditUser;
use App\Models\User as ModelUser;

class User extends Sql
{
    private array $errors = [];

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
        if ($addUser->isSubmit()) {
//            $verifUser = $this->addUser($addUser);
//            if (!empty($verifUser)) {
//                $view->assign("errors", $this->addUser($addUser));
//            };
        }
        if ($editUser->isSubmit()) {
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
                $user->setDateInserted();
                $user->save();
                //send mail
                //(new Security)->sendMail();
                var_dump($user);
                return true;
            };
        };
        return $this->errors;
    }

    public function deleteUser()
    {

    }
    public function editUser(): void
    {
       $users = new ModelUser();
        $user = $users->search(["id" => $_POST["id"]]);

        if (isset($_POST['submit']) == "Save changes"){
            //optimiser si temps avec boucle sur l'obj
                $users->setId($_POST["id"]);
            ($user->getPassword() != $_POST["Password"])?? $users->setPassword($_POST["Password"]);
            ($user->getLastname() != $_POST["Password"])?? $users->setLastname($_POST["Lastname"]);
            ($user->getEmail() != $_POST["Password"])?? $users->setEmail($_POST["Email"]);
            ($user->getRole() != $_POST["Password"])?? $users->setRole($_POST["Role"]);
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
//        }
    }
    }
}