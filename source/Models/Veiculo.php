<?php
namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

Class Veiculo extends DataLayer
{
    public function __construct()
    {
        parent::__construct("veiculos", ["veiculo"]);
    }

    public function getVendido(){
        if(!$this->vendido){
            return 'Não Vendido';
        }else{
            return 'Vendido';
        }        
    }
}