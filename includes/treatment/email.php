<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class customMailer
{
    public function sendMail($email, $message, $subject)
    {
        require_once 'PHPMailer/src/Exception.php';
        require_once 'PHPMailer/src/PHPMailer.php';
        require_once 'PHPMailer/src/SMTP.php';
        
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->addAddress($email);
        $mail->Username = "istanbulmarket.metz@gmail.com";
        $mail->Password = "Istanbulmetz57*";
        $mail->setFrom('istanbulmarket.metz@gmail.com', 'ISTANBUL Market');
        $mail->addReplyTo("no-reply-istambul@gmail.com", "Ne pas répondre");
        $mail->Subject = $subject;
        $mail->msgHTML($message);
        $mail->send();
        if (!$mail->send()) {
            $_SESSION['flash']['danger'] = "<i class='fas fa-envelope-open-text'></i> Une erreur s'est produite : $mail->ErrorInfo ";
            header('location: index.php?page=1');
            exit();
        }
    }
}
