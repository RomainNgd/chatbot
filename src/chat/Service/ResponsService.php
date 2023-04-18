<?php

namespace App\chat\Service;
require_once __DIR__ . '/../Repository/ResponsRepository.php';
require_once __DIR__. '/../../dataBase/dbConnection.php';


use App\chat\Repository\ResponsRepository;
use App\database\dbConnection;

class ResponsService
{
    private ResponsRepository $responsRepository;

    public function __construct(){
        $this->responsRepository = new ResponsRepository(new dbConnection());
    }

    public function returnRespons($word){
        $priority = 0;
        $reponse = 'pas compris';
        $words = explode(' ', $word);
        foreach ($words as $item){
            $item = strtolower(htmlentities($item));
            $result = $this->responsRepository->getResponse($item);
            if ($result !== false && $result[1] > $priority){
                    $priority = $result[1];
                    $reponse = $result[0];
            }
        }
       return json_encode($reponse);
    }
}