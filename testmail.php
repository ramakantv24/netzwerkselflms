<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";

$mail->SMTPDebug  = 1;  
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "ssl";
$mail->Port       = 465;
$mail->Host       = "netzwerkself.com";
$mail->Username   = "info@netzwerkself.com";
$mail->Password   = "lp!a}uJX2vx~";

$mail->IsHTML(true);
$mail->AddAddress("ramakantv24@gmail.com", "Netzwerkself");
$mail->SetFrom("info@netzwerkself.com", "Netzwerkself");
$mail->AddReplyTo("info@netzwerkself.com", "Netzwerkself");
$mail->AddCC("info@netzwerkself.com", "Netzwerkself");
$mail->Subject = "Test is Test Email sent via Gmail SMTP Server using PHP Mailer";
$content = "<b>This is a Test Email sent via Gmail SMTP Server using PHP mailer class.</b>";

$mail->MsgHTML($content); 
if(!$mail->Send()) {
  echo "Error while sending Email.";
  echo "<pre>";
  print_r($mail);
} else {
  echo "Email sent successfully";
}
?>