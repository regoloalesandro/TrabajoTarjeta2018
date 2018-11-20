<?php

namespace TrabajoTarjeta;

class TiempoFalso implements TiempoInterface{
    protected $time;

    /**
     * __construct
     * Crea el objeto Tiempo falso y le asigna valores iniciales
     * @param  int $inicio
     *
     * @return void
     */
    public function __construct($inicio = 0){
        $this->time = $inicio;
    } 

    /**
     * avanzar
     * hace avanzar el tiempo del objeto
     * @param  int $segundos
     *
     * @return void
     */
    public function avanzar($segundos){
        $this->time += $segundos;
    }

    /**
     * time
     * devuelve el tiempo que lleva adentro
     * @return int
     */
    public function time(){
        return $this->time;
    }

    /**
     * reiniciar
     * devuelve el tiempo a 0
     * @return void
     */
    public function reiniciar(){
        $this->time = 0;
    }
    /**
     * checkFeriado Verifica si la fecha del dia es un feriado dentro de la lista 
     *
     * @return void
     */
	public function checkFeriado(){
        $fecha = date('d-m', $this->time);
        $feriados = array(
            '01-01', //  Año Nuevo
            '24-03', //  Día Nacional de la Memoria por la Verdad y la Justicia.
            '02-04', //  Día del Veterano y de los Caídos en la Guerra de Malvinas.
            '01-05', //  Día del trabajador.
            '25-05', //  Día de la Revolución de Mayo.
            '17-06', //  Día Paso a la Inmortalidad del General Martín Miguel de Güemes.
            '20-06', //  Día Paso a la Inmortalidad del General Manuel Belgrano. F
            '09-07', //  Día de la Independencia.
            '17-08', //  Paso a la Inmortalidad del Gral. José de San Martín
            '12-10', //  Día del Respeto a la Diversidad Cultural
            '20-11', //  Día de la Soberanía Nacional
            '08-12', //  Inmaculada Concepción de María
            '25-12', //  Navidad
        );
        return in_array($fecha, $feriados);
    }
}
