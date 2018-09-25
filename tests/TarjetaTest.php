<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class TarjetaTest extends TestCase {

    /**
     * Comprueba que la tarjeta aumenta su saldo cuando se carga saldo válido.
     */
    public function testCargaSaldo() {
        $tiempo = new TiempoFalso();
        $tarjeta = new Tarjeta($tiempo);
	$tarjeta2 = new Tarjeta($tiempo);
	$this->assertTrue($tarjeta2->recargar(30.0));
        $this->assertEquals($tarjeta2->obtenerSaldo(), 30.0);

        $this->assertTrue($tarjeta->recargar(10.0));
        $this->assertEquals($tarjeta->obtenerSaldo(), 10.0);

        $this->assertTrue($tarjeta->recargar(20.0));
        $this->assertEquals($tarjeta->obtenerSaldo(), 30.0);
	
	$this->assertTrue($tarjeta->recargar(50.0));
        $this->assertEquals($tarjeta->obtenerSaldo(), 80.0);
        $this->assertTrue($tarjeta->recargar(100.0));
        $this->assertEquals($tarjeta->obtenerSaldo(), 180.0);
        $this->assertTrue($tarjeta->recargar(510.15));
        $this->assertEquals($tarjeta->obtenerSaldo(), 772.08);
        $this->assertTrue($tarjeta->recargar(962.59));
        $this->assertEquals($tarjeta->obtenerSaldo(),1956.25);
	
	$this->assertEquals($tarjeta->obtenerViajesplus(),0);
      	$tarjeta->plus();
	$this->assertEquals($tarjeta->obtenerViajesplus(),1);    
      	$tarjeta->plus();
	$this->assertEquals($tarjeta->obtenerViajesplus(),2); 
	}

    /**
     * Comprueba que la tarjeta no puede cargar saldos invalidos.
     */
    public function testCargaSaldoInvalido() {
        $tiempo = new TiempoFalso();
        $tarjeta = new Tarjeta($tiempo);

        $this->assertFalse($tarjeta->recargar(15.0));
        $this->assertEquals($tarjeta->obtenerSaldo(), 0.0);
    }

    public function testMedioSecundarioLimitacionTiempo(){
        $tiempo = new TiempoFalso();
        $medio = new MedioSecundario( $tiempo );
        $medio->recargar(100.0);

        $medio->reducirSaldo(14.80, 'a', 1);
        $this->assertFalse($medio->reducirSaldo(14.80, 'a', 1));
    }

    public function testMedioUniversitarioLimitacionDia(){
        $tiempo = new TiempoFalso();
        $medio = new MedioUniversitario($tiempo);
        $medio->recargar(100.0);

        $colectivo = new Colectivo('a', 'a', 1);
        
        $this->assertEquals( $colectivo->pagarCon($medio)->obtenerValor(), 7.40 );

        $tiempo->avanzar(500);
        $this->assertEquals( $tiempo->time(), 500 );

        $this->assertEquals( $colectivo->pagarCon($medio)->obtenerValor(), 7.40 );

        $tiempo->avanzar(500);

        $this->assertEquals( $colectivo->pagarCon($medio)->obtenerValor(), 14.80 );

    }
    public function testJubilados(){
        $tiempo = new TiempoFalso();
	    $valor=420.0;
        $jubi =new Jubilados($tiempo);

        $this->assertEquals( $jubi->valorpasaje(), 0);
        $this->assertTrue($jubi->reducirSaldo($valor, NULL, NULL));
	}
}
