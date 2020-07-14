<?php

session_start();
date_default_timezone_set('America/Bogota');

require('fpdf.php');
require '../BD.php';

class PDF extends FPDF {

// Cabecera de página
    function Header() {
        $this->Image('images/greenlight.png', 18, 20, 60);
        $this->Image('images/Texto.png', 130, 20, 60);
        $this->SetFont('Arial', 'B', 15);
        $this->Ln(45);
    }

// Pie de página
    function Footer() {
        $this->Image('images/greenlight.png', 170, 279, 30);
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 10);
        // Número de página
//        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        $this->Cell(0, 10, 'www.greenlightsadvisory.com', 0, 0, 'C');
    }
    
    

}

try {

    $to = "Sr(a). " . $_POST['name'];
    $texto = "Con este comunicado, Greenlight Advisory Service LLC quiere brindarle la información sobre los pasos a seguir para asesorarle de acuerdo con sus necesidades específicas, todo nuestro proceso de asesoramiento será estrictamente basado bajo la ley Federal existente para la regulación del crédito. Consumer Credit Protection Act (Ley de protección de crédito del consumidor) encargados de prevenir la discriminación en contra del consumidor a la hora de obtener un préstamo y regula el comportamiento de los Bureaus de Crédito (Equifax, Transunion y Experian). Estas son las entidades encargadas de reportar acreedores y agencias de colección de deudas en el historial de los ciudadanos y residentes de los Estados Unidos.";
    $texto2 = "El proceso que se emprenderá consiste en verificar todas aquellas cuentas que tiene en su reporte para hacer las disputas directamente con los tres Bureaus de crédito sobre aquellas cuentas incorrectas o injustificadas, ya que según el Fair Credit Reportign Act. Todas las marcas negativas incorrectas o injustificadas deben ser corregidas o eliminadas. Y, todas aquellas deudas en colección que sean reales podrán ser negociadas previo acuerdo con las compañías colectoras para que reduzcan un alto porcentaje de su valor inicial, y usted pueda realizar sus pagos y eliminar los balances pendientes. Y así mejorar su puntaje crediticio.";
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times', '', 12);
    $pdf->Cell(10);
    $pdf->Cell(0, 10, date("d/m/Y"), 0, 1);
    $pdf->Ln(3);

    $pdf->Cell(10);
    $pdf->Cell(0, 10, $to, 0, 1);
    $pdf->Ln(5);
    $pdf->Cell(10);
    $pdf->MultiCell(170, 6, utf8_decode($texto), 0, "J");

    $pdf->Ln(5);
    $pdf->Cell(10);
    $pdf->Cell(0, 10, "Consumer Credit Protection Act", 0, 1);
    $pdf->Ln(5);

    $pdf->Cell(10);
    $pdf->Cell(0, 6, "Fair Credit Reporting Act", 0, 1);
    $pdf->Cell(10);
    $pdf->Cell(0, 6, "Fair Credit Billing Act", 0, 1);
    $pdf->Cell(10);
    $pdf->Cell(0, 6, "Fair Debt Collection Practices Act ", 0, 1);
    $pdf->Cell(10);
    $pdf->Cell(0, 6, "Equal Credit Opportunity Act", 0, 1);

    $pdf->Ln(8);
    $pdf->Cell(10);
    $pdf->MultiCell(170, 6, utf8_decode($texto2), 0, "J");

    $pdf->Ln(7);
    $pdf->Cell(10);
    $pdf->Cell(0, 6, "Cordialmente ", 0, 1);
    $pdf->Cell(10);
    $pdf->Cell(0, 6, "Customer Service Dept", 0, 1);
    $pdf->Cell(10);
    $pdf->Cell(0, 6, "GREENLIGHT ADVISORY SERVICE LLC.", 0, 1);
    $pdf->Output("F", $_POST['ss'] . ".pdf");

    $command = "java -jar C:\\\\xampp\\\htdocs\\\CRMAPP\\\Model\\\PDFLibrary\\\dist\\\Mailer.jar " . $_POST['ss'] . "";
    $con = new BD();
    $SQL_INSERT = "INSERT INTO queues (job, exec) "
            . "values ('" . $command . "',0) ";
    $con->exec($SQL_INSERT);

    /*$SQL_INSERT2 = "INSERT INTO notificacion_personas (documento_persona , cod_notificacion, fecha_envio) "
            . "values ('" . $_POST['ss'] . "','C_PRESENTACION', NOW()) ";
    $con->exec($SQL_INSERT2);*/

    $relativaRuta = "../Model/PDFLibrary/";
    $SQL_INSERT3 = "INSERT INTO  documentos (descripcion,ruta, ext, ss_persona, fecha_registro, nombre_archivo, asesor) "
            . "VALUES ('Carta de Presentación','" . $relativaRuta . "' ,'pdf', '" . $_POST['ss'] . "', NOW(), '" . $_POST['ss'] . ".pdf', " . $_SESSION['obj_user'][0]['id'] . ")";

    
    $con->exec($SQL_INSERT3);


    $con->desconectar();
    $response['datalle'] = "Carta enviada";
    $response['token'] = base64_encode($_POST['ss']);
    $response['msg'] = "success";
    echo json_encode($response);
} catch (Exception $exc) {
    $response['datalle'] = $exc->getTraceAsString();
    $response['msg'] = "error";
    echo json_encode($response);
}
?>
