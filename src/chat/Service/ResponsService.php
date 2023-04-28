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
        $responses = [];
        $words = explode(' ', $sentence);
        foreach ($words as $item){
            $item = strtolower(htmlentities($item));
            $results = $this->produitRepository->getProduit($item);
            if ($results !== false){
                foreach ($results as $result){
                    $responses[] = $result;
                }
            }
        }
        if (count($responses) > 1){
            return $this->multipleResponse('produit', $responses);
        } elseif(count($responses) > 0) {
            return $this->simpleResponse('produit', $responses[0]);
        } else {
            return '';
        }
    }


    public function searchCategorie($sentence) : array|string
    {
        $responses = [];
        $words = explode(' ', $sentence);
        foreach ($words as $item){
            $item = strtolower(htmlentities($item));
            $results = $this->categorieRepository->getCategorie($item);
            if ($results !== false){
                foreach ($results as $result){
                    $responses[] = $result;
                }
            }
        }
        if (count($responses) > 1){
            return $this->multipleResponse('categorie', $responses);
        } elseif(count($responses) > 0) {
            return $this->simpleResponse('categorie', $responses[0]);
        } else {
            return '';
        }
    }

    public function searchKeyword($sentence): array|string
    {
        $words = explode(' ', $sentence);
        $priority = 0;
        $response = '';
        foreach ($words as $item){
            $item = strtolower(htmlentities($item));
            $result = $this->responsRepository->getResponse($item);
            if ($result !== false && $result['priority'] > $priority){
                $response = $result[0];
                $priority = $result['priority'];
            }
        }
        return  $response;
    }

    public function getPrice($sentence){
        $product = $this->searchProduit($sentence);
        return $this->produitRepository->getPrice($product[0]);
    }

    public function returnRespons($sentences){

        if(isset($_SESSION['lastkeyword'])){
            switch ($_SESSION['lastkeyword']){
                case 'produit' : {
                    $reponse = $this->searchProduit($sentences);
                    if (empty($reponse)){
                        $reponse = 'Je ne trouve pas le produit veuillez vérifiez l\'orthographe';
                    }
                    break;
                }
                case 'categorie' :{
                    $reponse = $this->searchCategorie($sentences);
                    if (empty($reponse)){
                        $reponse = 'Je ne trouve pas la ctatégorie veuillez vérifiez l\'orthographe';
                    }
                    break;
                }
                case 'prix' : {
                    $reponse = $this->getPrice($sentences);
                    if (empty($reponse)){
                        $reponse = 'Je ne trouve pas la produit veuillez vérifiez l\'orthographe';
                    }
                    break;
                }
                default : {
                    $reponse = $this->searchKeyword($sentences);
                    $_SESSION['lastkeyword'] = $reponse;
                }
            }
        } else {
            $reponse = $this->searchKeyword($sentences);
            if(!empty($this->searchKeyword($sentences))){
                $_SESSION['lastkeyword'] = $reponse;
            }
            else{
                $reponse = $this->searchProduit($sentences);
                if (empty($reponse)){
                    $reponse = $this->searchCategorie($sentences);
                }
            }
            if (!$reponse){
                $reponse = "Je n'ai pas compris votre message";
            }
        }
        return json_encode($reponse);
    }

    private function multipleResponse($entity, $results){
        $response = 'Nous avons trouver plusieurs ' . $entity . 's pour votre demande <br/>';
        foreach ($results as $result){
            $response .= $result[$entity] . ' : <a href="'. $result["url"] .'">' . $result['url'] . '</a></br>' ;
        }
        return $response;
    }

    private function simpleResponse($entity, $result){
       return 'J\'ai trouver un ' . $entity . ' correspondant à votre demande <br/>' . $result[$entity] . ' : <a href="'. $result["url"] .'">' . $result['url'] . '</a>' ;
    }
}