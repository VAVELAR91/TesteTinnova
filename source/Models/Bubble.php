<?php
namespace Source\Models;

Class Bubble
{
    public $v;

    public function getArray(){
        return implode(', ',$this->v);
    }

    public function bubbleSort(){
        $array = $this->v;
        do{
            $trocar = false;
            for($i = 0, $c= count($array) - 1; $i < $c; $i++){
                if($array[$i] > $array[$i + 1]){
                    list($array[$i+1], $array[$i]) = array($array[$i], $array[$i + 1]);
                    $trocar = true;
                }
            }
        }
        while($trocar);
        
        return implode(', ',$array);
    }
}