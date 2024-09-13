<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendOTP($toEmail, $otp) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth   = true;
        $mail->Username   = 'Username@gmail.com'; // SMTP username
        $mail->Password   = ''; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('kushanesalakck@gmail.com', 'kushan esala');
        $mail->addAddress($toEmail);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'OTP CODE FOR LIBRARY MANAGEMENT SYSTEM';
        $mail->Body    = 'Your OTP code for LIBRARY MANAGEMENT SYSTEM is: <b>' . $otp . '</b>';
        $mail->AltBody = 'Your OTP code for LIBRARY MANAGEMENT SYSTEM is: ' . $otp;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>
