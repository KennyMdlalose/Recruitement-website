<?php
session_start();
require('database.php');

$timeout_duration = 360000; 

if (isset($_SESSION['last_activity'])) {
    $session_age = time() - $_SESSION['last_activity'];
    if ($session_age > $timeout_duration) {
        session_unset();
        session_destroy();
        header("Location: Logout.php");
        exit;
    }
}

// Always fetch the application data
$sql = "SELECT id_number, job_division, job_position, job_status, application_date FROM applications";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_number'];  // Get the application ID
    $action = $_POST['action']; // Get the selected action from the dropdown

    if ($action == 'withdraw') {
        // SQL query to delete the application by its ID
        $delete_query = "DELETE FROM applications WHERE id_number = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            $_SESSION['toaster_message'] = "Application withdrawn successfully";
            $_SESSION['toaster_type'] = "success";
        } else {
            $_SESSION['toaster_message'] = "Error: " . mysqli_error($conn);
            $_SESSION['toaster_type'] = "error";
        }
    } elseif ($action == 'view') {
        // SQL query to fetch the details of the selected application
        $details_query = "SELECT * FROM applications WHERE id_number = ?";
        $stmt = $conn->prepare($details_query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $details_result = $stmt->get_result();

        if ($details_result->num_rows > 0) {
            $application_details = $details_result->fetch_assoc();
            // You can now display the details of the application
            // Redirect to the detailed page or display details in the same page
            header("Location: viewDetails.php?id_number=$id");
            exit;
        } else {
            $_SESSION['toaster_message'] = "No details found for the selected application.";
            $_SESSION['toaster_type'] = "error";
        }
    }

    header("Location: appliedJob.php");  // Redirect after the action to prevent form resubmission
    exit;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applied Job</title>
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
            max-width: 1300px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 250px;
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

        input[type="update"], input[type="cancel"] {
            background-color: #2b94da;
            color: #fff;
            cursor: pointer;
            padding: 1rem;
            border-radius: .5rem;
            width: 100px;
            text-align: center;
            border: none; 
            margin-left: 180px;
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
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}


table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 12px;
    text-align: left;
}

th {
    background-color: #f4f4f4;
}

select {
    padding: 5px;
}
.toaster {
    position: fixed;
    top: 20px; 
    left: 50%; 
    transform: translateX(-50%) translateY(-100%); 
    padding: 15px 20px;
    background-color: #4CAF50; 
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
    transform: translateX(-50%) translateY(0); 
    opacity: 1; 
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

    <section style="float: left;width: 20%;height:600px; background:white;padding:5px;box-shadow: var(--box-shadow);font-size:larger;">


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
        <form action="appliedJob.php" method="post" style="font-size:larger; margin-left: 100px;">
            <h1>My Applications</h1><br>
            <table>
                <thead>
                    <tr>
                        <th>Job Department</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Application Date</th>
                        <th>Available Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['job_division'] . "</td>";
                            echo "<td>" . $row['job_position'] . "</td>";
                            echo "<td>" . $row['job_status'] . "</td>";
                            echo "<td>" . $row['application_date'] . "</td>";
                            echo "<td>
                                    <form action='appliedJob.php' method='post'>
                                        <input type='hidden' name='id_number' value='" . $row['id_number'] . "' />
                                        <select name='action' onchange='this.form.submit()'>
                                            <option value=''>Select</option>
                                            <option value='view'>View Details</option>
                                            <option value='withdraw'>Withdraw Application</option>
                                        </select>
                                    </form>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' style='text-align:center;'>No applications found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
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


</script>
    <!-- cust js file link-->
    <script src="js/script.js"></script>
</body>
</html>