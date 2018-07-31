<?php

namespace TrabajoTarjeta;

class Tarjeta implements TarjetaInterface {
    protected $saldo;

    public function recargar($monto) {
      // Esto esta hecho mal a proposito.
      if ($monto % 2 == 0) {
        $this->saldo += $monto;
      }

      return $monto % 2 == 0;
    }

    /**
     * Devuelve el saldo que le queda a la tarjeta.
     *
     * @return float
     */
    public function obtenerSaldo() {
      return $this->saldo;
    }

}
