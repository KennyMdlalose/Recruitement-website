<?php
require('database.php');

// Initialize an empty message variable
$message = "";
$isSuccess = true;

// If the form is submitted, process the data
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $id_number = $_POST['id_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];
    $terms = $_POST['terms'];

    // Check if ID number contains only numbers and is valid
    if (!ctype_digit($id_number) || strlen($id_number) !== 13 || !is_valid_sa_id($id_number)) {
        $message = "Please enter a valid 13-digit South African ID number!";
        $isSuccess = false;
    } elseif ($terms != 'accepted') {
        $message = "You must accept the terms and conditions!";
        $isSuccess = false;
    } elseif ($password !== $repeat_password) {
        $message = "Passwords do not match!";
        $isSuccess = false;
    } else {
        // Check if the ID number or email already exists
        $check_sql = "SELECT * FROM applicant WHERE id_number = '$id_number' OR email = '$email'";
        $result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($result) > 0) {
            $message = "ID number or email already exists!";
            $isSuccess = false;
        } else {
            // ID number and email do not exist, proceed with insertion
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO applicant(id_number, password, email)
                    VALUES ('$id_number', '$hashed_password', '$email')";

            if (mysqli_query($conn, $sql)) {
                // Set a success message
                $message = "You have successfully registered. You can now login.";
            } else {
                $message = "Error: " . mysqli_error($conn);
                $isSuccess = false;
            }
        }
    }

    mysqli_close($conn);
}

function is_valid_sa_id($id_number) {
    // Validate the ID number using Luhn algorithm
    $even_sum = 0;
    $odd_sum = 0;
    for ($i = 0; $i < 13; $i++) {
        $digit = intval($id_number[$i]);
        if ($i % 2 == 0) {
            $odd_sum += $digit;
        } else {
            $digit = $digit * 2;
            if ($digit > 9) {
                $digit -= 9;
            }
            $even_sum += $digit;
        }
    }
    return ($odd_sum + $even_sum) % 10 === 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
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
            width: 100px;
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
        <h2>Create Account</h2>
        <form method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <input type="text" class="form-control" name="id_number" id="id_number" placeholder="Enter ID" maxlength="13" required autofocus>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required disabled>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required disabled>
            </div>
            <ul class="instructions">
                <li id="length" class="invalid">At least 8 characters</li>
                <li id="uppercase" class="invalid">At least one uppercase letter</li>
                <li id="lowercase" class="invalid">At least one lowercase letter</li>
                <li id="digit" class="invalid">At least one digit</li>
                <li id="special" class="invalid">At least one special character (e.g., !@#$%^&*)</li>
            </ul>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" id="repeat_password" placeholder="Repeat Password" required disabled>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="terms" id="terms" value="accepted" required>
                <label class="form-check-label" for="terms">I accept the <a href="terms.php" target="_blank">terms and conditions</a></label>
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
           
        </form>
        <div>
            <p>Already Registered? <a href="LoginApplicant.php">Login Here</a></p>
        </div>
    </div>

    <!-- Toaster message container -->
    <div id="toaster" class="toaster"></div>
    <input type="hidden" id="php-message" value="<?php echo htmlspecialchars($message); ?>">

    <script>
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

        function toggleFields() {
            const idNumber = document.getElementById('id_number').value;
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const repeatPassword = document.getElementById('repeat_password');
            
            const fieldsEnabled = idNumber.length === 13 && validateID(idNumber);
            
            email.disabled = !fieldsEnabled;
            password.disabled = !fieldsEnabled;
            repeatPassword.disabled = !fieldsEnabled;
        }

        function validateID(id_number) {
            if (id_number.length !== 13 || !/^\d+$/.test(id_number)) {
                showToast("Please enter a valid 13-digit South African ID number!", true);
                return false;
            }

            let even_sum = 0;
            let odd_sum = 0;

            for (let i = 0; i < 13; i++) {
                const digit = parseInt(id_number[i]);

                if (i % 2 === 0) {
                    odd_sum += digit;
                } else {
                    const double_digit = digit * 2;
                    even_sum += double_digit > 9 ? double_digit - 9 : double_digit;
                }
            }

            const isValid = (odd_sum + even_sum) % 10 === 0;

            if (!isValid) {
                showToast("Invalid South African ID number!", true);
            }

            return isValid;
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

            const idNumberField = document.getElementById('id_number');
            idNumberField.addEventListener('input', toggleFields);

            const passwordField = document.getElementById('password');
            passwordField.addEventListener('input', () => validatePassword(passwordField.value));

            toggleFields();
        });

        window.onload = function() {

window.history.pushState(null, null, window.location.href);


window.onpopstate = function() {

    window.history.pushState(null, null, window.location.href);
};
};
    </script>
</body>
</html>


