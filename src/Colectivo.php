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
        if ($tarjeta->obtenerSaldo() <= $valorboleto && $tarjeta->viajep < 3 ){
            $tarjeta->plus();
	    $boleto = new Boleto($valorboleto*1, $this, $tarjeta);
	    return $boleto;
	}
        else if($tarjeta->viajep == 2){
            $boleto = new Boleto($valorboleto*3, $this, $tarjeta);
            $tarjeta->reducirSaldo($boleto->obtenerValor());
 	    $tarjeta->quitarplus(2);           	
 		return $boleto;

        }
	else if($tarjeta->viajep == 1){
	    $boleto = new Boleto($valorboleto*2, $this, $tarjeta);
            $tarjeta->reducirSaldo($boleto->obtenerValor());
 	    $tarjeta->quitarplus(1);           	
 		return $boleto;
	}
        else if ($tarjeta->viajep == 0){
	    $boleto = new Boleto($valorboleto, $this, $tarjeta);
            $tarjeta->reducirSaldo($boleto->obtenerValor());
 	    $tarjeta->quitarplus(0);           	
 		return $boleto;
	}
        else {
			return false;
	}
    }

}
