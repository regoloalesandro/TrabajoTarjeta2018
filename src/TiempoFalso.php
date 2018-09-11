<?php

namespace TrabajoTarjeta;

class TiempoFalso implements TiempoInterface{
    protected $tiempo;

    public function __construct($inicio = 0){
        $this->tiempo = $inicio;
    } 

    public function avanzar($segundos){
        $this->tiempo += $segundos;
    }

    public function time(){
        return $this->time;
    }

    public function reiniciar(){
        $this->tiempo = 0;
    }
}