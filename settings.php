<?php
session_start();
require('database.php');


$timeout_duration = 3600; 

if (isset($_SESSION['last_activity'])) {
 
    $session_age = time() - $_SESSION['last_activity'];

  
    if ($session_age > $timeout_duration) {
        session_unset();    
        session_destroy();  
        header("Location: Logout.php"); 
        exit;
    }
}

// Update the last activity time
$_SESSION['last_activity'] = time();


// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $id = $_SESSION['id_number']; // Ensure this session variable is set

    // Check if the passwords match
    if ($password === $confirm_password) {
        // Hash the new password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Update the password in the database
        $sql = "UPDATE applicant SET password = ? WHERE id_number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $hashed_password, $id);

        if (mysqli_query($conn, $sql)) {
            $_SESSION['toaster_message'] = "Password  updated successfully!";

            $_SESSION['toaster_type'] = "success";
        } else {
            $_SESSION['toaster_message'] = "Error: " . mysqli_error($conn);
        }
    } else {
        $_SESSION['message'] = "Passwords do not match";
    }

        
        $stmt->close();
        $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/mict-logo4.jpg">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 800px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 300px;
            margin-top: -20px;
        }

        form {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        label {
            margin-bottom: 8px;
            font-weight: bold;
        }

        input, textarea, select {
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            width: 100%;
        }

        .button-container {
            display: flex;
            gap: 5px; 
        }

        input[type="submit"] {
            background-color: #2b94da;
            color: #fff;
            cursor: pointer;
            padding: 1rem;
            border-radius: .5rem;
            width: 100px;
            text-align: center;
            border: none; 
            margin-left: 300px;
        }

        .map-container {
            position: relative;
            overflow: hidden;
            padding-top: 75%; /* Aspect ratio 4:3 (adjust as needed) */
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        header {
            background-image: url(images/mictsetalogo.png);
            background-repeat: no-repeat;
            width: 100%;
            height: 90px;
            margin-bottom: 0px;
        }

        .navbar {
            padding: 0px;
            margin-left: 40%;
        }

        h1 {
            text-align: center;
        }
        .message{
    text-align:center;
    margin: top 10px;
    margin-bottom:10px;
    color:green;
}

.message2{
    text-align:center;
    margin: top 10px;
    margin-bottom:10px;
    color:red;
}

* Toaster message styles */
.toaster {
    position: fixed;
    top: 20px; /* Position 20px from the top */
    left: 50%; /* Position to the center horizontally */
    transform: translateX(-50%) translateY(-100%); /* Center horizontally and move above the visible area */
    padding: 15px 20px;
    background-color: #4CAF50; /* Default green background for success */
    color: white;
    font-size: 16px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    z-index: 1000;
    transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
    opacity: 0; 
}

.toaster.error {
    background-color: #f44336; 
}

.toaster.show {
    transform: translateX(-50%) translateY(0); /* Move to the visible area */
    opacity: 1; 
}

    </style>
</head>
<body>
    <!-- header section starts-->
    <header class="header">
        <section class="flex">
            <nav class="navbar">
                <a href="Home.php" style="margin-left:260px;">Home</a>
                <a href="jobList2.php">Job List</a>
                <a href="Contact.php">Contact Us</a>
                <a href="Logout.php">Logout</a>
            </nav>
        </section>
    </header> <br><br>

    <section style="float: left;width: 20%;height:500px; background:white;padding:5px;box-shadow: var(--box-shadow);font-size:larger;">
  

<br><br>
<a href="Profile.php" style="color: black; "><i class="fa fa-user"></i> Profile</a>
<br><br>
<br><br>
<a href="qualification.php"  style="color: black;"><i class="fa fa-graduation-cap"></i> Academic Qualifications</a>		
<br><br>
<br><br>
<a href="Language.php"  style="color: black;"><i class="fa fa-language"></i> Language Proficiency</a>
<br><br>
<br><br>
<a href="workExperience.php"  style="color: black;"><i class="fa fa-briefcase"></i> Working Experience</a>
<br><br>
<br><br>
<a href="softSkills.php"  style="color: black;"><i class="fa fa-cogs"></i> Soft Skills</a>
<br><br>
<br><br>
<a href="otherAttachments.php"  style="color: black;"><i class="fa fa-folder-open"></i> Other Attachments</a>
<br><br>
<br><br>
<a href="appliedJob.php"  style="color: black;"><i class="fa fa-bookmark"></i> Applied Jobs</a>
<br><br>
<br><br>
<a href="settings.php" style="color: black;"><i class="fa fa-key"></i> Settings</a>
<br><br>
<br><br>
<a href="Logout.php"   style="color: black;" ><i class="fa fa-sign-out"></i> Logout</a>
    </section>

    <section>
        <div class="container">
            <form action="#" method="post" style="font-size:larger;">
                <h1>Change Password</h1><br><br>
                <?php
if (isset($message)) {
    echo $message;
} else {
    echo " ";
}
?>
                 <?php
if (isset($message2)) {
    echo $message2;
} else {
    echo " ";
}
?>
     
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your new password">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Enter your new password">
                
     
                <div class="button-container">
                    <input type="submit" value="Update" onclick="resetTimer();">
                 
                </div>
            </form>
        </div>
    </section>


    <!-- contact us section ends-->
    <!--footer section starts-->
    <footer class="footer">
        <section class="grid">
            <div class="box">
                <h3>Quick link</h3>
                <a href="Profile.php"><i class="fas fa-angle-right"></i> Home</a>
                <a href="Logout.php"><i class="fas fa-angle-right"></i> Logout</a>
            </div>
            <div class="box">
                <h3>Extra links</h3>
                <a href="About2.php"><i class="fas fa-angle-right"></i>About Us</a>
                <a href="FAQ.php"><i class="fas fa-angle-right"></i>FAQ</a>
                <a href="FraudReport.php"><i class="fas fa-angle-right"></i>Report Fraud</a>
            </div>
            <div class="box">
                <h3>follow us</h3>
                <a href="https://m.facebook.com/people/MICT-SETA/100064473800888/?locale=br_FR"><i class="fab fa-facebook-f"></i> facebook</a>
                <a href="https://twitter.com/mictseta?lang=en"><i class="fab fa-twitter"></i> twitter</a>
                <a href="https://www.instagram.com/mictseta/?hl=en#:~:text=MICT%20SETA%20(%40mictseta)%20%E2%80%A2%20Instagram%20photos%20and%20videos"><i class="fab fa-instagram"></i> instagram</a>
                <a href="https://za.linkedin.com/company/mict-seta"><i class="fab fa-linkedin"></i> linkedin</a>
                <a href="https://www.youtube.com/@mictseta2918"><i class="fab fa-youtube"></i> youtube</a>
            </div>
        </section>
        <div class="credit">&copy; copyright @ 2024 by <span>THE HERD</span> all rights reserved!</div>
    </footer>
    <!--footer section ends-->

    <!-- cust js file link-->
    <div id="toaster" class="toaster"></div>
        <script >
               document.addEventListener("DOMContentLoaded", function() {
        const toaster = document.getElementById("toaster");

        <?php if (isset($_SESSION['toaster_message'])) { ?>
            toaster.innerText = "<?php echo $_SESSION['toaster_message']; ?>";
            toaster.classList.add("show");
            <?php if ($_SESSION['toaster_type'] == "error") { ?>
                toaster.classList.add("error");
            <?php } ?>
            
            setTimeout(() => {
                toaster.classList.remove("show");
            }, 5000); // Hide the message after 5 seconds

            // Clear the message after displaying it
            <?php unset($_SESSION['toaster_message']); ?>
            <?php unset($_SESSION['toaster_type']); ?>
        <?php } ?>
    });

        function resetTimer() {
    // Reset the timer on any activity
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        alert("You have been inactive for 10 minutes. You will be logged out.");
        window.location.href = "Logout.php"; 
    }, 3600000); 
}

// Listeners for user activities to reset the timer
document.onmousemove = resetTimer;
document.onkeydown = resetTimer;
document.onscroll = resetTimer;
document.onclick = resetTimer;

// Start the timer when the page loads
resetTimer();

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
