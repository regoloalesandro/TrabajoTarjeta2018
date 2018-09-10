<?php

namespace TrabajoTarjeta;

class Medioboleto extends  Tarjeta {
	protected $ultviaje;

	public function reducirSaldo($valor){
		$this->pasajeestandar=$valor/2;
		
		//Si el ultimo viaje fue realizado el dia de la fecha
		if($this->ultviaje['year'] == getdate(time())['year'] && $this->ultviaje['mon'] == getdate(time())['mon'] && $this->ultviaje['mday'] == getdate(time())['mday']){
			//Si fue realizado en la misma "hora"
			if($this->ultviaje['hours'] == getdate(time())['hours']){
				if($this->ultviaje['minutes'] <= getdate(time())['minutes']-5 ){
					return false;
				}
			}
			//Si hubo un cambio de hora entre los 2 viajes. Ej ultviaje a las 14:57 y se intenta viajar a las 15:01
			elseif($this->ultviaje['hours'] == getdate(time())['hours']-1 ){
				if($this->ultviaje['minutes'] <= (getdate(time())['minutes']+60) - 5 ){
					return false;
				}
			}
		}
		

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

		$this->ultviaje = getdate( time() );

		return true;
	}
}
