<?php
namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

Class Voto extends DataLayer
{
    public function __construct()
    {
        parent::__construct("votos", ["id"]);
    }
    
    public function getVotos(){
        return $this->find()->fetch(true);
    }

    public function getTipo(){
        $voto = (new Voto())->find("id =:e", "e={$this->id}")->fetch();

        return $voto->tipo;
    }

    public function getQt(){
        $voto = (new Voto())->find("id =:e", "e={$this->id}")->fetch();

        return $voto->quantidade;
    }

    public function getTotal(){
        $votos = $this->getVotos();

        $total = array_reduce($votos, function($carry, $item)
        {
            return $carry + $item->quantidade;
        });

        return $total;
    }

    public function getPercentual(){
        $qt=$this->quantidade;

        $total = $this->getTotal();

        $percentual = ((100*$qt)/$total);

        return $percentual.' %';
    }
}