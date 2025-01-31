<?php
session_start();
require('database.php');

$toast_message = '';
$timeout_duration = 3600;

// Check session timeout
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

$id = $company = $position = $industry = $salary = $reasonleaving = $location = $startDate = $endDate = $description = $employmentStatus = '';
$referenceName = $relationship = $years = $phoneNumber = $email = '';

// Retrieve work experience and reference from the database if they exist
$sql = "SELECT * FROM workexperience WHERE id_number = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['id_number']);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $company = $row['company'];
    $position = $row['position'];
    $industry = $row['industry'];
    $salary = $row['salary'];
    $reasonleaving = $row['reason-leaving'];
    $location = $row['location'];
    $startDate = $row['startDate'];
    $endDate = $row['endDate'];
    $description = $row['description'];
    $employmentStatus = $row['employmentStatus'];
}

//$sql = "SELECT * FROM reference WHERE id_number = ?";
//$stmt = $conn->prepare($sql);
//$stmt->bind_param("s", $_SESSION['id_number']);
//$stmt->execute();
//$result = $stmt->get_result();
//if ($result->num_rows > 0) {
  //  $row = $result->fetch_assoc();
    //$referenceName = $row['referenceName'];
    //$relationship = $row['relationship'];
    //$years = $row['years'];
    //$phoneNumber = $row['phoneNumber'];
    //$email = $row['email'];
//}

