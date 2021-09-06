<?php
namespace Source\Models;

Class Multiplos
{
    public $numero;

    public function getMultiplos(){
        $callback["resultado"] = $this->calculaMultiplos((int) $this->numero);
        echo json_encode($callback);
    }

    public function calculaMultiplos($numero) {
        $x = 3;
        $z = 5;
        $somax = 0;
        $somaz = 0;
        $res;
    
        for($i = 1; $i < $numero; $i++) {
            if($i % $x == 0) {
                $somax += $i;
            }
        }
        for($i = 1; $i < $numero; $i++) {
            if($i % $z == 0) {
                $somaz += $i;
            }
        }
        $res = $somax + $somaz;
    
        return $res;
    }

}