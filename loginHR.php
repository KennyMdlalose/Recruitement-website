<?php
session_start();

// Database connection settings
$servername = "localhost"; 
$username = "root";       
$password = "";           
$dbname = "MICT"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and bind the query
    $stmt = $conn->prepare("SELECT * FROM hr WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);  // Bind parameters for email and password

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a record is found
    if ($result->num_rows > 0) {
        // If user is found, fetch user data
        $row = $result->fetch_assoc();

        // Store email and role in session
        $_SESSION['email'] = $row['email'];  // Storing email in session
        $_SESSION['type'] = $row['type'];    // Storing role in session

        // Redirect based on role
        if ($row['type'] == 1) {
            // Redirect to admin dashboard
            header("Location: ./admin.php/dashboard.php");
            exit();
        } elseif ($row['type'] == 2) {
            // Redirect to HR dashboard
            header("Location: ./hr.php/dashboard.php");
            exit();
        }
    } else {
        // If no user is found, show an error message
        $toasterMessage = "Invalid email or password!";
    }

    $stmt->close(); // Close the prepared statement
}

// Close connection
$conn->close();
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
</head>
<body>
    <div class="container">
   
        <h2>Login Employer</h2>
        <form  method="POST" action="">
            <div class="form-group">
                <input type="email" placeholder="Enter Email:" name="email" id="email" class="form-control" required autofocus>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password:" name="password" id="password"  class="form-control" required>
                <p style="display: flex;margin-left:340px; ">
                    <a href="forgotPassword.php" >Forgot Password</a>
                </p>
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
        </form>
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
xhr.open("POST", "dashboard.php", true);
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
        console.log(xhr.responseText);
    }
};
xhr.send(" ");
}
</script>
</body>
</html>