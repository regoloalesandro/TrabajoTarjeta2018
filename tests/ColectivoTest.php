<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class ColectivoTest extends TestCase {

    public function testConSaldo() {
        $tiempo = new TiempoFalso(1000);
        $colectivo = new Colectivo(NULL, NULL, NULL);
        $tarjeta = new Tarjeta($tiempo->time());
        $tarjeta->recargar(100.0);

        $boleto = new Boleto(14.80, $colectivo, $tarjeta, $tarjeta->obtenerID(), $colectivo->linea(), get_class($tarjeta), $tarjeta->obtenerViajesplusAbonados(), $tarjeta->valordelospasajesplus(), date("d/m/Y H:i", $tiempo->time()));

        $this->assertEquals( $colectivo->pagarCon($tarjeta) , $boleto);
        
        $medio = new Medioboleto($tiempo->time());
        $medio->recargar(100.0);
	    $boleto2 = new Boleto(7.40, $colectivo, $medio, $medio->obtenerID(), $colectivo->linea(), get_class($medio), $medio->obtenerViajesplusAbonados(), $medio->valordelospasajesplus(), date("d/m/Y H:i", $tiempo->time()));
        $this->assertEquals( $colectivo->pagarCon($medio) , $boleto2);
        
        $jubi =new Jubilados($tiempo->time());
	    $boleto3 = new Boleto (0,$colectivo,$jubi, $jubi->obtenerID(), $colectivo->linea(), get_class($jubi), $jubi->obtenerViajesplusAbonados(), $jubi->valordelospasajesplus(), date("d/m/Y H:i", $tiempo->time()));
        $this->assertEquals( $colectivo->pagarCon($jubi) , $boleto3);
    }

    public function testSinSaldo() {
        $tiempo = new TiempoFalso();

        $colectivo = new Colectivo(NULL, NULL, NULL);
        $tarjeta = new Tarjeta($tiempo->time());

        $boleto = new Boleto(14.80, $colectivo, $tarjeta, $tarjeta->obtenerID(), $colectivo->linea(), get_class($tarjeta),-1, -1, date("d/m/Y H:i", $tiempo->time()));
        $this->assertEquals( $colectivo->pagarCon($tarjeta) , $boleto);
        $this->assertEquals( $colectivo->pagarCon($tarjeta) , $boleto);

        $tarjeta->recargar(100.0);
        
        $boleto2 = new Boleto(44.4, $colectivo, $tarjeta, $tarjeta->obtenerID(), $colectivo->linea(), get_class($tarjeta), 2, 29.6, date("d/m/Y H:i", $tiempo->time()));
        $this->assertEquals( $colectivo->pagarCon($tarjeta) , $boleto2);
    }
}
