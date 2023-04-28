<?php

namespace App\chat\Repository;

use App\chat\Entity\Produit;
use App\database\dbConnection;

class ProduitRepository
{

    private \PDO $db;

    public function __construct(dbConnection $dbConnection){
        $this->db = $dbConnection->getDataBase();
    }

    public function addProduit(Produit $produit){
        $query = 'INSERT INTO c_produit (produit, prix, url, ref, categorie_id) VALUES (:produit, :prix, :url, :ref, :categorie_id)';
        $insert = $this->db->prepare($query);
        $insert->execute([
            'produit' => $produit->getProduit(),
            'prix' => $produit->getPrix(),
            'url' => $produit->getUrl(),
            'ref' => $produit->getRef(),
            'categorie_id' => $produit->getCategorie()->getId(),
        ]) or die(print_r($this->db->errorInfo()));
    }

    public function getProduit(string $word){
        if (strlen($word) >= 4){
            $query = 'SELECT produit, url FROM c_produit WHERE produit LIKE "%'.$word[0].$word[1].$word[2].$word[3].'%"';
        }
        elseif(strlen($word) > 1){
            $query = 'SELECT produit, url FROM c_produit WHERE produit LIKE "'.$word.'"';
        }else{
            return false;
        }
        $get = $this->db->prepare($query);
        $get->execute() or die(print_r($this->db->errorInfo()));
        return $get->fetchAll();
    }

    public function removeProduit(int $id){
        $query = 'DELETE FROM c_produit WHERE id = :id';
        $get = $this->db->prepare($query);
        $get->execute([
            'id' => $id,
        ]) or die(print_r($this->db->errorInfo()));
        return $get->fetch();
    }

    public function getPrice($product){
        $query = 'SELECT produit, prix, url FROM c_produit WHERE produit = :produit';
        $get = $this->db->prepare($query);
        $get->execute([
            'produit' => $product,
        ]);
        return $get->fetch();
    }
}