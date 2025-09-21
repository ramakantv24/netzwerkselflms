<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 1;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'secureit24.sgcpanel.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'no-reply@changeangel.io';                 // SMTP username
    $mail->Password = 'Searcher1@';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('no-reply@changeangel.io', 'ChangeAngel.io');
    $mail->addAddress('divyamsolanki9@gmail.com');     // Add a recipient
    $mail->addReplyTo('support@changeangel.io', 'ChangeAngel Support Team');

    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Signup Successful on ChangeAngel.io';
    $mail->Body    = '<html>
    <head>
    <title>Account Sign-up</title>
    </head>
    <body>
    <p>Sign-up Successful on <a href="https://changeangel.io">ChangeAngel.io</a>a></p>
    <p>Your Password is : </p>'.$passwordd.'
    </body>
    </html>';
    $mail->AltBody = 'Your Password is '.$passwordd;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}