<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'mailer/vendor/autoload.php';
function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function sendSignupEmail($emaill,$passwordd) {
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;                             // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.zoho.in';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'no-reply@netzwerkacademy.com';                 // SMTP username
    $mail->Password = 'Website@123';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;
    $mail->setFrom('no-reply@netzwerkacademy.com', 'Netzwerk Academy');
    $mail->addAddress($emaill);     // Add a recipient
    $mail->addReplyTo('info@netzwerkacademy.com', 'Netzwerk Support Team');
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Account Created';
    $mail->Body = ' <html>
        <head>
        <title>Account Creation</title>
        </head>
        <body>
        <p>Hello,</p>
        <p>Signup Successful on LMS Netzwerk Academy<br>Your Password is : '.$passwordd.'<br><a href="https://lms.netzwerkacademy.com">Click Here</a> to open login page.
        </body>
        </html>';
    $mail->AltBody = 'Password Update';
    $mail->send();        
}

echo sendSignupEmail("divyamsolanki9@gmail.com",randomPassword());