<?php
session_start();
require('database.php');

$timeout_duration = 36000;

if (isset($_SESSION['last_activity'])) {
    $session_age = time() - $_SESSION['last_activity'];

    if ($session_age > $timeout_duration) {
        session_unset();
        session_destroy();
        header("Location: Logout.php");
        exit;
    }
}

$_SESSION['last_activity'] = time();


$id = $skills = $rating = $otherSkills = '';
$toast_message = '';


$sql = "SELECT * FROM softskills WHERE id_number = '$id'";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
   $row = mysqli_fetch_assoc($result);
   $id = $row['id_number'];
   $skills = $row['skills'];
   $rating = $row['rating'];
   $otherSkills = $row['otherSkills'];
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_number'];
    $skills = $_POST['skills'];
    $rating = $_POST['rating'];
    $otherSkills = $_POST['otherSkills'];


    $sql = "INSERT INTO softskills (id_number,skills,rating,otherSkills)
            VALUES ('$id','$skills', '$rating', '$otherSkills')";


if (mysqli_query($conn, $sql)) {
    $_SESSION['toaster_message'] = "Soft skills saved successfully";
    $_SESSION['toaster_type'] = "success";
    header("Location: softSkills.php");
    exit();
} else {
    $_SESSION['toaster_message'] = "Error: " . mysqli_error($conn);
    $_SESSION['toaster_type'] = "error";
}

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soft Skills</title>
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

     
        input[type="submit"],view{
                background-color:#2b94da;
                color: #fff;
                cursor: pointer;
                margin-top: 1rem;
                padding: 1rem ;
                border-radius: .5rem;
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


::-webkit-scrollbar {
  width: 10px;
}

::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 

::-webkit-scrollbar-thumb {
  background: #888; 
}


::-webkit-scrollbar-thumb:hover {
  background: #555; 
}

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

.view{
    background-color:#2b94da;
                color: #fff;
                cursor: pointer;
                margin-top: 1rem;
                margin-left: 100px;
                padding: 1rem ;
                border-radius: .5rem;
                width: 100px;
                height: 40px;
                text-align: center;
                font-size: larger;
}

    </style>
</head>
<body>
    <!-- header section starts-->
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

    
    <section style="float: left;width: 25%;height:1000px; background:white;padding:5px;box-shadow: var(--box-shadow);font-size:larger;">
        

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
    <h1>Soft Skills</h1><br><br>

    <div class="message">
        <?php
        if (isset($message)) {
            echo $message;
        } else {
            echo " ";
        }
        ?>
    </div><br><br>

    <!-- Select for Skills -->
    <label for="skills">Select Your Soft Skills:</label>
    <select id="skills" name="skills">
        <option value="">Select</option>
        <option value="Communication" <?php if ($skills == 'Communication') echo 'selected'; ?>>Communication</option>
        <option value="Teamwork" <?php if ($skills == 'Teamwork') echo 'selected'; ?>>Teamwork</option>
        <option value="Adaptability" <?php if ($skills == 'Adaptability') echo 'selected'; ?>>Adaptability</option>
        <option value="Problem-solving" <?php if ($skills == 'Problem-solving') echo 'selected'; ?>>Problem-Solving</option>
        <option value="Time-management" <?php if ($skills == 'Time-management') echo 'selected'; ?>>Time Management</option>
        <option value="Emotional-intelligence" <?php if ($skills == 'Emotional-intelligence') echo 'selected'; ?>>Emotional Intelligence</option>
        <option value="Leadership" <?php if ($skills == 'Leadership') echo 'selected'; ?>>Leadership</option>
        <option value="Conflict-resolution" <?php if ($skills == 'Conflict-resolution') echo 'selected'; ?>>Conflict Resolution</option>
        <option value="Creativity" <?php if ($skills == 'Creativity') echo 'selected'; ?>>Creativity</option>
        <option value="Work-ethic" <?php if ($skills == 'Work-ethic') echo 'selected'; ?>>Work Ethic</option>
        <option value="Networking" <?php if ($skills == 'Networking') echo 'selected'; ?>>Networking</option>
        <option value="Empathy" <?php if ($skills == 'Empathy') echo 'selected'; ?>>Empathy</option>
        <option value="Negotiation" <?php if ($skills == 'Negotiation') echo 'selected'; ?>>Negotiation</option>
        <option value="Attention-to-detail" <?php if ($skills == 'Attention-to-detail') echo 'selected'; ?>>Attention to Detail</option>
        <option value="Interpersonal-skills" <?php if ($skills == 'Interpersonal-skills') echo 'selected'; ?>>Interpersonal Skills</option>
    </select>

    <!-- Select for Rating -->
    <label for="rating">How proficient are you:</label>
    <select id="rating" name="rating">
        <option value="">Select</option>
        <option value="Beginner" <?php if ($rating == 'Beginner') echo 'selected'; ?>>Beginner</option>
        <option value="Intermediate" <?php if ($rating == 'Intermediate') echo 'selected'; ?>>Intermediate</option>
        <option value="Advanced" <?php if ($rating == 'Advanced') echo 'selected'; ?>>Advanced</option>
    </select>

    <!-- Textarea for Other Skills -->
    <label>Other Soft Skills (if any):</label>
    <textarea class="form-control" name="otherSkills" id="otherSkills"><?php echo htmlspecialchars($otherSkills); ?></textarea>

    <div style="text-align:center;margin: top 10px;margin-bottom:10px;"></div>

    <!-- Submit Button -->
    <div class="button-container">
        <input type="submit" value="Save" style="width: 100px;margin-left:200px;" onclick="Progress();" onclick="resetTimer();">
        <a href="viewSoftSkills.php" class="view" name="view">View</a>
    </div>
</form>

        </div>
    </section>




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
            
        function Progress() {
        var progressBar = document.getElementById("progressBar");
        var message = document.getElementById("message");
        if (progressBar.value + 10 <= progressBar.max) {
            progressBar.value += 35;
        }
        if (progressBar.value === 75) {
            message.innerText = "Completion Status:75%";
      
  
        }else{
            message.innerText = "";
        }
    }

    function resetTimer() {
    
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        alert("You have been inactive for 10 minutes. You will be logged out.");
        window.location.href = "Logout.php"; 
    }, 3600000); 
}


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
                <a href="https://twitter.com/mictseta?lang=en"><i class="fab fa-twitter"></i>X</a>
                <a href="https://www.instagram.com/mictseta/?hl=en#:~:text=MICT%20SETA%20(%40mictseta)%20%E2%80%A2%20Instagram%20photos%20and%20videos"><i class="fab fa-instagram"></i> instagram</a>
                <a href="https://za.linkedin.com/company/mict-seta"><i class="fab fa-linkedin"></i> linkedin</a>
                <a href="https://www.youtube.com/@mictseta2918"><i class="fab fa-youtube"></i> youtube</a>
            </div>
        </section>
        <div class="credit">&copy; copyright @ 2024 by <span>THE HERD</span> all rights reserved!</div>
    </footer>
    <!--footer section ends-->


</body>
</html>