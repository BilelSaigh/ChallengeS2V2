<?php
namespace App\Controllers;
use App\Core\View;
use App\Forms\AddUser;
use App\Forms\LoginUser;
use App\Models\Mail;
use App\Models\Setting;
use App\Models\User as ModelUser;
use App\Core\Verificator;

class Security{
    protected array $errors = [];

    public function login(): void
    {
        $form = new LoginUser();
        $view = new View("Auth/login","front");
        $view->assign('form',$form->getConfig());
        if ($form->isSubmit()){
            $this->errors = Verificator::form($form->getConfig(),$_POST);
            $email = $_POST["Email"];
            $pwd = $_POST["Password"];
            if (empty($this->errors)){
                $user = new ModelUser();
                $user = $user->search(['email'=>$email]);
                $front = new Setting();
                $front = $front->search(['id'=>1]);
                if (!empty($user) && $user->verifPwd($pwd)){
                    $user->generateToken();
                    $user->save();
                    $_SESSION["user"] = [
                        'id'        => $user->getId(),
                        'firstname' => $user->getFirstname(),
                        'lastname'  => $user->getLastname(),
                        'pwd'       => $user->getPassword(),
                        'email'     => $user->getEmail(),
                        'token'     => $user->getToken(),
                        'status'    => $user->getStatus(),
                        'role'      => $user->getRole(),
                        'websiteName' => $front->getWebsiteName()
                    ];

                    //REDIRECTION DASHBOARD
                    $redirectURL = "dash/home";
                    echo '<script>window.location.replace("/dash/home");</script>';
                    exit;
                }else{
                    $this->errors[] = "Identifiants incorrects";
                }
            }else{
                $this->errors[] = "Identifiants incorrect";
            }
        }
        $view->assign('title',"Login");
        $view->assign('errors',$this->errors);
    }

    public function register(): void
    {
        $form = new AddUser();
        $view = new View("Auth/register", "front");
        $view->assign('form', $form->getConfig());
        $view->assign('title', "Subscription");
        if($form->isSubmit()){
            $this->errors = Verificator::form($form->getConfig(), $_POST);
            if (empty($this->errors)) {
                $user = new ModelUser();
                $verifyExistenceUser = $user->search(['email' => $_POST["Email"]]);
                if (!empty($verifyExistenceUser)) {
                    $this->errors[] = "L'utilisateur que vous essayez de créer existe déjà !";
                } else {
                    $user->setEmail($_POST["Email"]);
                    $user->setLastname($_POST["Lastname"]);
                    $user->setFirstname($_POST["Firstname"]);
                    $user->setRole(3);
                    $user->setPassword($_POST["Password"]);
                    $user->setToken($user->generateCode());
                    $user->setDateInserted();
                    $user->save();
                    //send mail
                    (new Security)->sendMail($user);
                    echo '<script>window.location.replace("/login");</script>';
                    exit;
                };
            };
            $view->assign("errors",$this->errors);
        }
    }

    public function logout(): void
    {
        session_destroy();
        echo '<script>window.location.replace("/login");</script>';
        exit;
    }

    public function sendMail($user): void
    {
        //ADRESSE IP MAIL ATTENTION A FAIRE
        $mail = new Mail();
        $code = new ModelUser();
        $confMail = new Mail();
        $confMail->setName($user->getFirstname());
        $confMail->setSubject("Mail de confirmation");
        $confMail->setAddress($user->getEmail());
        $confMail->setMessage('
                                            <div class="card-body">
                                            <h5 class="card-title"> Adebc vous souhaite la bienvenue ! </h5>
                                            <p class="card-text">Une fois votre compte validé vous pourrez commenter autant que vous le souhaitez !.</p>
                                            <p class="card-text">Oublie pas le respect est OBLIGATOIRE chez nous ;)  .</p>
                                                <button><a class="btn btn-primary" href="http://127.0.0.1:81/confirmation?key='.$user->getToken().'"> Confirmer votre mail. </a></button>
                                           </div>');
        $confMail->mail($confMail->initMail());
    }

    public function confirmation():void
    {
        if (isset($_GET['key']) && !empty(($_GET['key']))){
            $user = new User;
            $newUser = $user->search(["token" =>$_GET['key']]);
            if (!empty($newUser)){
                $newUser->setStatus(true);
                $newUser->setToken(null);
                $newUser->save();
                $this->login();
            }else{
                echo '<div class="alert-error" style="text-align: center; padding: 1em ;">
                        <span> Compte inexistant, veuillez verifier que la durée du mail n est pas expirée </span>
                    </div>';
            }
        }
    }

}