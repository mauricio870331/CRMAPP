<?php

date_default_timezone_set('America/Bogota');
require('fpdf.php');

//echo date("M d, Y");die;

class PDF extends FPDF {

// Cabecera de página
    function Header() {
//                     $file,                                 $x=null, $y=null, $w=0, $h=0, $type='', $link=''
        $this->Image('../PDFLibrary/images/greenlight.png', 15, 12, 45);
        $this->Image('../PDFLibrary/images/Texto.png', 150, 12, 45);
//        $this->SetFont('Arial', 'B', 15);
        $this->Ln(25);
    }

// Pie de página
    function Footer() {
        $this->Image('../PDFLibrary/images/greenlight.png', 170, 279, 25);
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 10);
        // Número de página
//        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        $this->Cell(0, 8, 'www.greenlightsadvisory.com', 0, 0, 'C');
    }

}

class ContratoClass {

    public $id;
    public $name;
    public $ss;
    public $direccion;
    public $pais_ciudad;
    public $client_name;
    public $tipo_cuenta;
    public $titular_cuenta;
    public $numero_cuenta;
    public $numero_ruta;
    public $pagos;
    public $banco;
    public $texto_pag_1 = "La compañía Greenlight Advisory Service LLC le da la"
            . " bienvenida a uno de nuestros programas de ayuda y lo felicita "
            . "por haberle dado la importancia que requiere a su vida crediticia"
            . " y haber tomado la decisión de empezar a hacer ese cambio que su "
            . "vida necesita.\n\n"
            . "Para Greenlight Advisory Service LLC es un placer "
            . "asesorarlo tan ampliamente como sea necesario. "
            . "Con esta comunicación queremos darle a conocer información básica "
            . "sobre el procedimiento de asesoría que brindamos a nuestros clientes"
            . " basándonos en la ley federal existente para la regulación de asuntos"
            . " relacionados con el crédito. Esta ley es el \"Consumer Credit Protection Act\" "
            . "(Ley de protección del crédito del consumidor), que previene la discriminación"
            . " en contra del consumidor a la hora de obtener un préstamo y regula "
            . "el comportamiento de los Bureaus de Crédito que reportan acreedores "
            . "y agencias de colección de deudas en el historial de todas las personas."
            . "\n\n"
            . "El proceso de asesoramiento consiste en verificar todas aquellas cuentas "
            . "que aparecen en su reporte para entablar disputas directamente con los tres"
            . " Bureaus de crédito (Experian, Equifax y Transunion) sobre aquellas cuentas"
            . " incorrectas o injustificadas, ya que, de acuerdo con la Ley de Reporte "
            . "de Crédito Justo, todas las marcas negativas incorrectas o injustificadas"
            . " tienen que ser corregidas o eliminadas. Todas aquellas deudas en colección"
            . " que sean reales serán negociadas previo acuerdo con las compañías colectoras"
            . " para que reduzcan un alto porcentaje de su valor inicial y usted pueda"
            . " realizar sus pagos para eliminar los balances pendientes, mejorando "
            . "con esto su puntaje de crédito que es la finalidad del proceso.\n\n\n\n"
            . "Cordialmente.\n\n\n"
            . "Customer Service Dept.\n"
            . "GREENLIGHT ADVISORY SERVICE LLC";
    public $texto1_pag_2 = "As of today, now it is agreed between Greenlight Advisory "
            . "Service LLC (First Party) and\n"
            . "client_name (Second Party).\n"
            . "In consideration "
            . "of this contract of mutual agreements,these shall be kept and executed by "
            . "both parties respectively as mentioned below.";
    public $clausulas1 = "A) For the non-refundable amount of $400.00 the second party will "
            . "obtain the request and analysis of your credit report and current creditworthiness. "
            . "A plan will be organized where the consumer will be counseled in regards"
            . " of a solution to credit issues, improve credit scores and get back to a better credit history."
            . "\n"
            . "B) Once the accounts are verified, Greenlight will guide the consumer in "
            . "regards of negotiating and obtaining a deal with creditors.\n"
            . "C) Greenlight will counsel the consumer about its rights under the FCRA (The Fair Credit Reporting Act).\n"
            . "D) Greenlight will continue monitoring any improvement consumer’s credit "
            . "report might undergo and the way in which payment agreements and verifications are being made.\n\n"
            . "Your consumer rights:\n\n"
            . "A) The Fair Credit Reporting Act (FCRA) is "
            . "designed to promote accuracy, fairness, and privacy of information "
            . "in the files of every consumer reporting agency (CRA). "
            . "Most CRAs are credit bureaus that gather and sell "
            . "information about you-such as if you pay your bills on time or have filed bankruptcy to "
            . "creditors, employers’ landlords, and other businesses. While true link, Inc. is not a CRA, "
            . "our parent company Transunion, LLC is a CRA. You can find the complete subtext of the FCRA,"
            . " 15 U.S.C. 1681- 1681u, at federal trade commission's web site the FCRA gives you specific"
            . " rights, as outlined below. You may have additional rights under state law. "
            . "You may contact a state or local consumer protection agency or a state attorney general "
            . "to learn those rights. You must be told if information in your file has been used against you. "
            . "Anyone who uses information form a CRA to take action against you, such as denying an "
            . "application for credit, insurance or employment must tell you, and give the name, address, "
            . "and phone number of the CRA that provided the consumer report.";
    public $clausulas2 = "A) The consumer understands and agrees the fees being "
            . "charged are not directly towards credit reparation nor towards fulfilling pending debt,"
            . " but to obtain a general financial analysis of the consumers current credit report and "
            . "to launch a working and consistent plan aimed for overcoming the negative marks in the customer’s"
            . " profile, as well as to obtain and learn how to manage credit.\n"
            . "B) Under such plan the consumer will learn to manage its credit accounts as well as constant counsel and guidance will be provided until the desired goal is accomplished.";
    public $clausulas3 = "III. This agreement shall be binding upon the parties, their successors, "
            . "assigns and personal representatives."
            . " Time is of the essence on all undertakings. This agreement shall be enforced "
            . "Under the laws of the state of Florida. This is the entire agreement.";

