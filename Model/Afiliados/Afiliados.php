<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Afiliados
 *
 * @author Usuario
 */
require 'Afiliados/DatosAfiliado.php';

class Afiliados {

    private $id_afiliado;
    private $tipo_doc;
    private $documento;
    private $nombres;
    private $apellidos;
    private $nombre_completo;
    private $genero;
    private $foto;
    private $extension;
    private $create_by;
    private $lugar_expedi_doc;
    private $fecha_exp_doc;
    private $create_at;
    private $DatosAfiliado;

    public function __construct() {
        $this->DatosAfiliado = new DatosAfiliado();
    }

    //Metodos Getter
    public function getIdAfiliate() {
        return $this->id_afiliado;
    }

    public function getTipoDoc() {
        return $this->tipo_doc;
    }

    public function getDocumento() {
        return $this->documento;
    }

    public function getNombres() {
        return $this->nombres;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getNombreCompleto() {
        return $this->nombre_completo;
    }

    public function getGenero() {
        return $this->genero;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function getExtension() {
        return $this->extension;
    }

    public function getCreateBy() {
        return $this->create_by;
    }

    public function getLugarExpedicionDoc() {
        return $this->lugar_expedi_doc;
    }

    public function getFechaExpedicionDoc() {
        return $this->fecha_exp_doc;
    }

    public function getCreatedAt() {
        return $this->create_at;
    }

    public function getDatosAfiliado() {
        return $this->DatosAfiliado;
    }

    //Metodos setter
    public function setIdAfiliate($idafiliado) {
        $this->id_afiliado = $idafiliado;
    }

    public function setTipoDoc($tipo_doc) {
        $this->tipo_doc = $tipo_doc;
    }

    public function setDocumento($documento) {
        $this->documento = $documento;
    }

    public function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function setNombreCompleto($nombre_completo) {
        $this->nombre_completo = $nombre_completo;
    }

    public function setGenero($genero) {
        $this->genero = $genero;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function setExtension($extension) {
        $this->extension = $extension;
    }

    public function setCreateBy($create_by) {
        $this->create_by = $create_by;
    }

    public function setLugarExpedicionDoc($lugar_expedi_doc) {
        $this->lugar_expedi_doc = $lugar_expedi_doc;
    }

    public function setFechaExpedicionDoc($fecha_exp_doc) {
        $this->fecha_exp_doc = $fecha_exp_doc;
    }

    public function setCreatedAt($create_at) {
        $this->create_at = $create_at;
    }

    public function setDatosAfiliado($DatosAfiliado) {
        return $this->DatosAfiliado = $DatosAfiliado;
    }

}
