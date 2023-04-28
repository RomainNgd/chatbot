<?php

namespace App\chat\Repository;

use App\chat\Entity\Keyword;
use App\chat\Entity\Produit;
use App\database\dbConnection;

class KeywordRepository
{


    private \PDO $db;

    public function __construct(dbConnection $dbConnection){
        $this->db = $dbConnection->getDataBase();
    }

    public function addKeyword(Keyword $keyword){
        $query = 'INSERT INTO c_keyword (keyword, response_id, priority) VALUES (:keyword, :response_id, :priority)';
        $insert = $this->db->prepare($query);
        $insert->execute([
            'keyword' => $keyword->getKeyword(),
            'response_id' => $keyword->getResponse()->getId(),
            'priority' => $keyword->getPriority(),
        ]) or die(print_r($this->db->errorInfo()));
    }

    public function getKeyword($word){
        $query = 'SELECT * FROM c_keyword WHERE keyword = :keyword';
        $get = $this->db->prepare($query);
        $get->execute([
            'keyword' => $word,
        ]) or die(print_r($this->db->errorInfo()));
        return $get->fetch();
    }

    public function removeKeyword($id){
        $query = 'DELETE FROM c_keyword WHERE id = :id';
        $get = $this->db->prepare($query);
        $get->execute([
            'id' => $id,
        ]) or die(print_r($this->db->errorInfo()));
        return $get->fetch();
    }
}