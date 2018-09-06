<?php

namespace TrabajoTarjeta;

class Colectivo implements ColectivoInterface {

    protected $linea;
    protected $empresa;
    protected $numero;
    protected $valorboleto = 14.80;

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
		
		if($tarjeta->reducirSaldo($this->valorboleto)){
			return new Boleto($tarjeta->valorpasaje(),$this,$tarjeta,$tarjeta->obtenerID(),$this->linea(),get_class($tarjeta),$tarjeta->obtenerViajesplusAbonados(),$tarjeta->valordelospasajesplus(), date("d/m/Y H:i", time()));
		}
		else return false;
		
    }

}