<?php

namespace TrabajoTarjeta;

class Boleto implements BoletoInterface {

    protected $linea;
    protected $empresa;
    protected $numero;

    public function __construct($linea, $empresa, $numero) {
        $this->linea = $linea;
        $this->empresa = $empresa;
        $this->numero = $numero;
    }

    public function linea() {
        return $this->linea;
    }

    public function empresa() {
        return $this->empresa;
    }

    public function numero() {
        return $this->numero;
    }

    public function pagarCon(TarjetaInterface $tarjeta){
        if ($tarjeta->saldo <= 14.80){
            return FALSE;
        }
        else{
            $boleto = new Boleto(14.80, $this, $tarjeta);
            return $boleto;
        }
    }

}