<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$firstName = $_POST['firstName'] ?? '';
$lastName  = $_POST['lastName'] ?? '';
$email     = $_POST['email'] ?? '';
$phone     = $_POST['phone'] ?? '';
$subject   = $_POST['subject'] ?? '';
$message   = $_POST['message'] ?? '';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'yourmail@gmail.com';      // 🔴 change
    $mail->Password = 'APP_PASSWORD_HERE';       // 🔴 change
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('yourmail@gmail.com', 'Website Contact');
    $mail->addAddress('yourmail@gmail.com');
    $mail->addReplyTo($email, $firstName);

    $mail->isHTML(true);
    $mail->Subject = "Contact Form: $subject";
    $mail->Body = "
        <h3>New Message</h3>
        <p><b>Name:</b> $firstName $lastName</p>
        <p><b>Email:</b> $email</p>
        <p><b>Phone:</b> $phone</p>
        <p><b>Message:</b><br>$message</p>
    ";

    $mail->send();
    echo "✅ Message sent successfully!";
} catch (Exception $e) {
    echo "❌ Mail Error: {$mail->ErrorInfo}";
}
