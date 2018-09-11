<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class BoletoTest extends TestCase {

    public function testSaldoCero() {
        $valor = 14.80;
        $boleto = new Boleto($valor, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

        $this->assertEquals($boleto->obtenerValor(), $valor);
    }
    
    public function testObtenerValores() {
        $tiempo = new TiempoFalso();
        
        $linea='Rojo';        
        $empresa='Muni';
        $numero='144';
        
        $colectivo = new Colectivo($linea, $empresa, $numero);
        $tarjeta = new Tarjeta($tiempo);
        $tarjeta->recargar(100.0);
            
        $boleto = $colectivo->pagarCon($tarjeta);
        
        $this->assertEquals($boleto->obtenerColectivo(), $colectivo);
        $this->assertEquals($boleto->obtenersaldo(), 85.2);
        $this->assertEquals($boleto->obtenertipodetarjeta(), 'Tarjeta');
        $this->assertEquals($boleto->obteneriID(), $tarjeta->obtenerID() );
        $this->assertEquals($boleto->viajesplus(), 0);
        $this->assertEquals($boleto->abonadoenviajesplus(), 0);


    }
}
