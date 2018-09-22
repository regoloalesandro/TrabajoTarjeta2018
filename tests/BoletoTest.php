<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class BoletoTest extends TestCase {

    public function testSaldoCero() {
        $valor = 14.80;
        $boleto = new Boleto($valor, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

        $this->assertEquals($boleto->obtenerValor(), $valor);
    }
    public function testLineaLectivo() {
        $linea= 420;

        $colectivo = new Colectivo($linea, NULL, NULL);
        $boleto = new Boleto(NULL, NULL, NULL, NULL, $colectivo ->linea(), NULL, NULL, NULL, NULL);

        $this->assertEquals($boleto->obtenerLineadelcolectivo(), $linea);
    }
    public function testSaldo() {
        $tiempo = new TiempoFalso();
        $tarjeta = new Tarjeta( $tiempo );
        $tarjeta->recargar(100.0);
        $saldo=420;
        $colectivo = new Colectivo(NULL, NULL, NULL);
        $boleto = new Boleto(NULL, NULL, $tarjeta, NULL, NULL, NULL, NULL, NULL, NULL);

        $this->assertEquals($boleto->obtenersaldo(), $saldo);
    }
    public function testfecha() {
        $tiempo = new TiempoFalso();
        $tarjeta = new Tarjeta( $tiempo );
        $colectivo = new Colectivo(NULL, NULL, NULL);
        $boleto = new Boleto(NULL, NULL, $tarjeta, NULL,NULL, NULL, NULL, NULL, $tiempo);

        $this->assertEquals($boleto->obtenerfecha(), $tiempo);
    }
}
