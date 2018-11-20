<?php

namespace TrabajoTarjeta;

class Tarjeta implements TarjetaInterface {
	protected $saldo;
	protected $viajep = 0;
	protected $id;
	protected $viajesplusquepago;
	protected $pasajeestandar;
	protected $pasaje;
	protected $tiempo;
	
	protected $ultviaje = -5401;
	protected $ultviajetrasbordo = TRUE;
	protected $ultlinea;
	protected $ultbandera;

	/**
	 * __construct
	 * Funcion que construye el obejto tarjeta y le asigna valores a dicho objeto 
	 * @param  int $time
	 *
	 * @return void
	 */
	public function __construct($time) {
		$this->saldo = 0.0;
		$this->tiempo = $time;
    }

	/**
	 * obtenerTiempo
	 *
	 * @return int
	 */
	public function obtenerTiempo(){
		return $this->tiempo;
	}

    /**
     * recargar
     * Funcion que 
     * @param  float $monto
     *
     * @return true/false
	 * Devuelve true si se pudo cargar y false en el caso contrario
     */
    public function recargar($monto) {
      // Esto  esta hecho bien a proposito  :P.
		switch ($monto) {
			case 10.0:
			$this->saldo += $monto;
				return true;
			case 20.0:
			$this->saldo += $monto;
				return true;
			case 30.0:
			$this->saldo += $monto;
				return true;
			case 50.0:
			$this->saldo += $monto;
				return true;
			case 100.0:
			$this->saldo += $monto;
				return true;
			case 510.15:
			$this->saldo += $monto+81.93;
				return true;
			case 962.59:
			$this->saldo += $monto+221.58;
				return true;
			default:
				return false;
		}
    }

    /**
     * Devuelve el saldo que le queda a la tarjeta.
     *
     * @return float
     */
    public function obtenerSaldo() {
      return $this->saldo;
	}
	/**
	 * valorpasaje
	 * Devuelve cuanto salio el pasaje que pago
	 * @return float
	 */
	public function valorpasaje(){
		return $this->pasaje;
	}

	/**
	 * checkTrasbordo
	 * Devuelve si se puede usar el trasbordo o no
	 * @param  int $linea
	 * @param  mixed $bandera
	 *
	 * @return true/false
	 */
	public function checkTrasbordo($linea, $bandera){

		if($this->ultlinea == $linea && $this->ultbandera == $bandera){
			return FALSE;
		}

		else{		
			if ($this->tiempo->checkFeriado()){
				if( date('H', $this->tiempo->time())<=22  || date('H', $this->tiempo->time())>=6){
					if($this->tiempo->time() - $this->ultviaje < 5400){
						$this->pasajeestandar = $this->pasajeestandar/3;
						$this->pasajeestandar = round($this->pasajeestandar, 2);
									
						return TRUE;
					}
				}	
			}
			//Sábados de las 14 a 22 hs 
			if( date('w', $this->tiempo->time()) == 6 ){
				if( date('H', $this->tiempo->time())>=14 && date('H', $this->tiempo->time())<=22){
					if($this->tiempo->time() - $this->ultviaje < 5400){
					$this->pasajeestandar = $this->pasajeestandar/3;
					$this->pasajeestandar = round($this->pasajeestandar, 2);
					//var_dump($this->pasajeestandar);					

						return TRUE;
					}
				}
			}

			//Domingos de 6 a 22 hs
			elseif( date('w', $this->tiempo->time()) == 0 ){
				if( date('H', $this->tiempo->time())>=6 && date('H', $this->tiempo->time())<=22){
					if($this->tiempo->time() - $this->ultviaje < 5400){
					$this->pasajeestandar = $this->pasajeestandar/3;
					$this->pasajeestandar = round($this->pasajeestandar, 2);
					//var_dump($this->pasajeestandar);					

						return TRUE;
					}
				}
			}

			//Si es de noche entre las 22 y 6
			elseif( date('H', $this->tiempo->time())>=22  || date('H', $this->tiempo->time())<=6){
				if($this->tiempo->time() - $this->ultviaje < 5400){
					$this->pasajeestandar = $this->pasajeestandar/3;
					$this->pasajeestandar = round($this->pasajeestandar, 2);
					
					//var_dump($this->pasajeestandar);					
					return TRUE;
				}
			}

			//Lunes a viernes de 6 a 22 y sábados de 6 a 14 hs
			else {
				if( ($this->tiempo->time() - $this->ultviaje) <= 3600){
					$this->pasajeestandar = $this->pasajeestandar/3;
					$this->pasajeestandar = round($this->pasajeestandar, 2);
					return TRUE;
				}
			}
			return false;		
		}	
	}

