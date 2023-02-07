<?php

namespace src\entity\Response;

class Response
{
    public array $keyWord = [];

    public string $respons = '';

    public int $priority;

    public function build(array $keyword, string $respons, int $prioriry = 1) : void{
        $this->keyWord = $keyword;
        $this->respons = $respons;
        $this->priority = $prioriry;
    }
}