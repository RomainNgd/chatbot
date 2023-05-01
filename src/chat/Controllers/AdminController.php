<?php
namespace App\Controller;

require_once("MainController.php");


class AdminController extends MainController
{
    public function login(){

        $data_page = [
            'page_description' => 'page d\'accueil des visiteur',
            'page_title' => 'page de login',
            'view' => 'views/connexion.view.php',
            'template' => 'Views/partials/template.php'
        ];
        $this->genererPage($data_page);
    }

    public function admin()
    {
        $data_page = [
            'page_description' => 'page d\'administration du bot',
            'page_title' => 'page admin',
            'view' => 'views/adminInterface.view.php',
            'template' => 'Views/partials/template.php'
        ];
        $this->genererPage($data_page);
    }
}