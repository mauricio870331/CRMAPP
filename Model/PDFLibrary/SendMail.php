<?php

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

class SendMail {

    public function __construct() {
        
    }

    function enviarMail($de, $para, $asunto, $mensaje) {
//    $from = "smaurville@gmail.com";
//    $to = "smaurville@gmail.com";
//    $subject = "Checking PHP mail";
//    $message = "PHP mail works just fine";
        try {
            $headers = "From:" . $de . "\r\n";
            $headers .= "Reply-To: " . $de . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html\r\n";
            var_dump(mail($para, $asunto, $mensaje, $headers));
//        echo "The email message was sent.";  
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
