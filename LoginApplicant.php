<?php
session_start();
require('database.php');

$toasterMessage = '';

if (isset($_POST['email']) && isset($_POST['password'])) {
    // Assigning posted values to variables
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Checking the values are existing in the database or not
    $sql = "SELECT * FROM applicant WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($row && password_verify($password, $row['password'])) {
        // If the posted values are equal to the database values, create a session for the user
        $_SESSION['id_number'] = $row['id_number'];
        $_SESSION['email'] = $row['email'];

        // Redirect to profile page with id_number and email as URL parameters
        header("Location: profile.php?id={$row['id_number']}&email={$row['email']}");
        exit();
    } else {
        // Set the toaster message for invalid login
        $toasterMessage = 'Invalid email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="icon" href="images/mict-logo4.jpg">
</head>
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
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: #dc3545;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 50%;
        top: 30px;
        font-size: 17px;
    }

    .toaster.show {
        visibility: visible;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    @keyframes fadein {
        from {top: -50px; opacity: 0;} 
        to {top: 30px; opacity: 1;}
    }

    @keyframes fadeout {
        from {top: 30px; opacity: 1;} 
        to {top: -50px; opacity: 0;}
    }
</style>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST">
            <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required autofocus>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Login" name="submit">
            </div>
        </form>
        <div>
            <p>Not Registered? <a href="RegisterApplicant.php">Register Here</a>
            <a href="forgotPassword.php" style="margin-left:150px;">Forgot Password</a>
        </p>
        </div>
    </div>

    <!-- Toaster Notification -->
    <div id="toaster" class="toaster"></div>

    <script>
        function showToaster(message) {
            var toaster = document.getElementById("toaster");
            toaster.textContent = message;
            toaster.className = "toaster show";
            setTimeout(function(){ toaster.className = toaster.className.replace("show", ""); }, 3000);
        }

        // Display toaster if there is a message from PHP
        <?php if (!empty($toasterMessage)): ?>
            showToaster('<?php echo $toasterMessage; ?>');
        <?php endif; ?>
        function sendData() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "profile.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
        }
    };
    xhr.send("id=0111135542087&email=karabomollo84@gmail.com");
}

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