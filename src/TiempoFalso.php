<?php

namespace TrabajoTarjeta;

class TiempoFalso implements TiempoInterface{
    protected $time;

    public function __construct($inicio = 0){
        $this->time = $inicio;
    } 

    public function avanzar($segundos){
        $this->time += $segundos;
    }

    public function time(){
        return $this->time;
    }

    public function reiniciar(){
        $this->time = 0;
    }
}