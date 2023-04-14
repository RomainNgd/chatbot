<?php
namespace App\database;
use Exception;
use PDO;

class dbConnection{

    private string $host = 'localhost';

    private string $dataBase = 'chatbot';

    private string $user = 'root2';

    private string $password = 'secret';

    public function __construct(){

    }

    public function getDataBase(){
        try{
            $db = new PDO('mysql:host='.$this->host.';dbname='.$this->dataBase.';charset=utf8', $this->user, $this->password);
        }
        catch(Exception $exception){
            die('Erreur : ' . $exception->getMessage());
        }

        return $db;
    }

}
