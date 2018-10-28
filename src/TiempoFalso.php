<?php

namespace TrabajoTarjeta;

class TiempoFalso implements TiempoInterface{
    protected $time;

    /**
     * __construct
     * Crea el objeto Tiempo falso y le asigna valores iniciales
     * @param  int $inicio
     *
     * @return void
     */
    public function __construct($inicio = 0){
        $this->time = $inicio;
    } 

    /**
     * avanzar
     * hace avanzar el tiempo del objeto
     * @param  int $segundos
     *
     * @return void
     */
    public function avanzar($segundos){
        $this->time += $segundos;
    }

    /**
     * time
     * devuelve el tiempo que lleva adentro
     * @return int
     */
    public function time(){
        return $this->time;
    }

    /**
     * reiniciar
     * devuelve el tiempo a 0
     * @return void
     */
    public function reiniciar(){
        $this->time = 0;
    }
}