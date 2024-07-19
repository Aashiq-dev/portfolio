<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Clear previous session errors
unset($_SESSION['name_error']);
unset($_SESSION['email_error']);
unset($_SESSION['number_error']);
unset($_SESSION['subject_error']);
unset($_SESSION['message_error']);

unset($_SESSION['name']);
unset($_SESSION['email']);
unset($_SESSION['number']);
unset($_SESSION['subject']);
unset($_SESSION['message']);

if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $_SESSION['name'] = $name;
    $email = $_POST['email'];
    $_SESSION['email'] = $email;
    $number = $_POST['mobile'];
    $_SESSION['number'] = $number;
    $subject = $_POST['subject'];
    $_SESSION['subject'] = $subject;
    $message = $_POST['message'];
    $_SESSION['message'] = $message;

    if (empty($name)) {
        $_SESSION['name_error'] = "Name is Required";
    } else {
        if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
            $_SESSION['name_error'] = "Name should contain only letters";
        }
    }

    if (empty($email)) {
        $_SESSION['email_error'] = "Email is Required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['email_error'] = "The email address (" . $email . ") is invalid!";
    }

    if (empty($number)) {
        $_SESSION['number_error'] = "Mobile Number is Required ";
    } else {
        if (!preg_match("/^([0-9]{10})$/", $number)) {
            $_SESSION['number_error'] = "Invalid number";
        }
    }

    if (empty($subject)) {
        $_SESSION['subject_error'] = "Subject is Required";
    }
    if (empty($message)) {
        $_SESSION['message_error'] = "Message is Required";
    }

    if (empty($_SESSION['name_error']) && empty($_SESSION['email_error']) && empty($_SESSION['number_error']) && empty($_SESSION['subject_error']) && empty($_SESSION['message_error'])) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'Aashiq76asq@gmail.com';
            $mail->Password   = 'zngj xhrd enem axbb';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom($email, $name);
            $mail->addAddress('Aashiq76asq@gmail.com', 'Aashiq');

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message . '<br>' . $number . '<br> My Email is : ' . $email;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo "<script>window.location.href='index.php#contact'</script>";
            $_SESSION['status'] = "Email Sent Successfully!";
        } catch (Exception $e) {
            // echo "<script>window.location.href='index.php'</script>";
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "<script>window.location.href='index.php#contact'</script>";
    }
}