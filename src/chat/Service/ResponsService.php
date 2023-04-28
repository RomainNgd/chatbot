<?php

namespace App\chat\Service;
require_once __DIR__ . '/../Repository/ResponsRepository.php';
require_once __DIR__ . '/../Repository/ProduitRepository.php';
require_once __DIR__ . '/../Repository/CategorieRepository.php';
require_once __DIR__. '/../../dataBase/dbConnection.php';


use App\chat\Repository\CategorieRepository;
use App\chat\Repository\ProduitRepository;
use App\chat\Repository\ResponsRepository;
use App\database\dbConnection;

class ResponsService
{
    private ResponsRepository $responsRepository;
    private ProduitRepository $produitRepository;
    private CategorieRepository $categorieRepository;

    public function __construct(){
        $this->responsRepository = new ResponsRepository(new dbConnection());
        $this->produitRepository  = new ProduitRepository(new dbConnection());
        $this->categorieRepository  = new CategorieRepository(new dbConnection());

    }

    public function searchProduit($sentence)
    {
        $reponse = false;
        $words = explode(' ', $sentence);
        foreach ($words as $item){
            $item = strtolower(htmlentities($item));
            $result = $this->produitRepository->getProduit($item);
            if ($result !== false){
                $reponse = $result;
            }
        }
        return $reponse;
    }


    public function searchCategorie($sentence) : array|string
    {
        $words = explode(' ', $sentence);
        $reponse= false;
        foreach ($words as $item){
            $item = strtolower(htmlentities($item));
            $result = $this->categorieRepository->getCategorie($item);
            if ($result !== false){
                $reponse = $result;
            }
        }
        return $reponse;
    }

    public function searchKeyword($sentence): array|string
    {
        $words = explode(' ', $sentence);
        $reponse = false;
        foreach ($words as $item){
            $item = strtolower(htmlentities($item));
            $result = $this->responsRepository->getResponse($item);
            if ($result !== false){
                $reponse = $result;
            }
        }
        return $reponse;
    }

    public function returnRespons($sentences){
        $reponse = $this->searchKeyword($sentences);
        if (!$reponse){
            $reponse = $this->searchProduit($sentences);
            if (!$reponse){
                $reponse = $this->searchCategorie($sentences);
            }
        }else{
            $_SESSION['lastMessage'] = $reponse[0];
        }
        if (!$reponse){
            $reponse = "pas compris";
        }
       return json_encode($reponse);
    }
}