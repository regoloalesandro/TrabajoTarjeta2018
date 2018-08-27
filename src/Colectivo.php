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
        if ($tarjeta->obtenerSaldo() <= $this->valorboleto && $tarjeta->obtenerViajesplus() < 3 )
	{
            $tarjeta->plus();
	    $boleto = new Boleto($this->valorboleto*1, $this, $tarjeta);
	    return $boleto;
	}
        elseif($tarjeta->obtenerViajesplus()==2)
		{
            $boleto = new Boleto($this->valorboleto*3, $this, $tarjeta);
            $tarjeta->reducirSaldo($boleto->obtenerValor());
 	    $tarjeta->quitarplus(2);           	
 		return $boleto;

        	}
	elseif($tarjeta->obtenerViajesplus() == 1){
	    $boleto = new Boleto($this->valorboleto*2, $this, $tarjeta);
            $tarjeta->reducirSaldo($boleto->obtenerValor());
 	    $tarjeta->quitarplus(1);           	
 		return $boleto;
	}
        elseif ($tarjeta->obtenerViajesplus() == 0){
	    $boleto = new Boleto($this->valorboleto, $this, $tarjeta);
            $tarjeta->reducirSaldo($boleto->obtenerValor());
 	    $tarjeta->quitarplus(0);           	
 		return $boleto;
	}
        else {
		return FALSE;
	}
    }

}
