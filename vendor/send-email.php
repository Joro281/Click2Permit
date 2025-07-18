<?php

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST['sendMailBtn'])) {
    // Sanitize and validate input
    $fromEmail = filter_var($_POST['fromEmail'], FILTER_VALIDATE_EMAIL);
    $toEmail = filter_var($_POST['toEmail'], FILTER_VALIDATE_EMAIL);
    $subjectName = htmlspecialchars($_POST['subject'], ENT_QUOTES);
    $messageContent = htmlspecialchars($_POST['message'], ENT_QUOTES);

    if (!$fromEmail || !$toEmail) {
        // Handle invalid email addresses
        die('Invalid email address');
    }

    $to = $toEmail;
    $subject = $subjectName;
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: ' . $fromEmail . '<' . $fromEmail . '>' . "\r\n" . 'Reply-To: ' . $fromEmail . "\r\n" . 'X-Mailer: PHP/' . phpversion();

    // Use only the message content without additional HTML structure
    $message = $messageContent;

    // Use PHPMailer for better control and error handling
    require 'C:\Users\PC\vendor\autoload.php';

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'Clarklim281@gmail.com'; // Replace with your Gmail address
    $mail->Password = 'gyhi wbjw isgm xfzp'; // Replace with your Gmail app password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom($fromEmail);
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->Body = "$subject\r\n\r\n$messageContent"; // Include subject in the body

    if ($mail->send()) {
        echo '<script>alert("Email sent successfully!");</script>';
        echo '<script>window.location.href="form.php";</script>';
    } else {
        echo '<script>alert("Error sending email: ' . $mail->ErrorInfo . '");</script>';
    }
}
?>