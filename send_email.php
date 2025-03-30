<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Make sure this path is correct

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'localhost'; // Replace with your SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'aktuitioncenter6@gmail.com'; // Replace with your SMTP username
    $mail->Password   = 'Kiranraj@12'; // Replace with your SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use `PHPMailer::ENCRYPTION_SSL` if required
    $mail->Port       = 587; // Use 465 for SSL, 587 for TLS

    // Recipients
    $mail->setFrom('your-email@example.com', 'Your Name');
    $mail->addAddress('recipient@example.com'); // Add recipient

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Subject of the email';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
