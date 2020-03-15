<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DatosAfiliado
 *
 * @author Usuario
 */
class DatosAfiliado {

    private $id_afiliado;
    private $direccion;
    private $telefonos;
    private $departamento;
    private $ciudad_residencia;
    private $email;
    private $direccion_correo;
    private $estado_vinculo;
    private $estado_civil;
    private $fecha_nacimiento;
    private $nacionalidad;
    private $turno;
    private $diadepago;
    private $fecha_proximo_pago;

    public function __construct() {
        
    }

    //Metodos Getter
    public function getIdAfiliate() {
        return $this->id_afiliado;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getTelefonos() {
        return $this->telefonos;
    }

    public function getDepartamento() {
        return $this->departamento;
    }

    public function getCiudad_residencia() {
        return $this->ciudad_residencia;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getDireccion_correo() {
        return $this->direccion_correo;
    }

    public function getEstado_vinculo() {
        return $this->estado_vinculo;
    }

    public function getEstado_civil() {
        return $this->estado_civil;
    }

    public function getFecha_nacimiento() {
        return $this->fecha_nacimiento;
    }

    public function getNacionalidad() {
        return $this->nacionalidad;
    }

    public function getTurno() {
        return $this->turno;
    }

    public function getDiadepago() {
        return $this->diadepago;
    }

    public function getFecha_proximo_pago() {
        return $this->fecha_proximo_pago;
    }

    //Metodos setter
    public function setIdAfiliate($id_afiliado) {
        $this->id_afiliado = $id_afiliado;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function setTelefonos($telefonos) {
        $this->telefonos = $telefonos;
    }

    public function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }

    public function setCiudad_residencia($ciudad_residencia) {
        $this->ciudad_residencia = $ciudad_residencia;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setDireccion_correo($direccion_correo) {
        $this->direccion_correo = $direccion_correo;
    }

    public function setEstado_vinculo($estado_vinculo) {
        $this->estado_vinculo = $estado_vinculo;
    }

    public function setEstado_civil($estado_civil) {
        $this->estado_civil = $estado_civil;
    }

    public function setFecha_nacimiento($fecha_nacimiento) {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    public function setNacionalidad($nacionalidad) {
        $this->nacionalidad = $nacionalidad;
    }

    public function setTurno($turno) {
        $this->turno = $turno;
    }

    public function setDiadepago($diadepago) {
        $this->diadepago = $diadepago;
    }

    public function setFecha_proximo_pago($fecha_proximo_pago) {
        $this->fecha_proximo_pago = $fecha_proximo_pago;
    }

}
