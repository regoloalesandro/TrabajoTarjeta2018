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
	
	protected $ultviaje = -300;
	protected $ultviajetrasbordo = FALSE;
	protected $ultlinea;
	protected $ultbandera;

	public function __construct($time) {
		$this->saldo = 0.0;
		$this->tiempo = $time;
    }

	public function obtenerTiempo(){
		return $this->tiempo;
	}

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
	public function valorpasaje(){
		return $this->pasaje;
	}

	public function checkTrasbordo($linea, $bandera){
		if($this->ultlinea == $linea && $this->ultbandera == $bandera){
			return FALSE;
		}

		else{		
			//Sábados de las 14 a 22 hs 
			if( date('w', $this->obtenerTiempo()) == 6 ){
				if( date('H', $this->obtenerTiempo())>=14 || date('H', $this->obtenerTiempo())<=22){
					if($this->obtenerTiempo() - $this->ultviaje < 5400){
						return TRUE;
					}
				}
			}

			//Domingos de 6 a 22 hs
			elseif( date('w', $this->obtenerTiempo()) == 0 ){
				if( date('H', $this->obtenerTiempo())>=6 || date('H', $this->obtenerTiempo())<=22){
					if($this->obtenerTiempo() - $this->ultviaje < 5400){
						return TRUE;
					}
				}
			}

			//Si es de noche entre las 22 y 6
			elseif( date('H', $this->obtenerTiempo())>=22 || date('H', $this->obtenerTiempo())<=6){
				if($this->obtenerTiempo() - $this->ultviaje < 5400){
					return TRUE;
				}
			}

			//Lunes a viernes de 6 a 22 y sábados de 6 a 14 hs
			else{
				if($this->obtenerTiempo() - $this->ultviaje < 3600){
					return TRUE;
				}
			}

		}
	}

	public function checkUltViajeTrasbordo(){
		return $this->ultviajetrasbordo;
	}

	public function reducirSaldo($valor, $linea, $bandera){
		$this->pasajeestandar=$valor;

		if($this->checkUltViajeTrasbordo() == FALSE){
			if ($this->checkTrasbordo($linea, $bandera)) $valor/=3;
			
			if($this->pasajeestandar != $valor){
				$this->ultviajetrasbordo=TRUE;
			}
		}
		else{
			$this->ultviajetrasbordo=FALSE;
		}
		


		if($this->saldo>$valor&& $this->viajep ==0){
			$this->saldo = $this->saldo - $valor;
			$this->pasaje = $valor;
			$this->viajesplusquepago= $this->viajep;
		}
		if($this->saldo>$valor&&$this->viajep!==0){
			$this->saldo -= ($valor * ($this->viajep+1));
			$this->pasaje = $valor *($this->viajep+1);
			$this->viajesplusquepago= $this->viajep;
			$this->quitarplus( $this->viajep );
			
		}

		if($this->saldo<$valor && $this->viajep <2){
			$this->plus();
			$this->pasaje =$valor;
			$this->viajesplusquepago = -1;			
		}

		elseif($this->viajep == 2){
			return false;
		}

		return true;
	}

	public function obtenerViajesplus(){
		return $this->viajep;
	}

	public function plus(){
		$this->viajep += 1;
	}

	public function quitarplus($cantidad){
		$this->viajep -= $cantidad;	
	}

	public function obtenerID(){
		return $this->id;
	}

	public function obtenerViajesplusAbonados(){
		return $this->viajesplusquepago;
	}

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
