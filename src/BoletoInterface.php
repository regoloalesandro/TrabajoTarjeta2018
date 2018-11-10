<?php

namespace TrabajoTarjeta;

interface BoletoInterface {

    /**
     * Devuelve el valor del boleto.
     *
     * @return int
     */
    public function obtenerValor();

    /**
     * Devuelve un objeto que respresenta el colectivo donde se viajó.
     *
     * @return ColectivoInterface
     */
    public function obtenerColectivo();

     /**
     * obtenersaldo
     * Devuelve el saldo que le queda a la tarjeta con la que se abono
     * @return float
     */
    public function obtenersaldo();
   
    /**
     * obtenerLineadelcolectivo
     * Devuelve la lina del colectivo en la que se genero el boleto
     * @return int
     */
    public function obtenerLineadelcolectivo();

     /**
     * obtenertipodetarjeta
     * Devuelve el tipo de la tarjeta con la que pago el boleto
     * @return string
     */
    public function obtenertipodetarjeta();

    /**
     * obteneriID
     * Devuelve la ID de la tarjeta con la que abono
     * @return int
     */
    public function obteneriID();
   
    /**
     * viajesplus
     * Devuelve la cantidad de viajes plus pagados si viajesplus es 1 o 2 significa que pago ademas del boleto, la respectiva cantidad de pluses
     * si es -1 pago con un viaje plus y no con su saldo.
     * @return int
     */
    public function viajesplus();

     /**
     * obtenerfecha
     * Devuelve la fecha en la que secreo el boleto
     * @return int
     */
    public function obtenerfecha();

    /**
     * abonadoenviajesplus
     * Devuelve el total correspondiente abonado en viajes plus ademas del boleto, si es -1 significa que pago con plus
     * @return float
     */
    public function abonadoenviajesplus();
}
