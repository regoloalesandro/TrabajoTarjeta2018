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

    public function obtenersaldo(){
        return $this->saldo;
    }

    public function obtenerLineadelcolectivo(){
        return $this->Linea;
    }

    public function obtenertipodetarjeta(){
       return $this->tipodetarjeta;
    }

    public function obteneriID(){
        return $this->id; 
    }

    //si viajesplus es 1 o 2 significa que pago ademas del boleto, la respectiva cantidad de pluses
    //si es -1 pago con un viaje plus y no con su saldo.
    public function viajesplus(){
        return $this->viajesplus;
    }

    public function obtenerfecha(){
        return $this->fecha;
    }

    //total correspondiente abonado en viajes plus ademas del boleto, si es -1 significa que pago con plus
    public function abonadoenviajesplus(){
        return $this->abonadoenviajesplus;
    }
}
