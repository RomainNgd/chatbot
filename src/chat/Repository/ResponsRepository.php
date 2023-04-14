<?php

namespace App\chat\Repository;

use App\chat\Entity\Response;
use App\database\dbConnection;

class ResponsRepository{

    private \PDO $db;

    public function __construct(dbConnection $dbConnection){
        $this->db = $dbConnection->getDataBase();
    }

    public function addResponse(Response $response): void{

        foreach ($response->keyWord as $keyword){
            $query = 'INSERT INTO reponse(word, respons) VALUES (:word, :respons, :priority)';
            $insert = $this->db->prepare($query);
            $insert->execute([
                'word' => $keyword,
                'respons' => $response->respons,
                'priority' =>$response->priority,
            ]) or die(print_r($this->db->errorInfo()));
        }
    }

    public function getResponse(string $keyword){
        $query = 'SELECT respons FROM reponse WHERE word = :word';
        $get = $this->db->prepare($query);
        $get->execute([
            'word' => $keyword,
        ]) or die(print_r($this->db->errorInfo()));

        return $get->fetch();
    }


}