	/**
	 * checkUltViajeTrasbordo
	 * Devuelve el ultimo viaje en trasbordo
	 * @return int
	 */
	public function checkUltViajeTrasbordo(){
		return $this->ultviajetrasbordo;
	}

	/**
	 * reducirSaldo
	 * Recude el valor del pasaje del saldo de la tarjeta 
	 * @param  float $valor
	 * @param  int $linea
	 * @param  mixed $bandera
	 *
	 * @return bool
	 */
	public function reducirSaldo($valor, $linea, $bandera){
		$this->pasajeestandar=$valor;
		if($this->checkUltViajeTrasbordo() == FALSE){
			if ($this->checkTrasbordo($linea, $bandera)){
				//Esta bandera se pone true para la proxima vez que intente pagar
				$this->ultviajetrasbordo=TRUE;				
			}
		}
		else{
			$this->ultviajetrasbordo=FALSE;
		}

		if($this->saldo>$valor&& $this->viajep ==0){
			$this->saldo = $this->saldo - $this->pasajeestandar;
			$this->pasaje = $this->pasajeestandar;
			$this->viajesplusquepago= $this->viajep;
			$this->ultviaje = $this->tiempo->time();
		}
		if($this->saldo>$valor&&$this->viajep!==0){
			$this->saldo -= ($valor * ($this->viajep+1));
			$this->pasaje = $valor *($this->viajep+1);
			$this->viajesplusquepago= $this->viajep;
			$this->quitarplus( $this->viajep );
			$this->ultviaje = $this->tiempo->time();
			
		}

		if($this->saldo<$valor && $this->viajep <2){
			$this->plus();
			$this->pasaje =$valor;
			$this->viajesplusquepago = -1;			
			$this->ultviaje = $this->tiempo->time();
		}

		elseif($this->viajep == 2){
			return false;
		}

		$this->ultbandera = $bandera;	
		$this->ultlinea = $linea;

		return true;
	}

	/**
	 * obtenerViajesplus
	 * Devuelve la cantidad de viajes plus
	 * @return int
	 */
	public function obtenerViajesplus(){
		return $this->viajep;
	}

	/**
	 * plus
	 * Suma a la cantidad de viajes plus totales
	 * @return void
	 */
	public function plus(){
		$this->viajep += 1;
	}

	/**
	 * quitarplus
	 * Quita un viaje plus de la cantidad total
	 * @param  int $cantidad
	 *
	 * @return void
	 */
	public function quitarplus($cantidad){
		$this->viajep -= $cantidad;	
	}

	/**
	 * obtenerID
	 * Devuelve el id de la tarjeta
	 * @return int
	 */
	public function obtenerID(){
		return $this->id;
	}

	/**
	 * obtenerViajesplusAbonados
	 * Devuelve la cantidad de viajes plus abonados en un pago
	 * @return int
	 */
	public function obtenerViajesplusAbonados(){
		return $this->viajesplusquepago;
	}

	/**
	 * valordelospasajesplus
	 * Devuelve la cantdad que se abono en viajes plus
	 * @return float
	 */
	public function valordelospasajesplus(){
		if($this->viajesplusquepago>0){
			return $this->pasajeestandar*$this->viajesplusquepago;
		}
		if($this->viajesplusquepago== 0){
			return 0;
		}
		else{
			return -1;
		}
	}
}
