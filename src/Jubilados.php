<?php

namespace TrabajoTarjeta;

class Jubilados extends  Tarjeta {
	protected $pasajeestandar=0;
	
	/**
	 * valorpasaje
	 * Devuelve el valor del pasaje para el jubilado que sera siempre 0
	 * @return 0
	 */
	public function valorpasaje(){
		return 0;
	}

	/**
	 * reducirSaldo
	 * devuelve siempre true por que siempre podra pagar el pasaje 
	 * @param  float $valor
	 * @param  int $linea
	 * @param  mixed $bandera
	 *
	 * @return true
	 */
	public function reducirSaldo($valor,$linea, $bandera){
      	return true;
	}
	
}
