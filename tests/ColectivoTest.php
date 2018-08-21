<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class ColectivoTest extends TestCase {

    public function testConSaldo() {
        $colectivo = new Colectivo(NULL, NULL, NULL);
        $valor = 14.80;
        $tarjeta = new Tarjeta();
        $tarjeta->recargar(15.0);
        $boleto = new Boleto(14.80, $colectivo, $tarjeta);

        $this->assertEquals($colectivo->pagarCon($tarjeta), $boleto);
    }

    public function testSinSaldo() {
        $colectivo = new Colectivo(NULL, NULL, NULL);
        $valor = 14.80;
        $tarjeta = new Tarjeta();
        $tarjeta->recargar(5.0);

        $this->assertEquals($colectivo->pagarCon($tarjeta), False);
    }
}
