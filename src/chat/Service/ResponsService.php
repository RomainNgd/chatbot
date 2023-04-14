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
        return json_encode($this->responsRepository->getResponse($word)[0]);
    }
}