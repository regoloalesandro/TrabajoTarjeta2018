<?php

namespace TrabajoTarjeta;

class Medioboleto extends  Tarjeta {
	public function reducirSaldo($valor){
		$this->pasajeestandar=$valor/2;

		if($this->saldo>$valor && $this->viajep == 0){
			$this->saldo -=($valor/2);
			$this->pasaje =($valor/2);
			$this->viajesplusquepago=0;
		}

		if($this->saldo>$valor && $this->viajep == 1){
			$this->saldo -=($valor/2)*2;
			$this->quitarplus(1);
			$this->pasaje =($valor/2)*2;
			$this->viajesplusquepago=1;
		}

		if($this->saldo>$valor && $this->viajep == 2){
			$this->saldo -=($valor/2)*3;
			$this->quitarplus(2);
			$this->pasaje =($valor/2)*3;
			$this->viajesplusquepago=2;
		}

		if($this->saldo<$valor && $this->viajep <2){
			$this->plus();
			$this->pasaje =($valor/2);
			$this->viajesplusquepago=-1;
		}

		elseif($this->viajep == 2){
			return false;
		}

		return true;
	}
}
