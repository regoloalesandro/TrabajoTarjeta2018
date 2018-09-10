<?php

namespace TrabajoTarjeta;

class Tarjeta implements TarjetaInterface {
	protected $saldo;
	protected $viajep = 0;
	protected $id;
	protected $viajesplusquepago;
	protected $pasajeestandar;

	public function __construct() {
        $this->saldo = 0.0;
    }


    public function recargar($monto) {
      // Esto  esta hecho bien a proposito  :P.
		switch ($monto) {
			case 10.0:
			$this->saldo += $monto;
				return true;
			case 20.0:
			$this->saldo += $monto;
				return true;
			case 30.0:
			$this->saldo += $monto;
				return true;
			case 50.0:
			$this->saldo += $monto;
				return true;
			case 100.0:
			$this->saldo += $monto;
				return true;
			case 510.15:
			$this->saldo += $monto+81.93;
				return true;
			case 962.59:
			$this->saldo += $monto+221.58;
				return true;
			default:
				return false;
		}
    }

    /**
     * Devuelve el saldo que le queda a la tarjeta.
     *
     * @return float
     */
    public function obtenerSaldo() {
      return $this->saldo;
	}
	public function valorpasaje(){
		return $this->pasaje;
	}

	public function reducirSaldo($valor){
		$this->pasajeestandar=$valor;

		if($this->saldo > $valor && $this->viajep == 0){
			$this->saldo -=$valor;
			$this->pasaje =$valor;
			$this->viajesplusquepago=0;
		}

		if($this->saldo>$valor && $this->viajep == 1){
			$this->saldo -=$valor*2;
			$this->quitarplus(1);
			$this->pasaje =$valor*2;
			$this->viajesplusquepago=1;
		}

		if($this->saldo>$valor && $this->viajep == 2){
			$this->saldo -=$valor*3;
			$this->quitarplus(2);
			$this->pasaje =$valor*3;
			$this->viajesplusquepago=2;
		}

		if($this->saldo<$valor && $this->viajep <2){
			$this->plus();
			$this->pasaje =$valor;
			$this->viajesplusquepago=-1;			
		}

		elseif($this->viajep == 2){
			return false;
		}

		return true;
	}
	public function obtenerViajesplus(){
		return $this->viajep;
	}

	public function plus(){
		$this->viajep += 1;
	}

	public function quitarplus($cantidad){
		$this->viajep -= $cantidad;	
	}

	public function obtenerID(){
		return $this->id;
	}

	public function obtenerViajesplusAbonados(){
		return $this->viajesplusquepago;
	}

	public function valordelospasajesplus(){
		if($this->viajesplusquepago>0){
			return $this->pasajeestandar*$this->viajesplusquepago;
		}
		elseif($this->viajesplusquepago== 0){
			return 0;
		}
		else{
			return -1;
		}
	}
}
