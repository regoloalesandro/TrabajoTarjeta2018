<?php

namespace TrabajoTarjeta;

class Colectivo implements ColectivoInterface {

    protected $linea;
    protected $empresa;
    protected $numero;
    protected $valorboleto = 14.80;

    /**
     * __construct
     *  La funcion es el constructor de la clase colectivo y le asigna los valores al objeto
     * @param  int $linea
     * @param  string $empresa
     * @param  int $numero
     *
     * @return void
     */
    public function __construct($linea, $empresa, $numero) {
        $this->linea = $linea;
        $this->empresa = $empresa;
        $this->numero = $numero;
    }

    /**
     * linea
     * Devuelve la linea del colectivo
     * @return int
     */
    public function linea() {
        return $this->linea;
    }

    /**
     * empresa
     * Devuleve la empresa del colectivo
     * @return string
     */
    public function empresa() {
        return $this->empresa;
    }

    /**
     * numero
     * Devuelve el numero del colectivo
     * @return int
     */
    public function numero() {
        return $this->numero;
    }

   /**
     * Paga un viaje en el colectivo con una tarjeta en particular.
     *
     * @param TarjetaInterface $tarjeta
     *
     * @return BoletoInterface|FALSE
     *  El boleto generado por el pago del viaje. O FALSE si no hay saldo
     *  suficiente en la tarjeta.
     */
    public function pagarCon(TarjetaInterface $tarjeta){	
		if($tarjeta->reducirSaldo($this->valorboleto, $this->linea(), $this->numero())){
			return new Boleto($tarjeta->valorpasaje(), $this, $tarjeta, $tarjeta->obtenerID(), $this->linea(), get_class($tarjeta), $tarjeta->obtenerViajesplusAbonados(), $tarjeta->valordelospasajesplus(), $tarjeta->obtenerTiempo() );
        }
		else return false;		
    }
}