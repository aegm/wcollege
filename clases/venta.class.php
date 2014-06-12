<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
define("SISTEMA", "wc");

class venta {

    private $con;
    private $fecha;
    private $cantidad;

    public function __construct() {
        $this->con = new db();
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function calcularVenta($fechaIni, $fechaFin) {
        $sql = $this->con->consulta("select COUNT(*) from usuarios where fecha_ins BETWEEN '$fechaIni' AND '$fechaFin'");
        if (!$this->con->my_error) {
            $this->setCantidad($cantidad);
        }
        return true;
    }
    
    public function getFecha() {
        return $this->fecha;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

}
