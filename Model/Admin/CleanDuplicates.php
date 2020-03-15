<?php

require_once 'BD.php';
require 'Afiliados/Afiliados.php';

class CleanDuplicates {

    public function __construct() {
        
    }

    public $array = array();
    public $arrayObjectsAfiliates = array();

    public function CleanDuplicados() {
        $con = new BD();
        try {
            $rs = $con->findAll2("SELECT documento, count(documento) cantidad FROM afiliados group by documento HAVING COUNT(documento) > 1");
            $this->getInformation($rs, $con);
            for ($index = 0; $index < count($this->array); $index++) {
                $sql2 = "Delete from datos_afiliado where id_afiliado in (select id_afiliado from afiliados where documento ='" . $this->array[$index] . "') ";
//                echo $sql2;
                $con->exec($sql2);
                $sql2 = "Delete from vehiculos_afiliados where id_afiliado  in (select id_afiliado from afiliados where documento ='" . $this->array[$index] . "') ";
//                echo $sql2;
                $con->exec($sql2);
                $sql = "Delete from afiliados where documento ='" . $this->array[$index] . "'";
//                echo $sql;
                $con->exec($sql);
            }
            $this->creaateAfiliatesCelan();
        } catch (Exception $ex) {
//            echo json_encode('error ' . $ex);
        }
        $con->desconectar();
    }

    public function getInformation($rs, $con) {
        if (count($rs) > 0) {
            for ($i = 0; $i < count($rs); $i++) {
                $rs2 = $con->findAll2("SELECT distinct * from afiliados a, datos_afiliado d where a.id_afiliado = d.id_afiliado and"
                        . " a.documento = '" . $rs[$i]['documento'] . "' limit 1");
                for ($j = 0; $j < count($rs2); $j++) {
                    $this->array[] = $rs2[$j]['documento'];
                    $objectAfiliado = new Afiliados();
                    $objectAfiliado->setIdAfiliate($rs2[$j]['id_afiliado']);
                    $objectAfiliado->setTipoDoc($rs2[$j]['tipo_doc']);
                    $objectAfiliado->setDocumento($rs2[$j]['documento']);
                    $objectAfiliado->setNombres($rs2[$j]['nombres']);
                    $objectAfiliado->setApellidos($rs2[$j]['apellidos']);
                    $objectAfiliado->setNombreCompleto($rs2[$j]['nombre_completo']);
                    $objectAfiliado->setGenero($rs2[$j]['genero']);
                    $objectAfiliado->setFoto($rs2[$j]['foto']);
                    $objectAfiliado->setExtension($rs2[$j]['ext']);
                    $objectAfiliado->setCreateBy($rs2[$j]['create_by']);
                    $objectAfiliado->setLugarExpedicionDoc($rs2[$j]['lugar_expedi_doc']);
                    $objectAfiliado->setFechaExpedicionDoc($rs2[$j]['fecha_exp_doc']);
                    $objectAfiliado->setCreatedAt($rs2[$j]['create_at']);
                    $DatosAfiliado = new DatosAfiliado();
                    $DatosAfiliado->setDireccion($rs2[$j]['direccion']);
                    $DatosAfiliado->setTelefonos($rs2[$j]['telefonos']);
                    $DatosAfiliado->setDepartamento($rs2[$j]['departamento']);
                    $DatosAfiliado->setCiudad_residencia($rs2[$j]['ciudad_residencia']);
                    $DatosAfiliado->setEmail($rs2[$j]['email']);
                    $DatosAfiliado->setDireccion_correo($rs2[$j]['direccion_correo']);
                    $DatosAfiliado->setEstado_vinculo($rs2[$j]['estado_vinculo']);
                    $DatosAfiliado->setEstado_civil($rs2[$j]['estado_civil']);
                    $DatosAfiliado->setFecha_nacimiento($rs2[$j]['fecha_nacimiento']);
                    $DatosAfiliado->setNacionalidad($rs2[$j]['nacionalidad']);
                    $DatosAfiliado->setTurno($rs2[$j]['turno']);
                    $DatosAfiliado->setDiadepago($rs2[$j]['diadepago']);
                    $DatosAfiliado->setFecha_proximo_pago($rs2[$j]['fecha_proximo_pago']);
                    $objectAfiliado->setDatosAfiliado($DatosAfiliado);
                    $this->arrayObjectsAfiliates[] = $objectAfiliado;
                }
            }
//            echo "<pre>";
//            print_r($this->arrayObjectsAfiliates[0]);
        }
    }

    public function creaateAfiliatesCelan() {
        $ruta = "http://localhost/Cordiales/Model/Afiliados/CreateAfiliateResttMethod.php";
        for ($i = 0; $i < count($this->arrayObjectsAfiliates); $i++) {
            $values = "documento=" . $this->arrayObjectsAfiliates[$i]->getDocumento();
            $values .= "&nombres=" . $this->arrayObjectsAfiliates[$i]->getNombres();
            $values .= "&apellidos=" . $this->arrayObjectsAfiliates[$i]->getApellidos();
            $values .= "&genero=" . $this->arrayObjectsAfiliates[$i]->getGenero();
            $values .= "&direccion=" . $this->arrayObjectsAfiliates[$i]->getDatosAfiliado()->getDireccion();
            $values .= "&telefonos=" . $this->arrayObjectsAfiliates[$i]->getDatosAfiliado()->getTelefonos();
            $values .= "&nacimiento=" . $this->arrayObjectsAfiliates[$i]->getDatosAfiliado()->getFecha_nacimiento();
            $values .= "&tipo_doc=" . $this->arrayObjectsAfiliates[$i]->getTipoDoc();
            $values .= "&departamento=" . $this->arrayObjectsAfiliates[$i]->getDatosAfiliado()->getDepartamento();
            $values .= "&ciudad=" . $this->arrayObjectsAfiliates[$i]->getDatosAfiliado()->getCiudad_residencia();
            $values .= "&correspondencia=" . $this->arrayObjectsAfiliates[$i]->getDatosAfiliado()->getDireccion_correo();
            $values .= "&estadocivil=" . $this->arrayObjectsAfiliates[$i]->getDatosAfiliado()->getEstado_civil();
            $values .= "&email=" . $this->arrayObjectsAfiliates[$i]->getDatosAfiliado()->getEmail();
            $values .= "&lugarExpe=" . $this->arrayObjectsAfiliates[$i]->getLugarExpedicionDoc();
            $values .= "&fechExpedicion=" . $this->arrayObjectsAfiliates[$i]->getFechaExpedicionDoc();
            $values .= "&nacionalidad=" . $this->arrayObjectsAfiliates[$i]->getDatosAfiliado()->getNacionalidad();
            $values .= "&turno=" . $this->arrayObjectsAfiliates[$i]->getDatosAfiliado()->getTurno();
            $values .= "&diadepago=" . $this->arrayObjectsAfiliates[$i]->getDatosAfiliado()->getDiadepago();
            $values .= "&foto=" . $this->arrayObjectsAfiliates[$i]->getFoto();
            $values .= "&extension=" . $this->arrayObjectsAfiliates[$i]->getExtension();
            $values .= "&creatBy=" . $this->arrayObjectsAfiliates[$i]->getCreateBy();
            $values .= "&fechaNac=" . $this->arrayObjectsAfiliates[$i]->getDatosAfiliado()->getFecha_nacimiento();
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $ruta);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $values);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $remote_server_output = curl_exec($ch);
            curl_close($ch);
//            print_r($remote_server_output);
        }
    }

}
