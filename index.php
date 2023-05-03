<?php

use App\Controller\AdminController;
use App\Controller\MainController;

session_start();


define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://" . $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"]));
require_once 'src/chat/Controllers/AdminController.php';
require_once 'src/chat/Controllers/MainController.php';

$adminController = new AdminController();
$mainController = new MainController();


try {
    if (empty($_GET['page'])) {
        $page = "site";
    } else {
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        $page = $url[0];
    }
    switch ($page) {
        case "site":
            $mainController->site();
            break;
        case "chatbot" :
            switch ($url[1]){
                case 'admin':
                    if (!Security::estConnecte()) {
                        Toolbox::ajouterMessageAlerte("Veuillez vous connecter !", Toolbox::COULEUR_ROUGE);
                        header("Location:" . URL . "chatbot/login");
                    }else{
                            $adminController->admin();
                        }
                    break;
                case 'login':
                    if (isset($_SESSION["chatUser"]) && $_SESSION['chatUser']['role'] === 'admin'){
                        header("Location:".URL."chatbot/admin");
                    } else {
                        $adminController->login();
                    }

                case 'validationLogin':
                    if (!empty($_POST['login']) && !empty($_POST['password'])) {
                        $login = Security::secureHTML($_POST['login']);
                        $password = Security::secureHTML($_POST['password']);
                        $adminController->validation_login($login, $password);
                    } else {
                        Toolbox::ajouterMessageAlerte(
                            "Login ou mot de passe non reseigné",
                            Toolbox::COULEUR_ROUGE
                        );
                        header('Location:' . URL . "chatbot/login");
                    }
            }

    }
} catch (Exception $e) {
    $mainController->pageErreur($e->getMessage());
}