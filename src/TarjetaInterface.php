<?php

namespace TrabajoTarjeta;

interface TarjetaInterface {

    /**
     * Recarga una tarjeta con un cierto valor de dinero.
     *
     * @param float $monto
     *
     * @return bool
     *   Devuelve TRUE si el monto a cargar es válido, o FALSE en caso de que no
     *   sea valido.
     */
    public function recargar($monto);

    /**
	 * obtenerTiempo
	 *
	 * @return int
	 */
	public function obtenerTiempo();
    
    /**
     * Devuelve el saldo que le queda a la tarjeta.
     *
     * @return float
     */
    public function obtenerSaldo();

    /**
	 * valorpasaje
	 * Devuelve cuanto salio el pasaje que pago
	 * @return float
	 */
    public function valorpasaje();

    /**
	 * checkTrasbordo
	 * Devuelve si se puede usar el trasbordo o no
	 * @param  int $linea
	 * @param  mixed $bandera
	 *
	 * @return bool
	 */
    public function checkTrasbordo($linea, $bandera);
    
    
    /**
	 * reducirSaldo
	 * Recude el valor del pasaje del saldo de la tarjeta 
	 * @param  float $valor
	 * @param  int $linea
	 * @param  mixed $bandera
	 *
	 * @return void
	 */
    public function reducirSaldo($valor, $linea, $bandera);
    
    /**
	 * obtenerViajesplus
	 * Devuelve la cantidad de viajes plus
	 * @return int
	 */
    public function obtenerViajesplus();
    
    /**
	 * plus
	 * Suma a la cantidad de viajes plus totales
	 * @return void
	 */
    public function plus();
    
    /**
	 * quitarplus
	 * Quita un viaje plus de la cantidad total
	 * @param  int $cantidad
	 *
	 * @return void
	 */
    public function quitarplus($cantidad);
    
    /**
	 * obtenerID
	 * Devuelve el id de la tarjeta
	 * @return int
	 */
    public function obtenerID();
    
    /**
	 * obtenerViajesplusAbonados
	 * Devuelve la cantidad de viajes plus abonados en un pago
	 * @return int
	 */
    public function obtenerViajesplusAbonados();
    
    /**
	 * valordelospasajesplus
	 * Devuelve la cantdad que se abono en viajes plus
	 * @return float
	 */
	public function valordelospasajesplus();
	

}
