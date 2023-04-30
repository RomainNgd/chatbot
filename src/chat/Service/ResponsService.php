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
                $_SESSION['lastkeyword'] = $result[2];
            }
        }
        return  $response;
    }

    public function getPrice($sentence){
        $product = $this->searchProduit($sentence);
        return $this->produitRepository->getPrice($product[0]);
    }

    public function returnRespons($sentences): string{
        if(isset($_SESSION['lastkeyword'])){
            switch ($_SESSION['lastkeyword']){
                case 'produit' : {
                    $response = $this->searchProduit($sentences);
                    if (empty($response)){
                        $response = 'Je ne trouve pas le produit veuillez vérifiez l\'orthographe';
                    }
                    break;
                }
                case 'categorie' :{
                    $response = $this->searchCategorie($sentences);
                    if (empty($response)){
                        $response = 'Je ne trouve pas la catégorie, vous l\'avez peut être mal orthographié';
                    }
                    break;
                }
                case 'prix' : {
                    $response = $this->getPrice($sentences);
                    if (empty($response)){
                        $response = 'Je ne trouve pas la produit dont vous voulez connaitre le prix veuillez vérifiez l\'orthographe';
                    }
                    break;
                }
                default : {
                    $response = $this->searchKeyword($sentences);
                }
            }
        } else {
            $response = $this->searchKeyword($sentences);
            if(empty($this->searchKeyword($sentences))){
                $response = $this->searchProduit($sentences);
                if (empty($response)){
                    $response = $this->searchCategorie($sentences);
                }
            }
            if (!$response){
                $response = "Je n'ai pas compris votre message";
            }
        }
        return json_encode($response);
    }

    public function resetChat() : void{
        unset($_SESSION['lastkeyword']);
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