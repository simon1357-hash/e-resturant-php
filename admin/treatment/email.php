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
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->addAddress($email);
        $mail->Username = "lepetqwlepetit@gmail.com";
        $mail->Password = "Ayan13579*";
        $mail->setFrom('lepetqwlepetit@gmail.com', 'Lepetitsushi Japonais');
        $mail->addReplyTo("no-reply-lepetqwlepetit@gmail.com", "Ne pas répondre");
        $mail->Subject = $subject;
        $mail->msgHTML($message);
        $mail->send();
        if (!$mail->send()) {
            $_SESSION['flash']['danger'] = "<i class='fas fa-envelope-open-text mr-2'></i> Une erreur s'est produite : $mail->ErrorInfo ";
            header('location: index.php?page=1');
            exit();
        }
    }
}
