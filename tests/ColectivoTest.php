<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class ColectivoTest extends TestCase {

    public function testConSaldo() {
        $colectivo = new Colectivo(NULL, NULL, NULL);
        $tarjeta = new Tarjeta();
        $tarjeta->recargar(100.0);
        $boleto = new Boleto(14.80, $colectivo, $tarjeta);
        $this->assertEquals( $colectivo->pagarCon($tarjeta) , $boleto);
	$medio = new Mediovoleto();
	$medio-recardar(100.0);
	$boleto = new Boleto(7.40, $colectivo, $medio);
    }

    public function testSinSaldo() {
        $colectivo = new Colectivo(NULL, NULL, NULL);
        $tarjeta = new Tarjeta();
	$boleto = new Boleto(14.80, $colectivo, $tarjeta);
	$this->assertEquals( $colectivo->pagarCon($tarjeta) , $boleto);
        $this->assertEquals( $colectivo->pagarCon($tarjeta) , $boleto);
	$tarjeta->recargar(100.0);
	$boleto2= new Boleto(44.4,$colectivo,$tarjeta);
	$this->assertEquals( $colectivo->pagarCon($tarjeta) , $boleto2);
   
    }
}
