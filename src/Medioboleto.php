<?php

namespace TrabajoTarjeta;

class Medioboleto extends  Tarjeta {
	public $franquicia= 2;

	public function reducirSaldo($valor){
		$this->saldo -= ($valor/2);

	}


}
