<?php

namespace TrabajoTarjeta;

class Medioboleto extends  Tarjeta {
	protected $ultviaje = -300;
	protected $limitdia = FALSE;

	public function reducirSaldo($valor){
		$this->pasajeestandar=$valor;
		$valor/=2;
		//Si ya viajo 2 veces hoy, el boleto tendra valor normal
		if($this->limitdia == TRUE ){
			$valor*=2;
		}
		
		//Si el ultimo viaje fue realizado hace menos de 5 min
		if($this->tiempo->time() - $this->ultviaje < 300 ){
			return FALSE;
		}
		
		//Si se realizo por lo menos un viaje desde que se creo la tarjeta
		if($this->ultviaje != -300){
			if(getdate( $this->ultviaje )['year'] == getdate( $this->tiempo->time() )['year'] && getdate( $this->ultviaje )['mon'] == getdate( $this->tiempo->time() )['mon'] && getdate( $this->ultviaje )['mday'] == getdate( $this->tiempo->time() )['mday']){
				//Si ya viajo en el dia de la fecha, este viaje sera su ultimo a mitad de valor
				$this->limitdia = TRUE;
			}
			else{
				$this->limitdia = FALSE;
			}
		}
		

		if($this->saldo>$valor && $this->obtenerViajesplus() == 0){
			$this->saldo -=$valor;
			$this->pasaje =$valor;
			$this->viajesplusquepago=0;
		}

		if($this->saldo>$valor && $this->obtenerViajesplus() == 1){
			$this->saldo -=$valor*2;
			$this->quitarplus(1);
			$this->pasaje =$valor*2;
			$this->viajesplusquepago=1;
		}

		if($this->saldo>$valor && $this->obtenerViajesplus() == 2){
			$this->saldo -=$valor*3;
			$this->quitarplus(2);
			$this->pasaje =$valor*3;
			$this->viajesplusquepago=2;
		}

		if($this->saldo<$valor && $this->obtenerViajesplus() <2){
			$this->plus();
			$this->pasaje =$valor;
			$this->viajesplusquepago=-1;
		}

		elseif($this->obtenerViajesplus() == 2){
			return false;
		}

		$this->ultviaje = $this->tiempo->time();

		return true;
	}
}
