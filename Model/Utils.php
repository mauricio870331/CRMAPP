<?php

class Utils {

    public static function DMY_TO_YMD($str) {
        $parts = explode("/", $str);
        $new = $parts[2] . "-" . $parts[0] . "-" . $parts[1];
        return $new;
    }

    public static function YMD_TO_DMY($str) {
        $parts = explode("-", $str);
        $new = $parts[1] . "/" . $parts[2] . "/" . $parts[0];
        return $new;
    }

    public static function SUM_ONE_MONTH_TO_DATE($month, $day) {
        $fecha = date('Y-m-' . $day);
        $nuevafecha = strtotime('+' . $month . ' month', strtotime($fecha));
        $returnFecha = date('Y-m-' . $day, $nuevafecha);
        return $returnFecha;
    }

    public static function ConvertMontIntToStr($mon,$opc=1) {
        $mes = "";
        switch ($mon) {
            case "01":$mes = "Enero";break;
            case "02":$mes = "Febrero";break;
            case "03":$mes = "Marzo";break;
            case "04":$mes = "Abril";break;
            case "05":$mes = "Mayo";break;
            case "06":$mes = "Junio";break;
            case "07":$mes = "Julio";break;
            case "08":$mes = "Agosto";break;
            case "09":$mes = "Septiembre";break;
            case "10":$mes = "Octubre";break;
            case "11":$mes = "Noviembre";break;
            case "12":$mes = "Diciembre";break;
            default:$mes = "Sin conversion";break;
        }
        return $mes;
    }

}
?>

