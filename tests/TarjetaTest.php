<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class TarjetaTest extends TestCase {

	/*
    /**
     * testCargaSaldo
     * Comprueba que la tarjeta aumenta su saldo cuando se carga saldo válido.
     * @return void
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
     * testCargaSaldoInvalido
     * Comprueba que la tarjeta no puede cargar saldos invalidos.
     * @return void
     */
    public function testCargaSaldoInvalido() {
        $tiempo = new TiempoFalso();
        $tarjeta = new Tarjeta($tiempo);

        $this->assertFalse($tarjeta->recargar(15.0));
        $this->assertEquals($tarjeta->obtenerSaldo(), 0.0);
    }

    /**
     * testMedioSecundarioLimitacionTiempo
     * Comprueba el funcionamiento de la limitacion de tiempo en el medio boleto
     * @return void
     */
    public function testMedioSecundarioLimitacionTiempo(){
        $tiempo = new TiempoFalso();
        $medio = new MedioSecundario( $tiempo );
	$medio2 = new MedioSecundario( $tiempo );
        $medio->recargar(100.0);

        $medio->reducirSaldo(14.80, 'a', 1);
        $this->assertFalse($medio->reducirSaldo(14.80, 'a', 1));
    }

    /**
     * testMedioUniversitarioLimitacionDia
     *  Comprueba el funcionamiento de la limitacion de tiempo en el medio boleto universitario
     * @return void
     */
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
	$tiempo->avanzar(86400);
	$this->assertEquals( $colectivo->pagarCon($medio)->obtenerValor(), 14.80 );

    }	
	
	public function testTrasbordo(){
		$tiempo = new TiempoFalso();
        $tarjeta = new Tarjeta($tiempo); // miercoles 0:00 pm

        $this->assertEquals(date("w", $tiempo->time()), 4);
        $this->assertEquals(date("H", $tiempo->time()), 0);

	$colectivo = new Colectivo('a', 'a', 1);
        $colectivo2 = new Colectivo('b', 'b', 2);
         
        $tarjeta->recargar(100);		
        
        $this->assertEquals($colectivo->pagarCon($tarjeta)->obtenerValor(),14.8);

        $tiempo->avanzar(3000);

	$this->assertEquals(date("w", $tiempo->time()), 4);
        $this->assertEquals(date("H", $tiempo->time()), 0);

        $this->assertEquals($colectivo2->pagarCon($tarjeta)->obtenerValor(),4.93);

        $tiempo->avanzar(21200);
        
        $colectivo->pagarCon($tarjeta);

        $this->assertEquals($colectivo->pagarCon($tarjeta)->obtenerValor(),14.8);
    }

	public function testTrasbordosabado(){
	$tiempo = new TiempoFalso();
        $tarjeta = new Tarjeta($tiempo); // miercoles 0:00 pm

        $this->assertEquals(date("w", $tiempo->time()), 4);
        $this->assertEquals(date("H", $tiempo->time()), 0);

	$colectivo = new Colectivo('a', 'a', 1);
        $colectivo2 = new Colectivo('b', 'b', 2);
        $tarjeta->recargar(100);		
        $tiempo->avanzar(225800);
        $this->assertEquals($colectivo->pagarCon($tarjeta)->obtenerValor(),14.8);
	$this->assertEquals(date("w", $tiempo->time()), 6);
        $this->assertEquals(date("H", $tiempo->time()), 14);
	$tiempo->avanzar(2200);
	$this->assertEquals(date("w", $tiempo->time()), 6);
        $this->assertEquals(date("H", $tiempo->time()), 14);
        
        $this->assertEquals($colectivo2->pagarCon($tarjeta)->obtenerValor(),4.93);
   
    }

	public function testTrasbordodomingo(){
		$tiempo = new TiempoFalso();
		$tarjeta = new Tarjeta($tiempo); // miercoles 0:00 pm

		$this->assertEquals(date("w", $tiempo->time()), 4);
		$this->assertEquals(date("H", $tiempo->time()), 0);

		$colectivo = new Colectivo('a', 'a', 1);
		$colectivo2 = new Colectivo('b', 'b', 2);
		$tarjeta->recargar(100);		
		$tiempo->avanzar(311800);
		$this->assertEquals($colectivo->pagarCon($tarjeta)->obtenerValor(),14.8);
		$this->assertEquals(date("w", $tiempo->time()), 0);
		$this->assertEquals(date("H", $tiempo->time()), 14);
                $tiempo->avanzar(2200);
		$this->assertEquals(date("w", $tiempo->time()), 0);
		$this->assertEquals(date("H", $tiempo->time()), 14);
		$this->assertEquals($colectivo2->pagarCon($tarjeta)->obtenerValor(),4.93);
	    }
            public function testTrasbordodia(){
                $tiempo = new TiempoFalso();
		$tarjeta = new Tarjeta($tiempo); // miercoles 0:00 pm
                $tiempo->avanzar(54000);
		$this->assertEquals(date("w", $tiempo->time()), 4);
		$this->assertEquals(date("H", $tiempo->time()), 15);
		$colectivo = new Colectivo('a', 'a', 1);
		$colectivo2 = new Colectivo('b', 'b', 2);
		$tarjeta->recargar(100);		
                $this->assertEquals($colectivo->pagarCon($tarjeta)->obtenerValor(),14.8);
                $tiempo->avanzar(2400);	
                $this->assertEquals(date("w", $tiempo->time()), 4);
		$this->assertEquals(date("H", $tiempo->time()), 15);	
                $this->assertEquals($colectivo->pagarCon($tarjeta)->obtenerValor(),4.93);
            }	
			
		
     /**
     * testJubilados
     * Comprueba el funcionamiento de la tarjeta de jubilados
     * @return void
     */
    public function testJubilados(){
        $tiempo = new TiempoFalso();
	$valor=420.0;
        $jubi =new Jubilados($tiempo);

        $this->assertEquals( $jubi->valorpasaje(), 0);
        $this->assertTrue($jubi->reducirSaldo($valor, NULL, NULL));
	}
}
