<?php

namespace TrabajoTarjeta;

class Jubilados extends  Tarjeta {
	protected $pasajeestandar=0;
	
	public function valorpasaje(){
		return 0;
	}

	public function reducirSaldo($valor){
      	return true;
	}
	
}
