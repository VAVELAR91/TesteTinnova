<?php

namespace Source\App;

use League\Plates\Engine;
use Source\Models\Voto;

class Web
{
    private $view;

    public function __construct(){
        $this->view = Engine::create(__DIR__."/../../theme","php");
    }

    public function home():void{
        $votos = (new Voto())->getVotos();
        $total = (new Voto())->getTotal();

        echo $this->view->render("home", [
            "title" => "1) Votos em relação ao Total de Eleitores | " . SITE,
            "votos" => $votos,
            "total" => $total
        ]);
    }

    public function bubbleSort():void{
        echo $this->view->render("bubblesort", [
            "title" => "2) Algoritimo de ordenação Bubble Sort | " . SITE
        ]);
    }

    public function fatorial():void{
        echo $this->view->render("fatorial", [
            "title" => "3) Fatorial | " . SITE
        ]);
    }

    public function multiplos():void{
        echo $this->view->render("multiplos", [
            "title" => "4) Soma dos multiplos de 3 ou 5 | " . SITE
        ]);
    }

    public function veiculos():void{
        echo $this->view->render("veiculos", [
            "title" => "5) Cadastro de veículos | " . SITE
        ]);
    }

    public function error(array $data):void{
        echo $this->view->render("erro", [
            "title" => "Erro | " . SITE,
            "error" => $data["errcode"]
        ]);
    }
}
