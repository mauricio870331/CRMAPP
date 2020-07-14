<?php

date_default_timezone_set('America/Bogota');
require('fpdf.php');

class PDF extends FPDF {

// Cabecera de página
    function Header() {
        $this->Image('../PDFLibrary/images/greenlight.png', 18, 20, 60);
        $this->Image('../PDFLibrary/images/Texto.png', 130, 20, 60);
        $this->SetFont('Arial', 'B', 15);
        $this->Ln(46);
    }

// Pie de página
    function Footer() {
        $this->Image('../PDFLibrary/images/greenlight.png', 170, 279, 30);
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 10);
        // Número de página
//        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        $this->Cell(0, 10, 'www.greenlightsadvisory.com', 0, 0, 'C');
    }

}

class BienvenidaClass {

    public $name;
    public $ss;
    public $mail;
    public $direccion;
    public $client_name;
    public $tipo_cuenta;
    public $titular_cuenta;
    public $numero_cuenta;
    public $pagos;
    public $texto = "Buenas tardes me presento mi nombre es xxxxx lo estamos llamando de la compañía GREEN LIGHT  me estoy comunicando correspondiente al proceso que iniciamos para la mejoría de su crédito y confirmarle del envió de la documentación, como tal estamos realizando el envió del contrato que es el documento donde va especificado toda la información del proceso que vamos a realizar y de igual manera todos los datos de la compañía.";
    public $texto2 = "A ese correo electrónico le vamos a enviar la información y también a la dirección postal ";
    public $texto3 = "Sr xxxxx nosotros le estamos enviando el documento como registra su nombre en su seguro social.";
    public $texto4 = "Para que igual verifique el contrato como tal que le  estamos enviando le va a llegar en inglés y en español,"
            . " es importante que usted firme el que está en inglés y que nos lo envié junto con la copia SEGURO SOCIAL, LICENCIA DE CONDUCION Y DOS DOCUMENTOS DONDE REGISTRE SU NOMBRE Y LA DIRECCION para que así mismo pueda recibir las respuestas de los bureas de crédito, ok."
            . "\n\nRecuerde que los documentos que nos envié con la dirección no deben tener más de 2 meses de antigüedad, entre más reciente sean mejor, ok  pueden ser viles o documentos  del banco, ok.";
    public $texto5 = "En el documento va especificado los pagos que usted acordó con su analista indicando que son:";
    public $texto6 = "Para finalizar, los pagos me registran que van a quedar por medio de su cuenta tipo_cuenta, titular titular_cuenta, "
            . "número de cuenta numero_cuenta\n\nEn el contrato que nosotros "
            . "le enviamos, toda esta información va especificada, sin embargo por su seguridad de la cuenta, solamente le van a registrar los 4 últimos números para que usted verifique,"
            . " recuerde enviarnos la documentación ya sea por medio de correo electrónico o física.\n\nSi llega a tener alguna duda o inquietud se comunica para nosotros poderle colaborar, le agradezco mucho,"
            . "bienvenido a la compañía y que tenga un excelente día.";

    public function __construct() {
        
    }

    public function Generar() {
        try {
            $pdf = new PDF();
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(10); //Para espacio a la izquierda
            $pdf->Cell(170, 5, date("d/m/Y"), 0, 1);
            $pdf->Ln(5);

            $pdf->Cell(10);
            $pdf->SetFont('Times', 'B', 15);
            $pdf->Cell(0, 10, "BIENVENIDA", 0, 1);
            $pdf->Ln(5);

            $pdf->SetFont('Times', '', 15);
            $pdf->Cell(10);
            $pdf->MultiCell(170, 6, utf8_decode(str_replace("xxxxx", $this->name, $this->texto)), 0, "J");
            $pdf->Ln(4);

            $pdf->Cell(10);
            $pdf->Cell(0, 10, $this->mail, 0, 1);
            $pdf->Ln(4);

            $pdf->Cell(10);
            $pdf->MultiCell(170, 6, utf8_decode($this->texto2), 0, "J");
            $pdf->Ln(4);


            $pdf->Cell(10);
            $pdf->Cell(0, 10, $this->direccion, 0, 1);
            $pdf->Ln(4);


            $pdf->Cell(10);
            $pdf->MultiCell(170, 6, utf8_decode(str_replace("xxxxx", $this->client_name, $this->texto3)), 0, "J");
            $pdf->Ln(4);

            $pdf->Cell(10);
            $pdf->Cell(0, 10, $this->client_name, 0, 1);
            $pdf->Ln(4);

            $pdf->Cell(10);
            $pdf->MultiCell(170, 6, utf8_decode($this->texto4), 0, "J");
            $pdf->Ln(5);

            $pdf->AddPage();

            $pdf->Ln(3);
            $pdf->Cell(10);
            $pdf->MultiCell(170, 6, utf8_decode($this->texto5), 0, "J");
            $pdf->Ln(4);

            for ($index = 0; $index < count($this->pagos); $index++) {
                $pdf->Cell(20);
                $pdf->Cell(0, 7, " - " . $this->pagos[$index], 0, 1);
            }
            $pdf->Ln(6);
            $texto6_replace = str_replace("tipo_cuenta", $this->tipo_cuenta, $this->texto6);
            $texto6_replace = str_replace("titular_cuenta", $this->titular_cuenta, $texto6_replace);
            $texto6_replace = str_replace("numero_cuenta", $this->numero_cuenta, $texto6_replace);
            $pdf->Cell(10);
            $pdf->MultiCell(170, 6, utf8_decode($texto6_replace), 0, "J");
            $pdf->Ln(4);

            //F para guardar, I para mostrar
            $pdf->Output("F", "../PDFLibrary/Bienvenida_" . $this->ss . ".pdf");

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
