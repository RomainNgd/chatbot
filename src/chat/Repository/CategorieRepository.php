<?php

namespace App\chat\Repository;

use App\chat\Entity\Categorie;
use App\database\dbConnection;

class CategorieRepository
{

    private \PDO $db;

    public function __construct(dbConnection $dbConnection){
        $this->db = $dbConnection->getDataBase();
    }

    public function addCategorie(Categorie $categorie){
        $query = 'INSERT INTO c_categorie (categorie, url) VALUES (:categorie, url)';
        $insert = $this->db->prepare($query);
        $insert->execute([
            'categorie' => $categorie->getCategorie(),
            'url' => $categorie->getUrl(),
        ]) or die(print_r($this->db->errorInfo()));
    }

    public function getCategorie($word){
        $query = 'SELECT * FROM c_categorie WHERE categorie = :categorie';
        $get = $this->db->prepare($query);
        $get->execute([
            'categorie' => $word,
        ]) or die(print_r($this->db->errorInfo()));
        return $get->fetchAll();
    }

    public function removeCategorie(int $id){
        $query = 'DELETE FROM c_categorie WHERE id = :id';
        $get = $this->db->prepare($query);
        $get->execute([
            'id' => $id,
        ]) or die(print_r($this->db->errorInfo()));
        return $get->fetch();
    }
}