    public function __construct() {
        
    }

    // Simple table
    function BasicTable($header, $data, $pdf, $x = 0, $y = 0) {
        // Header
        //$pdf->Cell(30, 7, $col, 1);
        $pdf->setDrawColor(214, 210, 210);
        $pdf->SetY($y);
        $pdf->SetX($x);
        $pdf->MultiCell(40, 7, $header[0], 1, "C");

        $pdf->SetY($y);
        $pdf->SetX($x + 40);
        $pdf->MultiCell(40, 7, $header[1], 1, "C");

//        $pdf->Ln();
        // Data
        $pdf->Cell(38);
        $currentRow = 0;
//        $w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link=''
        foreach ($data as $row) {
            foreach ($row as $col) {
                if ($currentRow == 0) {
                    $pdf->SetX($x);
                    $pdf->Cell(40, 8, $col, 1, 0, "C");
                } else {
                    $pdf->SetX($x + 40);
                    $pdf->Cell(40, 8, "" . $col, 1, 0, "C");
                }
                $currentRow++;
            }
            $currentRow = 0;
            $pdf->Ln();
        }
        $pdf->setDrawColor(0, 0, 0);

        //defaultConfigSignatureClient to 8 rowa
        //ConfigSignatureClient
        $lineG1 = 25;
        $lineG2 = 10;
        $y1y2 = 196;
        $totalrows = count($data);
        if ($totalrows <= 10) {
            for ($index = 1; $index < $totalrows; $index++) {
                $y1y2 += 8;
            }
        } else {

            if ($totalrows == 11) {
                $lineG1 = 20;
                $lineG2 = 10;
                $y1y2 = 271;
            }

            if ($totalrows == 12) {
                $lineG1 = 11;
                $lineG2 = 9;
                $y1y2 = 269;
            }


            if ($totalrows == 13 || $totalrows == 14) {
                for ($index1 = 0; $index1 < 5; $index1++) {
                    $pdf->Cell(0, 5, "", 0, 1);
                    $pdf->Ln();
                }
                $lineG1 = 10;
                $lineG2 = 9;
                $y1y2 = 88;
            }

            if ($totalrows == 15) {
                for ($index1 = 0; $index1 < 4; $index1++) {
                    $pdf->Cell(0, 5, "", 0, 1);
                    $pdf->Ln();
                }
                $lineG1 = 10;
                $lineG2 = 9;
                $y1y2 = 88;
            }


            if ($totalrows == 16) {
                for ($index1 = 0; $index1 < 3; $index1++) {
                    $pdf->Cell(0, 5, "", 0, 1);
                    $pdf->Ln();
                }
                $lineG1 = 10;
                $lineG2 = 9;
                $y1y2 = 88;
            }


            if ($totalrows == 17) {
                for ($index1 = 0; $index1 < 2; $index1++) {
                    $pdf->Cell(0, 5, "", 0, 1);
                    $pdf->Ln();
                }
                $lineG1 = 10;
                $lineG2 = 9;
                $y1y2 = 88;
            }


            if ($totalrows == 18) {
                for ($index1 = 0; $index1 < 1; $index1++) {
                    $pdf->Cell(0, 5, "", 0, 1);
                    $pdf->Ln();
                }
                $lineG1 = 10;
                $lineG2 = 9;
                $y1y2 = 88;
            }

            if ($totalrows == 19) {
                $pdf->Ln();
                $lineG1 = 10;
                $lineG2 = 9;
                $y1y2 = 94;
            }



            if ($totalrows == 20) {
                $pdf->Ln();
                $lineG1 = 10;
                $lineG2 = 9;
                $y1y2 = 102;
            }


            if ($totalrows > 20) {
                $y1y2 = 102;
                $pdf->Ln();
                $lineG1 = 10;
                $lineG2 = 9;
                for ($index1 = 20; $index1 < $totalrows; $index1++) {
                    $y1y2 += 8;
                }
            }
        }


        $pdf->Ln($lineG1);
        $pdf->SetFont('Times', '', 11);
        $pdf->Cell(10);
        $pdf->MultiCell(165, 5, utf8_decode("Bank name: " . $this->banco . "\n"
                        . "Account holder: " . $this->titular_cuenta . "\n"
                        . "Account number: " . $this->numero_cuenta . "\n"
                        . "Routing number: " . $this->numero_ruta), 0, "J");

        $pdf->Ln($lineG2);
        $pdf->Cell(10);
        $pdf->Cell(0, 5, "Client Signature:", 0, 1);
        $pdf->Line(50, $y1y2, 100, $y1y2);
        $pdf->Ln(4);
    }

