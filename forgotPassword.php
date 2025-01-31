<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require('database.php');

$message = ''; // Initialize message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if the email exists
    $query = "SELECT applicantID, email FROM applicant WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $userId = $user['applicantID'];

        // Generate a reset token and expiry time
        $token = bin2hex(random_bytes(16));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Store the reset token and expiry in the database
        $updateQuery = "UPDATE applicant SET reset_token = '$token', token_expiry = '$expiry' WHERE applicantID = $userId";
        mysqli_query($conn, $updateQuery);

        // Send the reset email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'molekoatshepo17@gmail.com';
            $mail->Password = 'kvbohumimasrxbcb'; // Application-specific password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Switch to SSL
            $mail->Port = 587; // Use port 465 for SSL

            $mail->setFrom('mictSETA@mict.org.za', 'MICTSETA');
            $mail->addAddress($email);
            $mail->Subject = 'Password Reset Request';
            $mail->Body = 'Please click the following link to reset your password: http://localhost/MICT/restPassword.php?token=' . $token;

            $mail->send();
            $message = 'Password reset email sent.';
            $redirect = true; // Set redirect flag to true
        } catch (Exception $e) {
            $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $redirect = false; // Set redirect flag to false
        }
    } else {
        $message = 'No user found with that email address.';
        $redirect = false; // Set redirect flag to false
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forgot Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="icon" href="images/mict-logo4.jpg">
</head>

<style>
        body{
        background-image: url("images/mict-logo3.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        padding:50px;
    }
.container{
    max-width: 600px;
    margin:0 auto;
    padding:50px;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
}
.form-group{
    margin-bottom:30px;
}

h2{
    text-align: center;
}

input[type="submit"]{

    margin-left: 200px;

}

p{
    margin-left: 300px;
}
</style>
<body>
    <div class="container">
      
   
    
        <h2>Forgot Password </h2>
      <form action=" " method="Post">
        <div class="form-group">
            <input type="email" placeholder="Enter Email:" name="email" id="email" class="form-control" required>
            <p>Back to login page <a href="LoginApplicant.php">Login</a></p>
        </div>
    
        <div>
            <p id="result" style="color:forestgreen;margin-left:190px;"> </p>
        </div>
        <div class="form-btn">
            
            <input type="submit" value="Send Reset Link" name="login" class="btn btn-primary">
        </div>
       
      </form>
    
    </div>


    <script>
        //Prevent user from using the click to go forward arrow
window.onload = function() {

window.history.pushState(null, null, window.location.href);


window.onpopstate = function() {

    window.history.pushState(null, null, window.location.href);
};
};

    </script>
</body>

</html>