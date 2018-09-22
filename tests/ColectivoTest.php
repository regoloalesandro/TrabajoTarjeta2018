<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class ColectivoTest extends TestCase {

    public function testConSaldo() {
        $tiempo = new TiempoFalso();
        $colectivo = new Colectivo(NULL, NULL, NULL);
        $tarjeta = new Tarjeta( $tiempo );
        $tarjeta->recargar(100.0);

        $boleto = new Boleto(14.80, $colectivo, $tarjeta, $tarjeta->obtenerID(), $colectivo->linea(), get_class($tarjeta), $tarjeta->obtenerViajesplusAbonados(), $tarjeta->valordelospasajesplus(), $tiempo);

        $this->assertEquals( $colectivo->pagarCon($tarjeta) , $boleto);
        
        $medio = new MedioSecundario($tiempo);
        $medio->recargar(100.0);
	    $boleto2 = new Boleto(7.40, $colectivo, $medio, $medio->obtenerID(), $colectivo->linea(), get_class($medio), $medio->obtenerViajesplusAbonados(), $medio->valordelospasajesplus(), $tiempo);
        $this->assertEquals( $colectivo->pagarCon($medio), $boleto2 );
        
        $jubi =new Jubilados($tiempo);
	    $boleto3 = new Boleto (0,$colectivo,$jubi, $jubi->obtenerID(), $colectivo->linea(), get_class($jubi), $jubi->obtenerViajesplusAbonados(), $jubi->valordelospasajesplus(), $tiempo);
        $this->assertEquals( $colectivo->pagarCon($jubi) , $boleto3);
    }

    public function testSinSaldo() {
        $tiempo = new TiempoFalso();

        $colectivo = new Colectivo(NULL, NULL, NULL);
        $tarjeta = new Tarjeta($tiempo);

        $boleto = new Boleto(14.80, $colectivo, $tarjeta, $tarjeta->obtenerID(), $colectivo->linea(), get_class($tarjeta),-1, -1, $tiempo);
        $this->assertEquals( $colectivo->pagarCon($tarjeta) , $boleto);
        $this->assertEquals( $colectivo->pagarCon($tarjeta) , $boleto);

        $tarjeta->recargar(100.0);
        
        $boleto2 = new Boleto(44.4, $colectivo, $tarjeta, $tarjeta->obtenerID(), $colectivo->linea(), get_class($tarjeta), 2, 29.6, $tiempo);
        $this->assertEquals( $colectivo->pagarCon($tarjeta) , $boleto2);
    }
}