    public function Generar() {
        try {
            $pdf = new PDF();
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->SetFont('Times', '', 12);
            $pdf->Ln(3);
            $pdf->Cell(5); //Para espacio a la izquierda
            $pdf->Cell(175, 5, date("d/m/Y"), 0, 1);
            $pdf->Ln(5);

            $pdf->Cell(5);
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(0, 6, $this->name, 0, 1);

            $pdf->Cell(5);
            $pdf->Cell(0, 6, $this->direccion, 0, 1);

            $pdf->Cell(5);
            $pdf->Cell(0, 6, $this->pais_ciudad, 0, 1);
            $pdf->Ln(5);

            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(5);
            $pdf->MultiCell(175, 6, utf8_decode($this->texto_pag_1), 0, "J");


            //Pagina 2
            $pdf->AddPage();
            $pdf->SetFont('Times', '', 10);

            $pdf->Cell(5);
            $pdf->MultiCell(175, 4, "GENERAL AGREEMENT CONTRACT", 0, "C");

            $pdf->Cell(5);
            $txt2_page2_replace = str_replace("now", date("M d, Y"), $this->texto1_pag_2);
            $txt2_page2_replace = str_replace("client_name", ucwords(strtolower($this->name)), $txt2_page2_replace);
            $pdf->MultiCell(170, 4, utf8_decode($txt2_page2_replace), 0, "J");
            $pdf->Ln(3);

            $pdf->Cell(5);
            $pdf->MultiCell(175, 4, "I. The first party agrees to:", 0, "J");
            $pdf->Ln(4);

            $pdf->Cell(10);
            $pdf->MultiCell(175, 4, utf8_decode($this->clausulas1), 0, "J");
            $pdf->Ln(4);

            $pdf->Cell(5);
            $pdf->MultiCell(175, 5, "II.  This agreement has been reached between both parties willingly and it is clear that:", 0, "J");
            $pdf->Ln(4);

            $pdf->Cell(10);
            $pdf->MultiCell(165, 5, utf8_decode($this->clausulas2), 0, "J");
            $pdf->Ln(4);

            $pdf->Cell(5);
            $pdf->MultiCell(165, 5, utf8_decode($this->clausulas3), 0, "J");
            $pdf->Ln(4);

            $pdf->Cell(5);
            $pdf->MultiCell(175, 5, "IV. Access to your file is limited:", 0, "J");
            $pdf->Ln(4);

            $pdf->Cell(10);
            $pdf->MultiCell(165, 5, " - " . utf8_decode("A CRA may provide information about you only to people with a need recognized by the FCRA usually to consider an application with a creditor, insurer, employer, landlord, or other business."), 0, "J");
            $pdf->Ln(4);

            $pdf->Cell(10);
            $pdf->MultiCell(165, 5, " - " . utf8_decode("Signed the day and year first, above written.\n   Signed in the presence of:"), 0, "J");
            $pdf->Ln(16);

            $pdf->Line(30, 264, 60, 264);
            $pdf->Line(68, 264, 99, 264);
            $pdf->Line(108, 264, 139, 264);
            $pdf->Line(146, 264, 180, 264);

            $pdf->Cell(5);
            $pdf->Cell(175, 6, "            Witness                       Client Signature                       Date of Birth                      Social Security #", 0, 1, "C");
            // Fin pagina 2            
            //Pagina 2
            $pdf->AddPage();


            $pdf->SetFont('Times', '', 12);
            $pdf->Ln(5);
            $pdf->Cell(72);
            $pdf->Cell(0, 5, utf8_decode("INFORMACIÓN DE PAGOS"), 0, 1);


            $pdf->Cell(77);
            $pdf->SetFont('Times', 'I', 12);
            $pdf->Cell(0, 5, utf8_decode("(Payments information)"), 0, 1);
            $pdf->Ln(13);

            $pdf->SetFont('Times', '', 12);

            $pdf->Cell(10);
            $pdf->MultiCell(165, 5, utf8_decode("A continuación, encontrará relacionada la información correspondiente a"
                            . " los pagos electrónicos programados, que serán debitados de su cuenta según "
                            . "lo acordado telefónicamente por usted y su analista financiero:"), 0, "J");
            $pdf->Ln(5);

            $pdf->SetFont('Times', 'I', 12);
            $pdf->Cell(10);
            $pdf->MultiCell(165, 5, utf8_decode("(As follows you will find the information corresponding to "
                            . "the electronic payments that would be withdrawn from your account in accordance to "
                            . "the phone call that took place with you and your financial analyst.)"), 0, "J");
            $pdf->Ln(5);

            $pdf->SetFont('Times', '', 12);
            $header = array('Payment date (month/day/year)', 'Authorized Amount  (USD)');

//                            $header, $data, $pdf, $x = 0, $y =0
            $this->BasicTable($header, $this->pagos, $pdf, 62, 115);

            // Fin pagina 3
            // 
            //Pagina 4
            $pdf->AddPage();
            $pdf->Ln(5);
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(10);
            $pdf->MultiCell(165, 5, utf8_decode("Name: " . ucwords(strtolower($this->name)) . "\n"
                            . "Miembro ID: " . $this->id . "\n"
                            . "COSTUMER NOTICE"), 0, "J");

            $pdf->Ln(5);
            $pdf->Cell(10);
            $pdf->MultiCell(165, 5, utf8_decode("When Greenlight Advisory Service LLC. Question the information on"
                            . " their personal credit report and tell them specifically why they believe the information is"
                            . " inaccurate or incomplete, they contact the source of the information through an automated "
                            . "verification system or letter. They ask the source to check their records to verify all of the "
                            . "information regarding the item we questioned, and report back within 30 days of the date that we "
                            . "received your request (21 days for Maine residents and 45 days for investigation of information on "
                            . "an annual free credit report). Once they receive the response, they will send their results of "
                            . "the investigation. If they do not receive a response within the required investigation period,"
                            . " they will update the items as we have requested or delete the information; send you / "
                            . "them the results. If we submitted disputes to them, they are contacting the source of the information"
                            . " we questioned. When they complete their investigation process, they will send the client the results."
                            . "\n\nCOSTUMER: will send the application form along with the credit report source and all documentation"
                            . " to Greenlight Advisory Service LLC.\n\n"
                            . "\n\nSincerely\n\n"
                            . "Customer Service Dept.\nGREENLIGHT ADVISORY SERVICE LLC"), 0, "J");
            $pdf->Ln(5);

            // Fin pagina 4
            //pagina 5
            $pdf->AddPage();
            $pdf->Ln(5);
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(10);
            $pdf->MultiCell(165, 5, utf8_decode("Mienbro: " . ucwords(strtolower($this->name)) . "\n"
                            . "Miembro ID: " . $this->id . "\n"
                            . "\nBienvenido a Greenlight Advisory Service LLC! "), 0, "J");

            $pdf->Ln(5);
            $pdf->Cell(10);
            $pdf->MultiCell(165, 5, utf8_decode("Le damos la bienvenida a nuestra campaña donde le queremos brindar"
                            . " todo el asesoramiento necesario para aclarar y actualizar su récord crediticio que como bien"
                            . " sabe es de suma importancia en la vida diaria."
                            . "\n\n"
                            . "Nuestra compañía Greenlight Advisory queremos "
                            . "darle la bienvenida a la campaña donde le brindaremos todo el asesoramiento que su caso requiera"
                            . " para reparar y actualizar su récord crediticio, trabajaremos mano a mano con nuestro "
                            . "cliente y así poder darle el mejor servicio."
                            . "\n\n"
                            . "Nuestra compañía va a verificar cada una "
                            . "de las cuentas negativas que le aparezcan en su reporte de crédito y realizará las "
                            . "disputas que sean necesarias ante los bureaus de crédito, tales como Experian, Equifax, Transunion."
                            . "\n\n\n"
                            . "DOCUMENTACION INDISPENSABLE"
                            . "\n\n"
                            . "Es importante que usted conozca que los 3"
                            . " bureaus de crédito (Experian, Equifax y Transunion) requieren los siguientes documentos"
                            . " para adelantar el proceso de investigación sobre las cuentas y remarcas negativas "
                            . "injustificadas que vamos a entrar a disputar:"), 0, "J");


            $pdf->Ln(5);
            $pdf->Cell(20);
            $pdf->Cell(0, 5, utf8_decode("* Copia AMPLIADA de su tarjeta de seguro social."), 0, 1);

            $pdf->Ln(1);
            $pdf->Cell(20);
            $pdf->Cell(0, 5, utf8_decode("* Copia AMPLIADA de su licencia de conducir."), 0, 1);

            $pdf->Ln(1);
            $pdf->Cell(20);
            $pdf->Cell(0, 5, utf8_decode("* Copia de dos (2) statement donde registre el remitente, su dirección actual y su"), 0, 1);
            $pdf->Ln(1);

            $pdf->Cell(20);
            $pdf->Cell(0, 5, utf8_decode("   nombre; o dos (2) utility bill (recibo de servicios públicos) con dirección actual"), 0, 1);


            $pdf->Ln(1);
            $pdf->Cell(20);
            $pdf->Cell(0, 5, utf8_decode("   que registren a su nombre con fecha no mayor de antigüedad de 2 meses."), 0, 1);


            $pdf->Ln(7);
            $pdf->Cell(10);
            $pdf->MultiCell(165, 5, utf8_decode("Si alguno de los tres bureaus de crédito no recibe esta documentación "
                            . "NO VAN A HACER NINGÚN TIPO DE INVESTIGACIÓN SOBRE SUS REMARCAS NEGATIVAS ya que es necesario "
                            . "para ellos comprobar tanto su dirección como su identidad. Por favor firme el contrato y "
                            . "adjunte estos documentos al momento de regresarlos a nuestra compañía, al correo electrónico "
                            . "admin@greenlightsadvisory.com."
                            . "\n\n"
                            . "Cordialmente;"
                            . "\n\n"
                            . "Customer Service Dept."
                            . "\n"
                            . "GREENLIGHT ADVISORY SERVICE LLC"), 0, "J");


            // Fin pagina 5
            //pagina 6
            $pdf->AddPage();

            $pdf->Ln(7);
            $pdf->Cell(10);
            $pdf->MultiCell(165, 4, utf8_decode("CONTRATO DE ACUERDO GENERAL (TRADUCCIÓN)"), 0, "C");


            $pdf->Ln(7);
            $pdf->Cell(10);
            $pdf->MultiCell(165, 5, utf8_decode("Este acuerdo, hecho hoy en fecha Junio 09 de 2020. "
                            . "Por y entre Greenlight Advisory Service LLC y el señor "
                            . "" . ucwords(strtolower($this->name)) . ". Testifica que en consideración de "
                            . "pactos y acuerdos mutuos deben ser mantenidos y ejecutados entre dichos partidos,"
                            . " respectivamente estos aquí nombrados."), 0, "J");

            $pdf->Ln(3);
            $pdf->Cell(10);
            $pdf->Cell(0, 5, utf8_decode("I. Primer partido aquí pacta y accede a:"), 0, 1);

            $pdf->Ln(5);
            $pdf->Cell(16);
            $pdf->MultiCell(160, 5, utf8_decode("1. Por el monto no reembolse de $400.00 se obtendrá la solicitud y análisis "
                            . "de su reporte de crédito y su situación crediticia actual y se ha organizado un plan de "
                            . "trabajo donde se le asesorara al consumidor para que pueda solucionar los inconvenientes que "
                            . "presenta aumentar su puntaje crediticio y volver a tener un buen historial."
                            . "\n\n"
                            . "2. Una vez las cuentas sean verificadas, Greenlight le orientara sobre como negociar y "
                            . "obtener acuerdos con los acreedores en cuestión. "
                            . "\n\n"
                            . "3. Greenlight va a asesorar al cliente sobre sus derechos bajo el FCRA fair credit reporting act."
                            . "\n\n"
                            . "4. Greenlight continuara monitoreando cualquier mejora que el reporte crediticio del cliente pueda experimentar y la forma en que se estén haciendo los acuerdos de pago y verificaciones."), 0, "J");

            $pdf->Ln(10);
            $pdf->Cell(10);
            $pdf->Cell(0, 5, utf8_decode("II. SUS DERECHOS COMO CONSUMIDOR "), 0, 1);

            $pdf->Ln(5);
            $pdf->Cell(10);
            $pdf->MultiCell(165, 5, utf8_decode("FCRA sus siglas en ingles de Fair Credit Reporting Act está diseñada "
                            . "para promover exactitud, justicia y privacidad de información en los documentos de cada "
                            . "agencia de informe del consumidor (CRA). La mayoría de CRA agencia de informes del consumidor"
                            . " son oficinas de crédito que obtienen y venden información sobre usted tal como cuando paga"
                            . " sus facturas a tiempo o aplica por bancarrota para acreedores, empleadores, "
                            . "propietarios y otros negocios. Aunque Truelink, Inc. No es una cra, nuestra empresa "
                            . "Matrix Transunion LLC si es una CRA. Puede encontrar la información completa sobre la FCRA, "
                            . "15-U.S.C. 1681-1681u, en la página web de la comisión federal de comercio. "
                            . "La FCRA le da derechos específicos, así como mencionamos abajo. Usted podría tener derechos "
                            . "adicionales bajo ley estatal. Usted puede contactar un estado o una agencia local de protección al "
                            . "consumidor a un abogado estatal para aprender sobre estos derechos. A usted se le debe decir si la "
                            . "información de sus documentos a sido usada en contra suya. Cualquiera que use información de una "
                            . "CRA para tomar acción en contra suya, así como denegar una aplicación para crédito, seguro o empleo "
                            . "debe decírselo, y dar el nombre dirección y teléfono de la CRA que entregó el "
                            . "reporte del consumidor."), 0, "J");

            // Fin pagina 6
            //pagina 7
            $pdf->AddPage();

            $pdf->Ln(10);
            $pdf->Cell(10);
            $pdf->Cell(0, 5, utf8_decode("III. Otros términos para ser observados por y entre los partidos:  "), 0, 1);

            $pdf->Ln(5);
            $pdf->Cell(13);
            $pdf->Cell(0, 5, utf8_decode("1. Este acuerdo se ha iniciado por los partidos por de decisión propia, el cliente entiende que:"), 0, 1);

            $pdf->Ln(5);
            $pdf->Cell(16);
            $pdf->MultiCell(160, 4, utf8_decode("A)  El cliente entiende que los cargos hechos no son para reparar su crédito, "
                            . "pero, por el contrario, son para hacer un análisis global de éste, así mismo para diseñar un plan"
                            . " consistente para superar las marcas negativas en su perfil, también para obtener y aprender cómo"
                            . " manejar sus créditos."
                            . "\n\n"
                            . "B)  En dicho plan de trabajo el cliente obtendrá aprendizaje para gestionar "
                            . "sus cuentas de crédito."), 0, "J");

            $pdf->Ln(6);
            $pdf->Cell(10);
            $pdf->MultiCell(165, 5, utf8_decode("2. Este acuerdo será vinculante para las partes, los sucesores y "
                            . "representantes personales. El tiempo es esencial en todos los compromisos. Este acuerdo será "
                            . "impuesto bajo las leyes del estado de Florida. Este es el acuerdo entero."
                            . "\n\n"
                            . "IV. ACCESO A SU EXPEDIENTE ES LIMITADO"
                            . "\n\n"
                            . "Una CRA puede dar información sobre usted solo a una persona con una necesidad reconocida "
                            . "por la FCRA usualmente para considerar una aplicación con un acreedor, aseguradora, "
                            . "empleador, propietario, u otros negocios."
                            . "\n\n"
                            . "Firmado el día y el año primero escrito arriba."
                            . "\n\n"
                            . "Firmado en la presencia de: "), 0, "J");


            $pdf->Ln(18);
            $pdf->Cell(5);
            $pdf->Cell(168, 6, utf8_decode("            Testigos                      Firma del cliente                      Fecha de nacimiento                    Número S.S"), 0, 1, "C");


            $pdf->SetFont('Times', 'IUB', 14);
            $pdf->SetTextColor(238, 23, 23);

            $pdf->Ln(26);
            $pdf->Cell(10);
            $pdf->MultiCell(165, 5, utf8_decode("ESTE DOCUMENTO ES UNA TRADUCCION DEL CONTRATO"
                            . "\n"
                            . " ORIGINAL Y NO TIENE VALIDEZ LEGAL. POR FAVOR LEALO,"
                            . "\n"
                            . "FIRME EL ORIGINAL Y ENVIELO DE VUELTA. "
                            . "SI TIENE"
                            . "\n"
                            . " ALGUNA DUDA COMUNIQUESE CON NUESTRO"
                            . "\n"
                            . " DEPARTAMENTO DE CUSTOMER"
                            . " SERVICE AL 305-3608801"), 0, "C");

            $pdf->SetTextColor(0, 0, 0);
            // Fin pagina 7
            //F para guardar, I para mostrar
            $pdf->Output("F", "../../Documentos/" . $this->ss . "/Contrato_" . $this->ss . ".pdf");

            $response['datalle'] = "Contrato enviado";
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
