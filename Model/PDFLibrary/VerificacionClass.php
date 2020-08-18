<?php

date_default_timezone_set('America/Bogota');
require('fpdf.php');

class PDF extends FPDF {
    
}

class VerificacionClass {

    public $name;
    public $ss;

    public function __construct() {
        
    }

    public function Generar() {
        try {
            $pdf = new PDF();
            $pdf->AliasNbPages();
            $pdf->AddPage();

            $pdf->Ln(5);

            $pdf->Cell(5);
            $pdf->SetFont('Arial', 'B', 13);
            $pdf->Cell(0, 10, utf8_decode("VERIFICACIÓN"), 0, 1, "C");
            $pdf->Ln(6);

            $pdf->SetTextColor(238, 23, 23);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(10);
            $pdf->MultiCell(170, 6, utf8_decode("Muy buenos días mi nombre es " . $this->name . ". "
                            . "Soy verificador de la COMPAÑÍA GREEN LIGHT ADVISORY SERVICES,  hoy es día " . date("d") . " "
                            . "del mes " . date("m") . " Del año " . date("Y") . ", me autoriza a grabar su voz para los records "
                            . "de la compañía? "), 0, "J");
            $pdf->Ln(4);

            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('Arial', '', 11);
            $pdf->Cell(10);
            $pdf->Cell(0, 5, utf8_decode("Dígame su nombre y apellido como aparece en su seguro social? "), 0, 1, "J");
            $pdf->Ln(3);

            $pdf->Cell(10);
            $pdf->Cell(0, 5, utf8_decode("Confírmeme un correo @ donde podamos enviar el contrato y la información sobre su proceso."), 0, 1, "J");
            $pdf->Ln(3);

            $pdf->Cell(10);
            $pdf->MultiCell(170, 4, utf8_decode("Señor puede usted imprimir el contrato para que lo diligencie y "
                            . "lo retorne junto con los documentos que le solicitó su asesor que son los siguientes:\n\n"
                            . "- Copia del seguro social\n"
                            . "- Copia de la licencia\n"
                            . "- Y dos comprobantes de dirección que estén a su nombre.\n\n"
                            . "Dirección exacta donde desea que "
                            . "le llegue respuesta de los bureaus de crédito"
                            . "\n\n"
                            . "Dígame su número de seguro social.."
                            . "\n\n"
                            . "Confírmeme la fecha de nacimiento empezando por el mes Números telefónicos donde nos "
                            . "podamos contactar con usted"
                            . "\n\nEs importante que escuche lo siguiente..."), 0, "J");
            $pdf->Ln(3);

            $pdf->Cell(10);
            $pdf->MultiCell(170, 4, utf8_decode("Usted acaba de ingresar al programa de asesoría para la recuperación "
                            . "de su crédito, donde vamos a disputar todas las marcas negativas injustificadas causadas "
                            . "bien sea por robo de identidad, duplicación de cuentas, renovación ilegal de cuentas después "
                            . "de su fecha de expiración y demás que estén afectando el estado actual de su reporte de crédito."
                            . "\n\n"
                            . "Es muy importante que tenga claro que cualquier marca negativa justificada podrá mejorarse "
                            . "gracias a los programas complementarios como es la negociación o haciendo acuerdos especiales "
                            . "con los acreedores."
                            . "\n\n"
                            . "POR LEY FEDERAL DE LOS ESTADOS UNIDOS Y DE PUERTO RICO USTED TIENE (3) DIAS HABILES DESPUES "
                            . "DE HABER RECIBIDO EL CONTRATO PARA ANULAR O CANCELAR LA ASESORIA SIN NINGUNA PENALIDAD,"
                            . " EN CASO DE QUE USTED DECIDA TOMAR ESTA DECISIÓN DEBERA ENVIARNOS VIA E-MAIL UNA NOTIFICACION "
                            . "POR ESCRITO INCLUYENDO SU NOMBRE Y NUMERO DE SEGURO SOCIAL."
                            . "\n\n"
                            . "Comprende los derechos que tiene por ingresar a la CIA?"
                            . "\n\n"
                            . "SR O SRA... Tengo en el sistema que nos está autorizando a"
                            . " GREEN LIGHT ADVISORY SERVICES para realizar cobros electrónicos de su cuenta de cheques o de"
                            . " ahorros por favor dígame la cantidad y la fecha especificando día mes y año para la cual nos"
                            . " autoriza a hacer los cobros."
                            . "\n\n"
                            . "ME CONFIRMA EL NOMBRE DEL BANCO, NOMBRE DEL TITULAR,"
                            . "\n"
                            . "NUMERO DE RUTA, NUMERO DE CUENTA."
                            . "\n\n"
                            . "SR O SRA .... Cuál es el motivo por el que Ud desea reparar su crédito?"
                            . "\nPara obtener un crédito grande como lo son créditos de casa o carro o simplemente para tenerlo bien ante"
                            . "cualquier emergencia."
                            . "\n\n"
                            . "El día de hoy le van hacer una llamada del departamento de  "
                            . "bienvenida como cortesía de la compañía a qué hora le queda bien que le llamen."
                            . "\n\n"
                            . "Para  GREEN LIGHT ADVISORY SERVICES es un placer asesorarle y ayudarle en la recuperación de "
                            . "su crédito si tiene algún amigo o familiar que le podamos ayudar no dude en referirlo "
                            . "con su analista financiero (a) ... con esto finalizamos el proceso de verificación "
                            . "hoy, dia" . date("d") . " del mes " . date("m") . ""
                            . " del año " . date("Y") . " que tenga un excelente día."), 0, "J");
            $pdf->Ln(4);

            //F para guardar, I para mostrar
            $pdf->Output("F", "../../Documentos/" . $this->ss . "/Verificacion_" . $this->ss . ".pdf");

            $response['datalle'] = "Carta enviada";
            $response['token'] = base64_encode($this->ss);
            $response['msg'] = "success";
            return json_encode($response);
        } catch (Exception $exc) {
            $response['datalle'] = $exc->getTraceAsString();
            $response['msg'] = "error";
            return json_encode($response);
        }
    }

}
?>
