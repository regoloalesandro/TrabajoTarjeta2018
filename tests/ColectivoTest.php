<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class ColectivoTest extends TestCase {

    public function testConSaldo() {
        $tiempo = new TiempoFalso();
        $colectivo = new Colectivo(NULL, NULL, NULL);
        $tarjeta = new Tarjeta( $tiempo );
        $tarjeta->recargar(100.0);

        $boleto = $colectivo->pagarCon($tarjeta);
	$this->assertEquals($boleto2->obtenerValor(),14.8);
        $this->assertEquals($boleto->obtenersaldo(),85.2);
	$this->assertEquals($boleto->viajesplus(),0);
	$this->assertEquals($boleto->abonadoenviajesplus(),0);
        
        $medio = new MedioSecundario($tiempo);
        $medio->recargar(100.0);

	$boleto2 = $colectivo->pagarCon($medio);
	$this->assertEquals($boleto2->obtenerValor(),7.4);
        $this->assertEquals($boleto2->obtenersaldo(),92.6);
	$this->assertEquals($boleto2->viajesplus(),0);
	$this->assertEquals($boleto2->abonadoenviajesplus(),0);
        
        $jubi =new Jubilados($tiempo);
	    $boleto3 = new Boleto ($jubi->valorpasaje(),$colectivo,$jubi, $jubi->obtenerID(), $colectivo->linea(), get_class($jubi), $jubi->obtenerViajesplusAbonados(), $jubi->valordelospasajesplus(), $tiempo);
        $this->assertEquals( $colectivo->pagarCon($jubi) , $boleto3);
	
    }

    public function testSinSaldo() {
        $tiempo = new TiempoFalso();

        $colectivo = new Colectivo(NULL, NULL, NULL);
        $tarjeta = new Tarjeta($tiempo);

        $boleto = new Boleto(14.80, $colectivo, $tarjeta, $tarjeta->obtenerID(), $colectivo->linea(), get_class($tarjeta),-1, -1, $tiempo);
        $this->assertEquals( $colectivo->pagarCon($tarjeta) , $boleto);
        $tarjeta->recargar(100.0);
	$bolate2=$colectivo->pagarCon($tarjeta);
 	$this->assertEquals($boleto2->obtenerValor(),44.4);
        $this->assertEquals($boleto2->obtenersaldo(),55.6);
	$this->assertEquals($boleto2->viajesplus(),2);
	$this->assertEquals($boleto2->abonadoenviajesplus(),29.6);
        $colectivo->pagarCon($tarjeta);
	$colectivo->pagarCon($tarjeta);
	$this->assertFalse($colectivo->pagarCon($tarjeta));
    
    }

	public function testFuncionesColectivo() {
        $linea=420;
	$empresa="muni";
	$numero=69;
        $colectivo = new Colectivo($linea,$empresa,$numero);
	$this->assertEquals( $colectivo->numero() , $numero);
	$this->assertEquals( $colectivo->empresa() , $empresa);
    }
/**
    public function testTiemporeal(){
	 $tiempo = new TiempoReal();
	 $this->assertTrue(isset($tiempo->time());
	}*/
}
