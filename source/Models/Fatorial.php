<?php
namespace Source\Models;

Class Fatorial
{
    public $numero;

    public function getFatorial(){
        $callback["resultado"] = $this->calculaFatorial((int) $this->numero);
        echo json_encode($callback);
    }

    function calculaFatorial($n){
        return  $n > 1 ? $n * $this->calculaFatorial($n - 1) : 1;
    }
}