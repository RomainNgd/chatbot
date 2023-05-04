<?php
namespace App\Controller;

require_once("MainController.php");


class AdminController extends MainController
{
    public function login(){

        $data_page = [
            'page_description' => 'page d\'accueil des visiteur',
            'page_title' => 'page de login',
            'views' => 'views/connexion.view.php',
            'template' => 'views/partials/template.php',
            'page_css' => ['style.css'],

        ];
        $this->genererPage($data_page);
    }

    public function validationLogin($login, $password){
        if ($login === 'root' && $password === 'root') {
            $_SESSION['chatUser'] = [
                'login' => 'root',
                'password' => 'root',
                'role' => 'admin'
            ];
            header('Location:' . URL . '/chatbot/admin');
        } else{
            header('Location:' . URL . '/site');
        }
    }

    public function admin()
    {
        $data_page = [
            'page_description' => 'page d\'administration du bot',
            'page_title' => 'page admin',
            'views' => 'views/adminInterface.view.php',
            'template' => 'views/partials/template.php',
            'page_css' => ['style.css'],
        ];
        $this->genererPage($data_page);
    }
}