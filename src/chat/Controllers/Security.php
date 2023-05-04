<?php

class Security{
    public static function secureHTML($chaine): string{
        return htmlentities($chaine);
    }

    public static function estConnecte() : bool{
        return !empty($_SESSION['chatUser']);
    }

    public static function estAdministrateur():bool{
        return ($_SESSION['chatUser']['role'] === 'admin');
    }
}