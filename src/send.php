<?php

$userName = $_POST['userName'];
$userPhone = $_POST['userPhone'];
$userEmail = $_POST['userEmail'];
$userQuestion = $_POST['userQuestion'];

// Load Composer's autoloader
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer\PHPMailer\PHPMailer();

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'burdukoaskijvladislav@gmail.com';               // SMTP username
    $mail->Password   = 'hCp-MjY-C5g-aB8';                        // SMTP password
    $mail->SMTPSecure = 'ssl';            // Enable TLS encryption; 
    $mail->Port       = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('burdukoaskijvladislav@gmail.com', 'Владислав');
    $mail->addAddress('burdukovskij.vlad@mail.ru');     // Add a recipient
    
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "New order";
    $mail->Body    = "Имя пользователя ${userName}, его телефон: ${userPhone}. Его почта: ${userEmail} Его вопрос: ${userQuestion}";
    
    $mail->send();
   header('Location: thanks.html');
} catch (Exception $e) {
    echo "Письмо не отправлено, есть ошибка. Код ошибки: {$mail->ErrorInfo}";
}