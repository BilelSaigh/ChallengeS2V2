<?php

namespace App\Controllers;

use App\Core\Sql;
use App\Core\Verificator;
use App\Core\View;
use App\Forms\AddUser;
use App\Forms\EditUser;
use App\Forms\EditProfile;
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
                (new Security)->sendMail();
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
    
    public function deleteAccount(): void
    {
        $userToDelete = new  ModelUser();
        $userToDelete->setId($_POST["id"]);
        $userToDelete->deleteProfile();
    }

    public function editUser(): void
    {
       $users = new ModelUser();
        $user = $users->search(["id" => $_POST["id"]]);

        if (isset($_POST['submit']) && $_POST['submit'] == "Save changes"){
            //optimiser si temps avec boucle sur l'obj
            // echo $user->getLastname() != $_POST["Lastname"];
            $users->setId($_POST["id"]);
            ($user->getPassword() != $_POST["Password"])? $users->setPassword($_POST["Password"]):$user->setPassword($user->getPassword());
            ($user->getLastname() != $_POST["Lastname"])? $users->setLastname($_POST["Lastname"]):$user->setLastname($user->getLastname());
            ($user->getEmail() != $_POST["Email"])? $users->setEmail($_POST["Email"]):$user->setEmail($user->getEmail());
            ($user->getRole() != $_POST["Role"])? $users->setRole($_POST["Role"]):$user->setRole($user->getRole());
            $users->save();
        }
        else if (isset($_POST['submit']) && $_POST['submit'] == "Save Profile") {
            // Mettez à jour les champs si une nouvelle valeur est fournie dans $_POST
            $user->setFirstname($_POST["Firstname"] ?? $user->getFirstname());
            $user->setLastname($_POST["Lastname"] ?? $user->getLastname());
            $user->setEmail($_POST["Email"] ?? $user->getEmail());
            $user->setPassword($_POST["Password"] ?? $user->getPassword());
        
            // Sauvegardez uniquement l'utilisateur mis à jour
            $user->save();
        }else {
            if ($user) {
                $userInfo = [
                    "id" => $user->getId(),
                    "firstname" => $user->getFirstname(),
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
    public function profil(): void
{
    $view = new View("Dash/editProfile");
    $users = new ModelUser();
    $addUser = new AddUser();
    $editUser = new EditProfile();
    // Récupérer les informations de l'utilisateur connecté depuis la session
    $connectedUser = $_SESSION["user"]; // Assurez-vous d'avoir un tel tableau dans votre session

    // Utilisez les informations de l'utilisateur connecté pour récupérer l'utilisateur complet
    $connectedUser = $users->search(["id" => $connectedUser["id"]]);

    // Vérifiez si l'utilisateur connecté existe
    if ($connectedUser) {
        // Passez l'utilisateur connecté à la vue
        $view->assign("connectedUser", $connectedUser);
    }

    $view->assign("title", "Users");
    // Ne passez pas la liste complète des utilisateurs à la vue, mais seulement l'utilisateur connecté
    // $view->assign("users", $users);
    $view->assign("addUser", $addUser->getConfig());
    $view->assign("editUser", $editUser->getConfig());

    if ($addUser->isSubmit() && $_POST["submit"] == "Add") {
        $verifUser = $this->addUser($addUser);
        if (!empty($verifUser)) {
            $view->assign("errors", $this->addUser($addUser));
        };
    }
    if ($editUser->isSubmit()  && $_POST["submit"] == "Save Profile" ) {
         $this->editUser();
    }
}






}