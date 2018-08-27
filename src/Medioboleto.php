<?php

namespace TrabajoTarjeta;

class Mediovoleto extends  Tarjeta {
	protected $franquicia= 2;

	public function reducirSaldo($valor){
		$this->saldo -= ($valor/2);

	}


}
