<?php
require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'rksehara95@gmail.com';          // SMTP username
$mail->Password = 'ramkesh@9672'; // SMTP password
$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                          // TCP port to connect to
$mail->setFrom('rksehara95@gmail.com', 'CodexWorld');
$mail->addReplyTo('rksehara95@gmail.com', 'CodexWorld');
$mail->addAddress('rksehara95@gmail.com');   // Add a recipient


$mail->isHTML(true);  // Set email format to HTML

$bodyContent = '<h1></h1>';
$bodyContent .= '<p></p>';

$mail->Subject = 'Email from Localhost by CodexWorld';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>