<?php
session_start();
require('database.php');


$id_number = $_SESSION['id_number'];  // Get the logged-in user's id_number

// Initialize variables to store form values
$language = $speak = $writing = $reading = $id_number = '';

// Fetch saved language details for the logged-in user
$sql = "SELECT language, speak, writing, reading FROM language WHERE id_number = '$id_number' LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $language = $row['language'];
    $speak = $row['speak'];
    $writing = $row['writing'];
    $reading = $row['reading'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Use either selected language or custom one if 'Other' is chosen
    $language = ($_POST['language'] == 'Other') ? $_POST['other_language'] : $_POST['language'];
    $speak = $_POST['speak'];
    $writing = $_POST['writing'];
    $reading = $_POST['reading'];

    if (!empty($language) && !empty($speak) && !empty($writing) && !empty($reading)) {
        // Update or insert the new language entry with the user's id_number
        $sql = "INSERT INTO language (id_number, language, speak, writing, reading) 
                VALUES ('$id_number', '$language', '$speak', '$writing', '$reading')
                ON DUPLICATE KEY UPDATE 
                language = '$language', speak = '$speak', writing = '$writing', reading = '$reading'";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['toaster_message'] = "Languages saved successfully";
            $_SESSION['toaster_type'] = "success";
        } else {
            $_SESSION['toaster_message'] = "Error: " . mysqli_error($conn);
        }
    } else {
        $_SESSION['message'] = "Please fill in all fields!";
    }

    header("Location: Language.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Languages</title>
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
                gap: 40px;
          
            }
       
        input[type="submit"], input[type="button"]{
                background-color:#2b94da;
                color: #fff;
                cursor: pointer;
                margin-top: 1rem;
                padding: 1rem ;
                border-radius: .5rem;
                margin-top: 40px;
            }
 

        .map-container {
            position: relative;
            overflow: hidden;
            padding-top: 75%;
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

        .button-container {
                display: flex;
                gap: 40px;
          
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
    opacity: 0; /* Start with hidden */
}

.toaster.error {
    background-color: #f44336; /* Red background for errors */
}

.toaster.show {
    transform: translateX(-50%) translateY(0); /* Move to the visible area */
    opacity: 1; /* Fully visible */
}

        @-webkit-keyframes fadein {
            from { bottom: 0; opacity: 0; }
            to { bottom: 30px; opacity: 1; }
        }

        @keyframes fadein {
            from { bottom: 0; opacity: 0; }
            to { bottom: 30px; opacity: 1; }
        }

        @-webkit-keyframes fadeout {
            from { bottom: 30px; opacity: 1; }
            to { bottom: 0; opacity: 0; }
        }

        @keyframes fadeout {
            from { bottom: 30px; opacity: 1; }
            to { bottom: 0; opacity: 0; }
        }
    </style>
</head>
<body>
    <header class="header">
        <section class="flex">
            <nav class="navbar">
                <a href="Profile.php" style="margin-left:260px;">Home</a>
                <a href="jobList2.php">Job List</a>
                <a href="Contact.php">Contact Us</a>
                <a href="Logout.php">Logout</a>
            </nav>
        </section>
    </header> <br><br>

    <section style="float: left;width: 20%;height: 750px; background:white;padding:5px;box-shadow: var(--box-shadow);font-size:larger;">

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

    </section>
    <div class="container">
    <h1>Language Proficiency</h1>

    <form action="Language.php" method="POST">
    <label for="language">Language</label>
    <select name="language" id="language"  onchange="toggleOtherLanguageField()">
        <option value="">Select</option>
        <option value="Afrikaans" <?php echo ($language == 'Afrikaans') ? 'selected' : ''; ?>>Afrikaans</option>
        <option value="English" <?php echo ($language == 'English') ? 'selected' : ''; ?>>English</option>
        <option value="isiNdebele" <?php echo ($language == 'isiNdebele') ? 'selected' : ''; ?>>isiNdebele</option>
        <option value="isiXhosa" <?php echo ($language == 'isiXhosa') ? 'selected' : ''; ?>>isiXhosa</option>
        <option value="isiZulu" <?php echo ($language == 'isiZulu') ? 'selected' : ''; ?>>isiZulu</option>
        <option value="Sesotho" <?php echo ($language == 'Sesotho') ? 'selected' : ''; ?>>Sesotho</option>
        <option value="Setswana" <?php echo ($language == 'Setswana') ? 'selected' : ''; ?>>Setswana</option>
        <option value="SiSwati" <?php echo ($language == 'SiSwati') ? 'selected' : ''; ?>>SiSwati</option>
        <option value="Tshivenda" <?php echo ($language == 'Tshivenda') ? 'selected' : ''; ?>>Tshivenda</option>
        <option value="Xitsonga" <?php echo ($language == 'Xitsonga') ? 'selected' : ''; ?>>Xitsonga</option>
        <option value="Sign Language" <?php echo ($language == 'Sign Language') ? 'selected' : ''; ?>>Sign Language</option>
        <option value="Other" <?php echo ($language == 'Other') ? 'selected' : ''; ?>>Other</option>
    </select>

    <!-- Hidden input for specifying other languages -->
    <div id="other_language_field" style="display: <?php echo ($language == 'Other') ? 'block' : 'none'; ?>;">
        <label for="other_language">Specify Other Language</label>
        <input type="text" name="other_language" id="other_language" value="<?php echo ($language == 'Other') ? htmlspecialchars($language) : ''; ?>">
    </div>

    <label for="speak">Speak</label>
    <select name="speak" id="speak" required>
        <option value="None" <?php echo ($speak == 'None') ? 'selected' : ''; ?>>None</option>
        <option value="Fair" <?php echo ($speak == 'Fair') ? 'selected' : ''; ?>>Fair</option>
        <option value="Good" <?php echo ($speak == 'Good') ? 'selected' : ''; ?>>Good</option>
        <option value="Excellent" <?php echo ($speak == 'Excellent') ? 'selected' : ''; ?>>Excellent</option>
    </select>

    <label for="writing">Write</label>
    <select id="writing" name="writing" >
        <option value="None" <?php echo ($writing == 'None') ? 'selected' : ''; ?>>None</option>
        <option value="Fair" <?php echo ($writing == 'Fair') ? 'selected' : ''; ?>>Fair</option>
        <option value="Good" <?php echo ($writing == 'Good') ? 'selected' : ''; ?>>Good</option>
        <option value="Excellent" <?php echo ($writing == 'Excellent') ? 'selected' : ''; ?>>Excellent</option>
    </select>

    <label for="reading">Read</label>
    <select id="reading" name="reading" >
        <option value="None" <?php echo ($reading == 'None') ? 'selected' : ''; ?>>None</option>
        <option value="Fair" <?php echo ($reading == 'Fair') ? 'selected' : ''; ?>>Fair</option>
        <option value="Good" <?php echo ($reading == 'Good') ? 'selected' : ''; ?>>Good</option>
        <option value="Excellent" <?php echo ($reading == 'Excellent') ? 'selected' : ''; ?>>Excellent</option>
    </select>

    <div class="button-container">
        <input type="submit" value="Save" style="width: 100px; margin-left: 200px;" onclick="Progress();">
        <input type="button" value="View" style="width: 100px; margin-left: 150px;" onclick="window.location.href='viewLanguage.php';">
    </div>
</form>

</div>

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

function toggleOtherLanguageField() {
    var languageSelect = document.getElementById("language");
    var otherLanguageField = document.getElementById("other_language_field");

    if (languageSelect.value === "Other") {
        otherLanguageField.style.display = "block";
    } else {
        otherLanguageField.style.display = "none";
    }

           //Prevent user from using the click to go forward arrow
window.onload = function() {

window.history.pushState(null, null, window.location.href);


window.onpopstate = function() {

    window.history.pushState(null, null, window.location.href);
};
};


}
</script>

  <!--footer section starts-->

  <footer class="footer">
            <section class="grid">
                <div class="box">
                    <h3>Quick link</h3>
                    <a href="Home.php"><i class="fas fa-angle-right"></i> Home</a>
                    <a href="Login.php"><i class="fas fa-angle-right"></i> Logout</a>
                 
                </div>
                <div class="box">
                    <h3>Extra links</h3>
                    <a href="About2.php"><i class="fas fa-angle-right"></i>About us</a>
                    <a href="FAQ.php"><i class="fas fa-angle-right"></i>FAQ</a>
                    <a href="FraudReport.php"><i class="fas fa-angle-right"></i>Report Fraud</a>
                    </div>
                    <div class="box">
                        <h3>follow us</h3>
                        <a href="https://m.facebook.com/people/MICT-SETA/100064473800888/?locale=br_FR"><i class="fab fa-facebook-f"></i> facebook</a>
                    <a href="https://twitter.com/mictseta?lang=en"><i class="fa-brands fa-x-twitter"></i>X</a>
                    <a href="https://www.instagram.com/mictseta/?hl=en#:~:text=MICT%20SETA%20(%40mictseta)%20%E2%80%A2%20Instagram%20photos%20and%20videos"><i class="fab fa-instagram"></i> instagram</a>
                    <a href="https://za.linkedin.com/company/mict-seta"><i class="fab fa-linkedin"></i> linkedin</a>
                    <a href="https://www.youtube.com/@mictseta2918"><i class="fab fa-youtube"></i> youtube</a>

                    </div>
                    

                </div>
                <!--STOPPED HERE-->
            </section>

            <div class="credit">&copy; copyright @ 2024 by <span>THE HERD</span> all rights reserved!</div>

        </footer>
           
</body>
</html>