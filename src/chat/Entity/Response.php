<?php

namespace App\chat\Entity;

class Response
{
    public array $keyWord = [];

    public string $respons = '';

    public int $priority;

    public function __construct(array $keyword, string $respons, int $prioriry = 1){
        $this->keyWord = $keyword;
        $this->respons = $respons;
        $this->priority = $prioriry;
    }
}