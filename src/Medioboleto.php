<?php

namespace TrabajoTarjeta;

class Medioboleto extends  Tarjeta {
	protected $ultviaje;
	protected $limitdia = FALSE;

	public function reducirSaldo($valor){
		$this->pasajeestandar=$valor;
		$valor/=2;
		//Si ya viajo 2 veces hoy, el boleto tendra valor normal
		if($this->limitdia == TRUE ){
			$valor*=2;
		}
		
		//Si el ultimo viaje fue realizado el dia de la fecha
		if(getdate( $this->ultviaje )['year'] == getdate( $this->tiempo->time() )['year'] && getdate( $this->ultviaje )['mon'] == getdate( $this->tiempo->time() )['mon'] && getdate( $this->ultviaje )['mday'] == getdate( $this->tiempo->time() )['mday']){
			//Si fue realizado en la misma "hora"
			if($this->ultviaje['hours'] == getdate( $this->tiempo->time() )['hours']){
				if($this->ultviaje['minutes']+5 >= getdate( $this->tiempo->time() )['minutes'] ){
					return false;
				}
			}
			//Si hubo un cambio de hora entre los 2 viajes. Ej ultviaje a las 14:57 y se intenta viajar a las 15:01
			elseif($this->ultviaje['hours'] == getdate( $this->tiempo->time() )['hours']-1 ){
				if($this->ultviaje['minutes']+5 >= getdate( $this->tiempo->time() )['minutes']+60){
					return false;
				}
			}
			//Si ya viajo en el dia de la fecha, este viaje sera su ultimo a mitad de valor
			$this->limitdia = TRUE;
		}
		else{
			$this->limitdia = FALSE;
		}
		

		if($this->saldo>$valor && $this->viajep == 0){
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

		$this->ultviaje = $this->tiempo->time();

		return true;
	}
}