// Process form submission (work experience and reference)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Work Experience section
    $company = $_POST['company'] ?? '';
    $position = $_POST['position'] ?? '';
    $industry = $_POST['industry'] ?? '';
    $salary = $_POST['salary'] ?? '';
    $reasonleaving = $_POST['reason-leaving'] ?? '';
    $location = $_POST['location'] ?? '';
    $startDate = $_POST['startDate'] ?? '';
    $endDate = $_POST['endDate'] ?? '';
    $description = $_POST['description'] ?? '';
    $employmentStatus = $_POST['employmentStatus'] ?? '';

    if (!empty($company) || !empty($position) || !empty($industry) || !empty($salary)) {
        if (empty($id)) {
            // Insert new work experience
            $sql = "INSERT INTO workexperience (company, position, industry, salary, reason-leaving, location, startDate, endDate, description, employmentStatus, id_number)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
           // $stmt->bind_param("ssssissssss", $company, $position, $industry, $salary, $reasonleaving, $location, $startDate, $endDate, $description, $employmentStatus, $_SESSION['id_number']);
        } else {
            // Update existing work experience
            $sql = "UPDATE workexperience SET company = ?, position = ?, industry = ?, salary = ?, reason-leaving = ?, location = ?, startDate = ?, endDate = ?, description = ?, employmentStatus = ? WHERE id_number = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssissssss", $company, $position, $industry, $salary, $reasonleaving, $location, $startDate, $endDate, $description, $employmentStatus, $_SESSION['id_number']);
        }

       // if ($stmt->execute()) {
       //     $toast_message = "Work Experience saved successfully";
       // } else {
     //       $toast_message = "Error: Unable to save Work Experience";
       // }
    } else {
        $toast_message = "Please fill in at least one field.";
    }

    // Reference section
    $referenceName = $_POST['reference'] ?? '';
    $relationship = $_POST['relationship'] ?? '';
    $years = $_POST['years'] ?? '';
    $phoneNumber = $_POST['phoneNumber'] ?? '';
    $email = $_POST['email'] ?? '';

    if (!empty($referenceName) || !empty($relationship) || !empty($years) || !empty($phoneNumber) || !empty($email)) {
        if (empty($id)) {
            // Insert new reference
            $sql = "INSERT INTO reference (reference, relationship, yearsAcquainted, phoneNumber, email, id_number)
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssissi", $referenceName, $relationship, $years, $phoneNumber, $email, $_SESSION['id_number']);
        } else {
            // Update existing reference
            $sql = "UPDATE reference SET reference = ?, relationship = ?, yearsAcquainted = ?, phoneNumber = ?, email = ? WHERE id_number = ?";
            $stmt->bind_param("ssissi", $referenceName, $relationship, $years, $phoneNumber, $email, $_SESSION['id_number']);
        }

        if ($stmt->execute()) {
            $toast_message = "Reference saved successfully";
        } else {
            $toast_message = "Error: Unable to save Reference";
        }
    } else {
        $toast_message = "Please fill in at least one field.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Experience</title>
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

        input,
        textarea,
        select {
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            width: 100%;
        }


        input[type="submit"] {
            background-color: #2b94da;
            color: #fff;
            cursor: pointer;
            margin-top: 1rem;
            padding: 1rem;
            border-radius: .5rem;
        }


        input[type="button"] {
            background-color: #2b94da;
            color: #fff;
            cursor: pointer;
            margin-top: 1rem;
            padding: 1rem;
            border-radius: .5rem;
        }

        .map-container {
            position: relative;
            overflow: hidden;
            padding-top: 75%;
            /* Aspect ratio 4:3 (adjust as needed) */
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

        .message {
            text-align: center;
            margin: top 10px;
            margin-bottom: 10px;
            color: green;
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
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: #4CAF50; /* Green */
        color: white;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 50%;
        bottom: 30px;
        font-size: 17px;
    }

    .toaster.show {
        visibility: visible;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    @keyframes fadein {
        from {bottom: 0; opacity: 0;}
        to {bottom: 30px; opacity: 1;}
    }

    @keyframes fadeout {
        from {bottom: 30px; opacity: 1;}
        to {bottom: 0; opacity: 0;}
    }
    </style>
    <!-- cust css file link-->


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
                </div>
            </nav>


        </section>
    </header> <br><br>
    </head>

    <body>

        <section style="float: left;width: 20%;height: 790px; background:white;padding:5px;box-shadow: var(--box-shadow);font-size:larger;">

        
            <br><br>
            <a href="Profile.php" style="color: black; "><i class="fa fa-user"></i> Profile</a>
            <br><br>
            <br><br>
            <a href="qualification.php" style="color: black;"><i class="fa fa-graduation-cap"></i> Academic Qualifications</a>
            <br><br>
            <br><br>
            <a href="Language.php" style="color: black;"><i class="fa fa-language"></i> Language Proficiency</a>
            <br><br>
            <br><br>
            <a href="workExperience.php" style="color: black;"><i class="fa fa-briefcase"></i> Working Experience</a>
            <br><br>
            <br><br>
            <a href="softSkills.php" style="color: black;"><i class="fa fa-cogs"></i> Soft Skills</a>
            <br><br>
            <br><br>
            <a href="otherAttachments.php" style="color: black;"><i class="fa fa-folder-open"></i> Other Attachments</a>
            <br><br>
            <br><br>
            <a href="appliedJob.php" style="color: black;"><i class="fa fa-bookmark"></i> Applied Jobs</a>
            <br><br>
            <br><br>
            <a href="settings.php" style="color: black;"><i class="fa fa-key"></i> Settings</a>
            <br><br>
            <br><br>
            <a href="Logout.php" style="color: black;"><i class="fa fa-sign-out"></i> Logout</a>
        </section>


        <section>
            <div class="container">
            <form action="#" method="POST" style="font-size:larger;">
    <h1>Work Experience </h1><br><br>

    <label>Company Name</label>
    <input class="form-control" type="text" name="company" id="company" value="<?php echo htmlspecialchars($company); ?>">

    <label>Position</label>
    <input type="text" id="position" name="position" value="<?php echo htmlspecialchars($position); ?>">

    <label>Industry</label>
    <input type="text" id="industry" name="industry" value="<?php echo htmlspecialchars($industry); ?>">

    <label>Previous Salary Range</label>
    <input type="number" id="salary" name="salary" value="<?php echo htmlspecialchars($salary); ?>">

    <label>Reason for Leaving?</label>
    <input type="text" id="reasonleaving" name="reasonleaving" value="<?php echo htmlspecialchars($reasonleaving); ?>">

    <label>Location</label>
    <input class="form-control" type="text" name="location" id="location" value="<?php echo htmlspecialchars($location); ?>">

    <label for="start-date">Start Date</label>
    <input type="date" id="startDate" name="startDate" value="<?php echo htmlspecialchars($startDate); ?>">

    <label for="end-date">End Date</label>
    <input type="date" id="endDate" name="endDate" value="<?php echo htmlspecialchars($endDate); ?>">

    <label for="description">Job Description</label>
    <textarea id="description" name="description" rows="4" cols="50"><?php echo htmlspecialchars($description); ?></textarea>

    <label for="employmentStatus">Currently Employed</label>
    <select name="employmentStatus" id="employmentStatus">
        <option value="" disabled <?php echo empty($employmentStatus) ? 'selected' : ''; ?>>Select</option>
        <option value="Yes" <?php echo ($employmentStatus == 'Yes') ? 'selected' : ''; ?>>Yes</option>
        <option value="No" <?php echo ($employmentStatus == 'No') ? 'selected' : ''; ?>>No</option>
    </select>

    <h1>References:</h1><br>

    <label>Reference Name</label>
    <input type="text" id="referenceName" name="referenceName" value="<?php echo htmlspecialchars($referenceName); ?>">

    <label>Relationship</label>
    <input type="text" id="relationship" name="relationship" value="<?php echo htmlspecialchars($relationship); ?>">

    <label>Years Known</label>
    <input type="number" id="years" name="years" value="<?php echo htmlspecialchars($years); ?>">

    <label>Phone Number</label>
    <input type="tel" id="phoneNumber" name="phoneNumber" value="<?php echo htmlspecialchars($phoneNumber); ?>">

    <label>Email</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">

    <div class="button-container">
    <input type="submit" value="Save" style="width: 100px; margin-left: 200px;">
    <input type="button" value="View" style="width: 100px; margin-left: 150px;" onclick="window.location.href='viewWorkExperience.php';">
</div><br><br>


</form>

                

            </div>
        </section>




        <!-- contact us section ends-->

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
                    <a href="https://twitter.com/mictseta?lang=en"><i class="fab fa-twitter"></i> twitter</a>
                    <a href="https://www.instagram.com/mictseta/?hl=en#:~:text=MICT%20SETA%20(%40mictseta)%20%E2%80%A2%20Instagram%20photos%20and%20videos"><i class="fab fa-instagram"></i> instagram</a>
                    <a href="https://za.linkedin.com/company/mict-seta"><i class="fab fa-linkedin"></i> linkedin</a>
                    <a href="https://www.youtube.com/@mictseta2918"><i class="fab fa-youtube"></i> youtube</a>

                </div>


                </div>
                <!--STOPPED HERE-->
            </section>

            <div class="credit">&copy; copyright @ 2024 by <span>THE HERD</span> all rights reserved!</div>

        </footer>

        <!--footer section ends-->



        <!-- cust js file link-->

        <script>
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
        </script>

    </body>

</html>