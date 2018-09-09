<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class ColectivoTest extends TestCase {

    public function testConSaldo() {
        $colectivo = new Colectivo(NULL, NULL, NULL);
        $tarjeta = new Tarjeta();
        $tarjeta->recargar(100.0);

        $boleto = new Boleto(14.80, $colectivo, $tarjeta, $tarjeta->obtenerID(), $colectivo->linea(), get_class($tarjeta), $tarjeta->obtenerViajesplusAbonados(), $tarjeta->valordelospasajesplus(), date("d/m/Y H:i", time()));

        $this->assertEquals( $colectivo->pagarCon($tarjeta) , $boleto);
        
        $medio = new Medioboleto();
        $medio->recargar(100.0);
	$boleto2 = new Boleto(7.40, $colectivo, $medio, $medio->obtenerID(), $colectivo->linea(), get_class($medio), $medio->obtenerViajesplusAbonados(), $medio->valordelospasajesplus(), date("d/m/Y H:i", time()));
        $this->assertEquals( $colectivo->pagarCon($medio) , $boleto2);
        
        $jubi =new Jubilados();
	$boleto3 = new Boleto (0,$colectivo,$jubi, $jubi->obtenerID(), $colectivo->linea(), get_class($jubi), $jubi->obtenerViajesplusAbonados(), $jubi->valordelospasajesplus(), date("d/m/Y H:i", time()));
        $this->assertEquals( $colectivo->pagarCon($jubi) , $boleto3);
    }

    public function testSinSaldo() {
        $colectivo = new Colectivo(NULL, NULL, NULL);

        $tarjeta = new Tarjeta();

        $boleto = new Boleto(14.80, $colectivo, $tarjeta, $tarjeta->obtenerID(), $colectivo->linea(), get_class($tarjeta), $tarjeta->obtenerViajesplusAbonados(), $tarjeta->valordelospasajesplus(), date("d/m/Y H:i", time()));
	$this->assertEquals( $colectivo->pagarCon($tarjeta) , $boleto);
        $this->assertEquals( $colectivo->pagarCon($tarjeta) , $boleto);

        $tarjeta->recargar(100.0);
        
        $boleto = new Boleto(44.4, $colectivo, $tarjeta, $tarjeta->obtenerID(), $colectivo->linea(), get_class($tarjeta), $tarjeta->obtenerViajesplusAbonados(), $tarjeta->valordelospasajesplus(), date("d/m/Y H:i", time()));
        $this->assertEquals( $colectivo->pagarCon($tarjeta) , $boleto2);
        
	$medio = new Medioboleto();
        $boleto = new Boleto(7.40, $colectivo, $tarjeta, $tarjeta->obtenerID(), $colectivo->linea(), get_class($tarjeta), $tarjeta->obtenerViajesplusAbonados(), $tarjeta->valordelospasajesplus(), date("d/m/Y H:i", time()));
	$this->assertEquals( $colectivo->pagarCon($medio) , $boleto3);
        $this->assertEquals( $colectivo->pagarCon($medio) , $boleto3);
    }
}
