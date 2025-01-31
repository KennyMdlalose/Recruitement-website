use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'molekoatshepo17@gmail.com';
    $mail->Password = 'kvbohumimasrxbcb';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Recipients
    $mail->setFrom('molekoatshepo17@gmail.com', 'Mailer');
    $mail->addAddress($email);     // Add the user's email here

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Password Reset Request';
    $mail->Body    = "Click <a href='$resetLink'>here</a> to reset your password.";

    $mail->send();
    echo 'Password reset email has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
