<?php
namespace App\chat\Controller;

use App\chat\Repository\ResponsRepository;
class ResponsController{

    public function index(ResponsRepository $responsRepository){
        var_dump(strval($responsRepository->getResponse('bonjour')));
    }
}