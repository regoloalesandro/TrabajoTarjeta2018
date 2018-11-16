<?php

namespace TrabajoTarjeta;

class MedioSecundario extends  Tarjeta {
	protected $limitdia = FALSE;

	/**
	 * reducirSaldo
	 * Reduce del saldo de la tarjeta el valor correspondiente  del pasaje
	 * @param  float $valor
	 * @param  int $linea
	 * @param  mixed $bandera
	 *
	 * @return True/False
	 */
	public function reducirSaldo($valor, $linea, $bandera){
		$this->pasajeestandar=$valor;
		$valor/=2;
		
		
		//Si el ultimo viaje fue realizado hace menos de 5 min
		if($this->tiempo->time() - $this->ultviaje < 300 ){
			return FALSE;
		}
		
		//Si se realizo por lo menos un viaje desde que se creo la tarjeta
		if($this->ultviaje != -5401){
			if( $this->tiempo->time() - $this->ultviaje < 86400){
				//Si ya viajo en el dia de la fecha, este viaje sera su ultimo a mitad de valor
				$this->limitdia = TRUE;
			}
			else{
				$this->limitdia = FALSE;
			}
		}
		
		if($this->checkUltViajeTrasbordo() == FALSE){
			if ($this->checkTrasbordo($linea, $bandera)){
				//Esta bandera se pone true para la proxima vez que intente pagar
				$this->ultviajetrasbordo=TRUE;				
			}
		}
		else{
			$this->ultviajetrasbordo=FALSE;
		}
		
		if($this->saldo>$valor && $this->viajep >= 0 && $this->viajep <= 2){
			$this->saldo -= $valor * ($this->viajep+1);
			$this->quitarplus( $this->viajep );
			$this->pasaje = $valor *($this->viajep+1);
			$this->viajesplusquepago= $this->viajep;
		}

		if($this->saldo<$valor && $this->viajep <2){
			$this->plus();
			$this->pasaje =$valor;
			$this->viajesplusquepago=-1;
		}

		elseif($this->viajep == 2){
			return false;
		}

		$this->ultlinea = $linea;
		$this->ultbandera = $bandera;	
		$this->ultviaje = $this->tiempo->time();

		return true;
	}
}
