<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class ColectivoTest extends TestCase {

    /**
     * testConSaldo
     * Testea que se pueda pagar un boleto con la tarjeta si es que tiene saldo la tarjeta
     * @return void
     */
    public function testConSaldo() {
        $tiempo = new TiempoFalso();
        $colectivo = new Colectivo('a', 'a', 1);
        $tarjeta = new Tarjeta( $tiempo );
        $tarjeta->recargar(100.0);

        $boleto = $colectivo->pagarCon($tarjeta);
	$this->assertEquals($boleto->obtenerValor(),14.8);
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

    /**
     * testSinSaldo
     * Testea que se pueda pagar un boleto con una tarjeta que no tiene saldo, pero solo hasta 2 viajes plus y que luego
     * no le deje pagar mas
     * @return void
     */
    public function testSinSaldo() {
        $tiempo = new TiempoFalso();

        $colectivo = new Colectivo(NULL, NULL, NULL);
        $tarjeta = new Tarjeta($tiempo);
        $medio = new MedioSecundario($tiempo);
        $mediouni = new MedioUniversitario($tiempo);


        $boleto = new Boleto(14.80, $colectivo, $tarjeta, $tarjeta->obtenerID(), $colectivo->linea(), get_class($tarjeta),-1, -1, $tiempo);
        $this->assertEquals( $colectivo->pagarCon($tarjeta) , $boleto);
	$colectivo->pagarCon($tarjeta);
        $tarjeta->recargar(100.0);
	$boleto2=$colectivo->pagarCon($tarjeta);
 	$this->assertEquals($boleto2->obtenerValor(),44.4);
        $this->assertEquals($boleto2->obtenersaldo(),55.6);
	$this->assertEquals($boleto2->viajesplus(),2);
	$this->assertEquals($boleto2->abonadoenviajesplus(),29.6);
	$tarjeta2 = new Tarjeta($tiempo);
        $colectivo->pagarCon($tarjeta2);
	$colectivo->pagarCon($tarjeta2);
        $this->assertFalse($colectivo->pagarCon($tarjeta2));
        $colectivo->pagarCon($mediouni);
        $colectivo->pagarCon($mediouni);
        $this->assertFalse($colectivo->pagarCon($mediouni));
        $colectivo->pagarCon($medio);
        $colectivo->pagarCon($medio);
        $this->assertFalse($colectivo->pagarCon($medio));
    }

	/**
	 * testFuncionesColectivo
	 * Testea que las funciones de muestra de datos del colectivo funcionen correctamente
	 * @return void
	 */
	public function testFuncionesColectivo() {
        $linea=420;
	$empresa="muni";
	$numero=69;
        $colectivo = new Colectivo($linea,$empresa,$numero);
	$this->assertEquals( $colectivo->numero() , $numero);
	$this->assertEquals( $colectivo->empresa() , $empresa);
    }

    /**
     * testTiempo
     * Testea que el objeto de control de tiempo funcione correctamente 
     * @return void
     */
    public function testTiempo(){
        $tiempo = new TiempoReal();
        $tiempo2 = new TiempoFalso();
        $this->assertTrue($tiempo->time()!==null);
        $this->assertEquals($tiempo2->reiniciar(),0);
        }

}
