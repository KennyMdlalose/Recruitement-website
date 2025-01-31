<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['submitContact'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['division'];
    $message = $_POST['message'];

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'molekoatshepo17@gmail.com';            //SMTP username
        $mail->Password   = 'kvbohumimasrxbcb';                     //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('molekoatshepo17@gmail.com', 'MICTSETA WEBSITE');   // Set sender of the email
        $mail->addAddress('molekoatshepo17@gmail.com', 'MICTSETA WEBSITE');      // Add a recipient

        //Content
        $mail->isHTML(true);                                        //Set email format to HTML
        $mail->Subject = 'New enquiry - MICT SETA CONTACT FORM';
        $mail->Body    = '<h3>Hello, you got a new enquiry</h3>
                          <h4>Name: '. $name .'</h4>
                          <h4>Email: '. $email .'</h4>
                          <h4>Title: '. $subject .'</h4>
                          <h4>Message: ' . $message . '</h4>';

        if ($mail->send()) {
            $_SESSION['status'] = "Thank you for contacting us - MICT SETA";
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit(0);
        } else {
            $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } catch (Exception $e) {
        $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    exit(0);
}
?>
