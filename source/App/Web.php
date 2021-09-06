<?php

namespace Source\App;

use League\Plates\Engine;
use Source\Models\Voto;
use Source\Models\Bubble;
use Source\Models\Fatorial;
use Source\Models\Multiplos;
use Source\Models\Veiculo;

class Web
{
    private $view;

    public function __construct($router){
        $this->view = Engine::create(__DIR__."/../../theme","php");

        $this->view->addData(["router" => $router]);
    }
    
    //Exercício 1
    public function home():void{
        $votos = (new Voto())->getVotos();
        $total = (new Voto())->getTotal();

        echo $this->view->render("home", [
            "title" => "1) Votos em relação ao Total de Eleitores | " . SITE,
            "votos" => $votos,
            "total" => $total
        ]);
    }                

    public function error(array $data):void{
        echo $this->view->render("erro", [
            "title" => "Erro | " . SITE,
            "error" => $data["errcode"]
        ]);
    }

    //Execício 2
    public function bubbleSort():void{
        $bubble = new Bubble();
        $bubble->v = array(5,3,2,4,7,1,0,6);

        echo $this->view->render("bubblesort", [
            "title" => "2) Algoritimo de ordenação Bubble Sort | " . SITE,
            "bubble" => $bubble
        ]);
    }

    //Exercício 3
    public function fatorial():void{
        echo $this->view->render("fatorial", [
            "title" => "3) Fatorial | " . SITE
        ]);
    }

    public function getFatorial($data){
        $fatorial = new Fatorial();
        $fatorial->numero = $data["numero"];
        
        return $fatorial->getFatorial();
    }

    //Exercício 4
    public function multiplos():void{
        echo $this->view->render("multiplos", [
            "title" => "4) Soma dos multiplos de 3 ou 5 | " . SITE
        ]);
    }

    public function getMultiplos($data){
        $multiplos = new Multiplos();
        $multiplos->numero = $data["numero"];
        
        return $multiplos->getMultiplos();
    }

    //Exerício 5
    public function veiculos():void{
        $veiculos = (new Veiculo())->find()->fetch(true);

        echo $this->view->render("veiculos", [
            "title" => "5) Cadastro de veículos | " . SITE,
            "veiculos" => $veiculos,
        ]);
    }

    public function findVeiculos(){
        $veiculos = (new Veiculo())->find("{$_GET["q"]} = '{$_GET["find"]}'")->fetch(true);

        $callback["veiculos"] = "";
        foreach($veiculos as $veiculo){
            $callback["veiculos"] .= $this->view->render("fragments/veiculos", ["veiculo"=> $veiculo]);
        }
        echo json_encode($callback);
    }

    public function findVeiculosById(){
        $veiculo = (new Veiculo())->findById($_GET["find"]);

        $callback["veiculo"] = $this->view->render("fragments/veiculos", ["veiculo"=> $veiculo]);

        echo json_encode($callback);
    }

    public function postVeiculo(array $data){
        $veiculoData = $data;
        
        if($veiculoData["id"]>0){
            $callback["message"] = "Veiculo atualizado com sucesso";
            $veiculo = (new Veiculo())->findById($veiculoData["id"]);
        }else{
            $callback["message"] = "Veiculo cadastrado com sucesso";
            $veiculo = new Veiculo();
        }     
        
        $veiculo->veiculo = $veiculoData["veiculo"];
        $veiculo->marca = $veiculoData["marca"];
        $veiculo->ano = (int) $veiculoData["ano"];
        $veiculo->descricao = $veiculoData["descricao"];
        $veiculo->vendido = false;
        $veiculo->save();

        if($veiculo->fail()){
            $callback["message"] = $veiculo->fail()->getMessage();
            echo json_encode($callback);
            return;
        }

        $veiculos = (new Veiculo())->find()->fetch(true);
        $callback["veiculos"] = "";
        foreach($veiculos as $veiculoItem){
            $callback["veiculos"] .= $this->view->render("fragments/veiculos", ["veiculo"=> $veiculoItem]);
        }
        $callback["marcas"] = getMarcas($veiculos);

        echo json_encode($callback);
    }

    public function deleteVeiculo(array $data){
        if(empty($data)){
            return;
        }

        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $veiculo = (new Veiculo())->findById($id);

        $callback["remove"] = true;

        if($veiculo){
            $veiculo->destroy();
            $callback["remove"] = false;
        } 
        echo json_encode($callback);
    }
}
