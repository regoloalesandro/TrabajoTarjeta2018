<?php

namespace TrabajoTarjeta;

class TiempoReal implements TiempoInterface{
    
    /**
     * time
     * devuelve la hora y fecha actual
     * @return void
     */
    public function time(){
        return time();
    }
}
