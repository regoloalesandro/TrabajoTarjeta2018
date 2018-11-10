<?php

namespace TrabajoTarjeta;

class Boleto implements BoletoInterface {

    protected $valor;

    protected $colectivo;

    protected $id;
    
    protected $saldo;

    protected $linea;

    protected $tipodetarjeta;

    protected $viajesplus;

    protected $fecha;

    protected $abonadoenviajesplus;
    

    /**
     * __construct
     * La funcion es el contructur de la clase boleto y asigna los valores a las variables del objeto
     * @param  float $valor valor del boleto
     * @param  ColectivoInterface $colectivo  Elcolectivo donde se genero
     * @param  TarjetaInterface $tarjeta Tarjeta con la que se pago el boleto 
     * @param  int $id id de la tarjeta 
     * @param  int $linea linea del colectivo donde se genereo el boleto
     * @param  string $tipodetarjeta tuipo de la tarjeta con la que se pago el boleto
     * @param  int $viajesplus si se abono con viaje plus o si se pago el viaje con viajes que debia
     * @param  float $abonadoenviajesplus cantidad de dinero abonado en viajes plus
     * @param  int $fecha fecha en la que se creo el boleto
     *
     * @return void
     */
    public function __construct($valor, $colectivo, $tarjeta, $id, $linea, $tipodetarjeta, $viajesplus, $abonadoenviajesplus, $fecha) {
        $this->valor = $valor;
        $this->colectivo = $colectivo;
        $this->tarjeta = $tarjeta;
        $this->id = $id;
        $this->linea = $linea;
        $this->tipodetarjeta = $tipodetarjeta;
        $this->viajesplus = $viajesplus;
        $this->fecha = $fecha;
        $this->abonadoenviajesplus = $abonadoenviajesplus;
        $this->saldo = $tarjeta->obtenerSaldo();
    }

    /**
     * Devuelve el valor del boleto.
     *
     * @return int
     */
    public function obtenerValor() {
        return $this->valor;
    }

    /**
     * Devuelve un objeto que respresenta el colectivo donde se viajó.
     *
     * @return ColectivoInterface
     */
    public function obtenerColectivo() {
        return $this->colectivo;
    }

    /**
     * obtenersaldo
     * Devuelve el saldo que le queda a la tarjeta con la que se abono
     * @return float
     */
    public function obtenersaldo(){
        return $this->saldo;
    }

    /**
     * obtenerLineadelcolectivo
     * Devuelve la lina del colectivo en la que se genero el boleto
     * @return int
     */
    public function obtenerLineadelcolectivo(){
        return $this->linea;
    }
    /**
     * obtenertipodetarjeta
     * Devuelve el tipo de la tarjeta con la que pago el boleto
     * @return string
     */
    public function obtenertipodetarjeta(){
       return $this->tipodetarjeta;
    }

    /**
     * obteneriID
     * Devuelve la ID de la tarjeta con la que abono
     * @return int
     */
    public function obteneriID(){
        return $this->id; 
    }

    
    /**
     * viajesplus
     * Devuelve la cantidad de viajes plus pagados si viajesplus es 1 o 2 significa que pago ademas del boleto, la respectiva cantidad de pluses
     * si es -1 pago con un viaje plus y no con su saldo.
     * @return int
     */
    public function viajesplus(){
        return $this->viajesplus;
    }

    /**
     * obtenerfecha
     * Devuelve la fecha en la que secreo el boleto
     * @return int
     */
    public function obtenerfecha(){
        return $this->fecha;
    }

    /**
     * abonadoenviajesplus
     * Devuelve el total correspondiente abonado en viajes plus ademas del boleto, si es -1 significa que pago con plus
     * @return float
     */
    public function abonadoenviajesplus(){
        return $this->abonadoenviajesplus;
    }
}
