<?php

namespace App\chat\Repository;

use App\chat\Entity\Produit;
use App\chat\Entity\Response;
use App\database\dbConnection;

class ResponseRepository{

    private \PDO $db;

    public function __construct(dbConnection $dbConnection){
        $this->db = $dbConnection->getDataBase();
    }

    public function addResponse(Response $response): void{
        $query = 'INSERT INTO c_response (response) VALUES (:response)';
        $insert = $this->db->prepare($query);
        $insert->execute([
            'response' => $response->getResponse(),
        ]) or die(print_r($this->db->errorInfo()));
    }

    public function getResponse(string $keyword){
        $query = 'SELECT response, priority, keyword FROM c_keyword INNER JOIN c_response ON c_keyword.response_id = c_response.id WHERE keyword = :keyword';
        $get = $this->db->prepare($query);
        $get->execute([
            'keyword' => $keyword,
        ]) or die(print_r($this->db->errorInfo()));
        return $get->fetch();
    }
}
