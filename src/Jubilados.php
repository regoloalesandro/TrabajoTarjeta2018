<?php

namespace TrabajoTarjeta;

class Jubilados extends  Tarjeta {

	public function valorpasaje(){
		return 0;
	}

	public function reducirSaldo($valor){
      	return true;
	}

}
