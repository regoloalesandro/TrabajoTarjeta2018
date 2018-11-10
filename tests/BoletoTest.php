<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class BoletoTest extends TestCase {

    /**
     * testSaldoCero
     * Testea que se pueda obtener el valor del boleto
     * @return void
     */
    public function testSaldoCero() {
        $valor = 14.80;
        $tiempo = new TiempoFalso();
        $tarjeta = new Tarjeta( $tiempo );
        $boleto = new Boleto($valor, NULL, $tarjeta, NULL, NULL, NULL, NULL, NULL, NULL);

        $this->assertEquals($boleto->obtenerValor(), $valor);
    }
    /**
     * testLineaLectivo
     * Testea que se pueda obtener la linea del colectivo en la que se genero el boleto
     * @return void
     */
    public function testLineaLectivo() {
        $linea= 420;
        $tiempo = new TiempoFalso();
        $tarjeta = new Tarjeta( $tiempo );
        $colectivo = new Colectivo($linea, NULL, NULL);
        $boleto = new Boleto(NULL, NULL, $tarjeta, NULL, $colectivo ->linea(), NULL, NULL, NULL, NULL);

        $this->assertEquals($boleto->obtenerLineadelcolectivo(), $linea);
    }
    /**
     * testSaldo
     * Testea que se pueda ver el saldo restante de la tarjeta con la que abono
     * @return void
     */
    public function testSaldo() {
        $tiempo = new TiempoFalso();
        $tarjeta = new Tarjeta( $tiempo );
        $tarjeta->recargar(100.0);
        $saldo=100.0;
        $boleto = new Boleto(NULL, NULL, $tarjeta, NULL, NULL, NULL, NULL, NULL, NULL);

        $this->assertEquals($boleto->obtenersaldo(), $saldo);
    }
    /**
     * testfecha
     * Testea que se pueda ver a que hora se abono el boleto
     * @return void
     */
    public function testfecha() {
        $tiempo = new TiempoFalso();
        $tarjeta = new Tarjeta( $tiempo );
        $colectivo = new Colectivo(NULL, NULL, NULL);
        $boleto = new Boleto(NULL, NULL, $tarjeta, NULL,NULL, NULL, NULL, NULL, $tiempo);

        $this->assertEquals($boleto->obtenerfecha(), $tiempo);
    }
    /**
     * testColectivo
     * testea que se puede ver cual fue el colectivo en la que se genero el boleto
     * @return void
     */
    public function testColectivo() {
        $tiempo = new TiempoFalso();
        $tarjeta = new Tarjeta( $tiempo );
        $colectivo = new Colectivo(NULL, NULL, NULL);
        $boleto = new Boleto(NULL, $colectivo, $tarjeta, NULL,NULL, NULL, NULL, NULL, $tiempo);

        $this->assertEquals($boleto->obtenerColectivo(), $colectivo);
    }
 	/**
 	 * testid
 	 * Testea que se pueda ver el Id de la tarjeta on la que se abono
 	 * @return void
 	 */
 	public function testid() {
        $tiempo = new TiempoFalso();
        $tarjeta = new Tarjeta( $tiempo );
        $colectivo = new Colectivo(NULL, NULL, NULL);
	$id=$tarjeta->obtenerID();
        $boleto = new Boleto(NULL, NULL, $tarjeta, $tarjeta->obtenerID(),NULL, NULL, NULL, NULL, $tiempo);

        $this->assertEquals($boleto->obteneriID(), $id);
    }
	/**
	 * testclase
	 * Testa que se pueda ver cual es la clase de la tarjeta con la que abono
	 * @return void
	 */
	public function testclase() {
        $tiempo = new TiempoFalso();
        $tarjeta = new Tarjeta( $tiempo );
        $colectivo = new Colectivo(NULL, NULL, NULL);
	$id="TrabajoTarjeta\Tarjeta";
        $boleto = new Boleto(NULL, NULL, $tarjeta, NULL, NULL,get_class($tarjeta), NULL, NULL, $tiempo);

        $this->assertEquals($boleto->obtenertipodetarjeta(), $id);
    }
	

}
