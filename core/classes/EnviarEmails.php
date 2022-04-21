<?php

namespace core\classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EnviarEmails{

    public function email__activacao_conta($email_cliente, $purl){

        //Load Composer's autoloader
        // require 'vendor/autoload.php';


        // constroi o purl (link de validacao da aconta)
        // para ambiente web
        // $purl = 'https://www.minhaloja.com.mz/?p=validar_conta&purl=' .$purl;
        $link = BASE_URL.'?p=validar_conta&purl=' .$purl;

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output {{MUDAR PARA DEBAG_OFF ANTES DE HOSPEDAR}}
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = EMAIL_HOST;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = EMAIL_FROM;                     //SMTP username
            $mail->Password   = EMAIL_PASS;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->CharSet    = EMAIL_CHARSET;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


            //Recipients
            $mail->setFrom(EMAIL_FROM, APP_NAME);
            $mail->addAddress($email_cliente);     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = APP_NAME .' - Email de Confirmacao';
            $html = '<p>Seja bem vindo a nossa loja ' . APP_NAME . '.</p>';
            $html .= '<p>Para poder entrar na nossa loja, necessita de confirmar o teu email.</p>';
            $html .= '<p>Para confirmar o email, click no link abaixo</p>';
            $html .= '<p> <a href="'.$link.'">Confirmar Email</a> </p>';
            $html .= '<p>Recebeu este email porque foi criada uma conta na '.APP_NAME.' com este enderenco, se desconhece esta accao porfavor ignore este email.</p>';
            $html .= '<p> <i> <small> <strong> '. APP_NAME .' <?/stong> </small> </i> </p>';
            $mail->Body = $html;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
           return true;
        //    echo "sent";
        } catch (Exception $e) {
            return false;
            // echo "Falha";
        }
    }
}