<?php

namespace App\Forms;

class EditProfile extends Abstract\AForm
{
    protected $method = "POST";
    public function getConfig(): array
    {
        return [
            "config"=>[
                "method"=>$this->getMethod(),
                "action"=>"",
                "enctype"=>"",
                "class"=>"",
                "submit"=>"Save Profile",
                "cancel"=>"Annuler",
                "id"=>"editForm",
            ],
            "inputs"=>[
                "Firstname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre prénom",
                    "min"=>2,
                    "max"=>120,
                    "class"=>"form-control",
                    "error"=>"Votre prénom doit faire entre 2 et 120 caractères",
                    "disabled" => false
                ],
                "Lastname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre nom",
                    "min"=>2,
                    "max"=>120,
                    "class"=>"form-control",
                    "error"=>"Votre nom doit faire entre 2 et 120 caractères",
                    "disabled" => false
                ],
                "Email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email",
                    "class"=>"form-control",
                    "error"=>"Le format de votre email est incorrect",
                    "disabled" => false
                ],
                "Password"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe",
                    "class"=>"form-control",
                    "error"=>"Votre mot de passe est incorrect",
                    "disabled" => false
                ]
            ]
        ];
    }
}