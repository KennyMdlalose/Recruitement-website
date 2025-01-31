<?php
require('database.php');

// Initialize an empty message variable
$message = "";


// Check if token is set in the URL
if (isset($_GET['token'])) {
    $token = mysqli_real_escape_string($conn, $_GET['token']);

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $newPassword = mysqli_real_escape_string($conn, $_POST['password']);

        // Validate the token and check its expiry
        $query = "SELECT applicantID FROM applicant WHERE reset_token = '$token' AND token_expiry > NOW()";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $userId = $user['applicantID'];

            // Hash the new password and update it in the database
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateQuery = "UPDATE applicant SET password = '$hashedPassword', reset_token = NULL, token_expiry = NULL WHERE applicantID = $userId";
            mysqli_query($conn, $updateQuery);

            // Redirect after success
             $message ="Password has been reset successfully. You can now log in.";
        } else {
            $message = "Invalid or expired token. Please try again.";
        }

        mysqli_close($conn);
    }
} else {
    echo '<script>alert("Invalid request. Token not found.");</script>';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rest Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="icon" href="images/mict-logo4.jpg">
    <style>
        body {
            background-image: url("images/mict-logo3.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            padding: 50px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 50px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }
        .form-group {
            margin-bottom: 30px;
        }
        h2 {
            text-align: center;
        }
        input[type="submit"] {
            margin-left: 200px;
            width: 150px;
        }
        .toaster {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 15px 20px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            transition: opacity 3.5s ease-in-out, transform 3.5s ease-in-out;
            opacity: 0;
        }
        .toaster.error {
            background-color: #f44336;
        }
        .instructions {
            margin-top: 20px;
            font-size: 14px;
            color: #333;
        }
        .instructions li {
            margin-bottom: 5px;
        }
        .instructions .valid {
            color: green;
        }
        .instructions .invalid {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Rest Password</h2>
        <form action="#" method="POST" style="font-size:larger;" onsubmit="return validateForm()">
 
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required autofocus>
            </div>
            <div>
            <ul class="instructions">
                <li id="length" class="invalid">At least 8 characters</li>
                <li id="uppercase" class="invalid">At least one uppercase letter</li>
                <li id="lowercase" class="invalid">At least one lowercase letter</li>
                <li id="digit" class="invalid">At least one digit</li>
                <li id="special" class="invalid">At least one special character (e.g., !@#$%^&*)</li>
            </ul>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" id="repeat_password" placeholder="Repeat Password" required >
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Rest Password" name="submit" onclick="myFunction()">
            </div>
        </form>
        <div>
            <p><a href="LoginApplicant.php">Login Here</a></p>
        </div>
    </div>
  <!-- Toaster message container -->
  <div id="toaster" class="toaster"></div>
    <input type="hidden" id="php-message" value="<?php echo htmlspecialchars($message); ?>">


    <script>
   function myFunction(){
      
                    window.location.href = 'loginApplicant.php';
    
         
        }

     function showToast(message, isError = false) {
            const toaster = document.getElementById('toaster');
            toaster.textContent = message;
            if (isError) {
                toaster.classList.add('error');
            } else {
                toaster.classList.remove('error');
            }
            toaster.style.opacity = '1';

            setTimeout(() => {
                toaster.style.opacity = '0';
                toaster.style.transform = 'translateX(-50%) translateY(-20px)';
            }, 3000);
        }


  function validatePassword(password) {
            const hasUpper = /[A-Z]/.test(password);
            const hasLower = /[a-z]/.test(password);
            const hasDigit = /\d/.test(password);
            const hasSpecial = /[#@$!%*?&,.()=+;:`~"'/^-_]/.test(password);
            const isValidLength = password.length >= 8;

            document.getElementById('length').className = isValidLength ? 'valid' : 'invalid';
            document.getElementById('uppercase').className = hasUpper ? 'valid' : 'invalid';
            document.getElementById('lowercase').className = hasLower ? 'valid' : 'invalid';
            document.getElementById('digit').className = hasDigit ? 'valid' : 'invalid';
            document.getElementById('special').className = hasSpecial ? 'valid' : 'invalid';

            return hasUpper && hasLower && hasDigit && hasSpecial && isValidLength;
        }

        function validateForm() {
            const password = document.getElementById('password').value;
            const repeatPassword = document.getElementById('repeat_password').value;

            if (!validatePassword(password)) {
                showToast("Password does not meet the criteria!", true);
                return false;
            }

            if (password !== repeatPassword) {
                showToast("Passwords do not match!", true);
                return false;
            }

            return true;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const phpMessage = document.getElementById('php-message').value;

            if (phpMessage) {
                // Determine if the message is an error or success message
                const isError = phpMessage.includes("Error") || phpMessage.includes("Invalid") || phpMessage.includes("Please");
                showToast(phpMessage, isError);
            }

      
            const passwordField = document.getElementById('password');
            passwordField.addEventListener('input', () => validatePassword(passwordField.value));

            toggleFields();
        });

        function myFunc(){
       window.location.href = "loginApplicant.php";
        }
</script>

 
</body>
</html>
