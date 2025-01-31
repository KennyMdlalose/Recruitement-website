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

// Initialize variables with session or default values
$id = $_SESSION['id_number'] ?? '';
$graduationYear = $_SESSION['graduationYear'] ?? '';
$otherGraduationYear = $_SESSION['otherGraduationYear'] ?? '';
$institution = $_SESSION['institution'] ?? '';
$otherInstitution = $_SESSION['otherInstitution'] ?? '';
$studyField = $_SESSION['studyField'] ?? '';
$qualification = $_SESSION['qualification'] ?? '';
$otherQualification = $_SESSION['otherQualification'] ?? '';
$message = '';

// Retrieve profile details from the database if the user is logged in
if (!empty($id)) {
    $sql = "SELECT * FROM academicrecord WHERE id_number = '$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $graduationYear = $row['graduationYear'];
        $institution = $row['institution'];
        $studyField = $row['studyField'];
        $qualification = $row['qualification'];

        $_SESSION['graduationYear'] = $graduationYear;
        $_SESSION['institution'] = $institution;
        $_SESSION['studyField'] = $studyField;
        $_SESSION['qualification'] = $qualification;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get POST data and sanitize it
    $graduationYear = !empty($_POST['graduationYear']) ? mysqli_real_escape_string($conn, $_POST['graduationYear']) : '';
    $otherGraduationYear = !empty($_POST['otherGraduationYear']) ? mysqli_real_escape_string($conn, $_POST['otherGraduationYear']) : '';
    $institution = !empty($_POST['institution']) ? mysqli_real_escape_string($conn, $_POST['institution']) : '';
    $otherInstitution = !empty($_POST['otherInstitution']) ? mysqli_real_escape_string($conn, $_POST['otherInstitution']) : '';
    $studyField = !empty($_POST['studyField']) ? mysqli_real_escape_string($conn, $_POST['studyField']) : '';
    $qualification = !empty($_POST['qualification']) ? mysqli_real_escape_string($conn, $_POST['qualification']) : '';
    $otherQualification = !empty($_POST['otherQualification']) ? mysqli_real_escape_string($conn, $_POST['otherQualification']) : '';

    // Store form data in session variables
    $_SESSION['graduationYear'] = $graduationYear;
    $_SESSION['otherGraduationYear'] = $otherGraduationYear;
    $_SESSION['institution'] = $institution;
    $_SESSION['otherInstitution'] = $otherInstitution;
    $_SESSION['studyField'] = $studyField;
    $_SESSION['qualification'] = $qualification;
    $_SESSION['otherQualification'] = $otherQualification;

    // Use "other" values if provided
    $graduationYear = ($graduationYear === 'Other') ? $otherGraduationYear : $graduationYear;
    $institution = ($institution === 'Other') ? $otherInstitution : $institution;
    $qualification = ($qualification === 'Other') ? $otherQualification : $qualification;

    // Insert the academic record into the database
    if (!empty($graduationYear) || !empty($institution) || !empty($studyField) || !empty($qualification)) {
        $sql = "INSERT INTO academicrecord (id_number, graduationYear, institution, studyField, qualification) 
                VALUES ('$id', '$graduationYear', '$institution', '$studyField', '$qualification')";

        if (mysqli_query($conn, $sql)) {
            $message = "Academic Qualifications saved successfully.";
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    } else {
        $message = "Please fill out at least one field.";
    }

    // File upload logic
    if (isset($_FILES['files']) && !empty($_FILES['files']['name'][0])) {
        $folder = "Uploads/";
        $names = $_FILES['files']['name'];
        $tmp_names = $_FILES['files']['tmp_name'];
        $upload_data = array_combine($tmp_names, $names);

        foreach ($upload_data as $temp_folder => $file) {
            if (move_uploaded_file($temp_folder, $folder . $file)) {
                $sql = "INSERT INTO upload (id_number, file_name, file_path) VALUES ('$id', ?, ?)";
                $stmt = $conn->prepare($sql);
                $file_path = $folder . $file;
                $stmt->bind_param("ss", $file, $file_path);

                if ($stmt->execute()) {
                    $message .= " File uploaded successfully.";
                } else {
                    $message .= " Failed to upload file.";
                }
            } else {
                $message .= " Failed to move file '$file'.";
            }
        }
    }
}
?>




<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name = "viewport" content="width=device-width, initial-scale=1.0">
        <title>Academic Qualification</title>
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
    
            .important{
    color: red;
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
    
            input,textarea, select {
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
       
        input[type="submit"]{
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

            header{
                background-image: url(images/mictsetalogo.png);
        background-repeat: no-repeat;
        width: 100%;
        height: 90px;
        margin-bottom: 0px;
       
       
        }

        .navbar{
          padding: 0px;
          margin-left: 40%;
        }
        h1{
            text-align: center;
            
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

<section  style="float: left;width: 20%;height: 680px; background:white;padding:5px;box-shadow: var(--box-shadow);font-size:larger;">

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


<section>
    <div class="container" style="font-size: larger;">
        <form action="" method="POST" enctype="multipart/form-data">
            <h1>Academic Qualifications</h1><br><br>

            <label>Graduation Year: </label>
            <select name="graduationYear" id="graduationYear" class="input" onchange="toggleOtherField('graduationYear', 'otherGraduationYearField')">
                <option value="" enabled>Select</option>
                <?php
                for ($year = 2000; $year <= 2024; $year++) {
                    echo "<option value='$year'" . ($graduationYear == $year ? 'selected' : '') . ">$year</option>";
                }
                ?>
                <option value="Other" <?php echo $graduationYear == 'Other' ? 'selected' : ''; ?>>Other</option>
            </select>
            <input type="text" name="otherGraduationYear" id="otherGraduationYearField" style="display: none;" placeholder="Enter other year" value="<?php echo htmlspecialchars($otherGraduationYear); ?>">

            <label>Institution: </label>
            <select name="institution" id="institution" class="input" onchange="toggleOtherField('institution', 'otherInstitutionField')">
                <option value="" enabled>Select</option>
                <option value="University of Cape Town" <?php echo $institution == 'University of Cape Town' ? 'selected' : ''; ?>>University of Cape Town</option>
                <option value="Vaal University of Technology" <?php echo $institution == 'Vaal University of Technology' ? 'selected' : ''; ?>>Vaal University of Technology</option>
                <option value="University of the Witwatersrand"<?php if($institution == 'University of Witwatersrand') echo 'selected'; ?>>University of Witwatersrand</option>
    <option value="Stellenbosch University"<?php if($institution == 'Stellenbosch University') echo 'selected'; ?>>Stellenbosch University</option>
    <option value="University of Pretoria"<?php if($institution == 'University ofPretoria') echo 'selected'; ?>>University of Pretoria</option>
    <option value="University of KwaZulu-Natal"<?php if($institution == 'University of KwaZulu-Natal') echo 'selected'; ?>>University of KwaZulu-Natal</option>
    <option value="University of Johannesburg"<?php if($institution == 'University of Cape Town') echo 'selected'; ?>>University of Cape Town</option>
    <option value="Rhodes University"<?php if($institution == 'Rhodes University') echo 'selected'; ?>>Rhodes University</option>
    <option value="North-West University"<?php if($institution == 'North-West University') echo 'selected'; ?>>North-West University</option>
    <option value="University of the Western Cape"<?php if($institution == 'University of the Western Cape') echo 'selected'; ?>>University of the Western Cape</option>
    <option value="University of South Africa (UNISA)"<?php if($institution == 'niversity of South Africa (UNISA)') echo 'selected'; ?>>niversity of South Africa (UNISA)</option>
    <option value="Nelson Mandela University"<?php if($institution == 'Nelson Mandela University') echo 'selected'; ?>>Nelson Mandela University</option>
    <option value="Cape Peninsula University of Technology"<?php if($institution == 'Cape Peninsula University of Technology') echo 'selected'; ?>>Cape Peninsula University of Technology</option>
    <option value="Durban University of Technology"<?php if($institution == 'Durban University of Technology') echo 'selected'; ?>>Durban University of Technology</option>
    <option value="Tshwane University of Technology"<?php if($institution == 'Tshwane University of Technology') echo 'selected'; ?>>Tshwane University of Technology</option>
    <option value="University of Limpopo"<?php if($institution == 'University of Limpopo') echo 'selected'; ?>>University ofLimpopo</option>
    <option value="University of Fort Hare"<?php if($institution == 'University of Fort Hare') echo 'selected'; ?>>University of Fort Hare/option>
    <option value="University of Zululand"<?php if($institution == 'University of Zululand') echo 'selected'; ?>>University of Zululand</option>
    <option value="Central University of Technology"<?php if($institution == 'Central University of Technology') echo 'selected'; ?>>Central University of Technology/option>
    <option value="Mangosuthu University of Technology"<?php if($institution == 'Mangosuthu University of Technology') echo 'selected'; ?>>Mangosuthu University of Technology</option>
   
                <option value="Other" <?php echo $institution == 'Other' ? 'selected' : ''; ?>>Other</option>
            
            </select>
            <input type="text" name="otherInstitution" id="otherInstitutionField" style="display: none;" placeholder="Enter other institution" value="<?php echo htmlspecialchars($otherInstitution); ?>">

            <label>Field of Study: </label>
            <input type="text" name="studyField" placeholder="Field of study" value="<?php echo htmlspecialchars($studyField); ?>">

            <label>Qualification: </label>
            <select name="qualification" id="qualification" class="input" onchange="toggleOtherField('qualification', 'otherQualificationField')">
                <option value="" enabled>Select</option>
                <option value="Grade 9 - 11" <?php echo $qualification == 'Grade 9 - 11' ? 'selected' : ''; ?>>Grade 9-12 Report Card</option>   
    <option value="N4"<?php echo $qualification == 'N4' ? 'selected' : ''; ?> >N4</option>
    <option value="N5"<?php echo $qualification == 'N5' ? 'selected' : ''; ?>>N5</option>
    <option value="N6" <?php echo $qualification == 'N6' ? 'selected' : ''; ?>>N6</option>
    <option value="Matric" <?php echo $qualification == 'Matric' ? 'selected' : ''; ?>>Matric</option>
   <option value="Diploma" <?php echo $qualification == 'Diploma' ? 'selected' : ''; ?>>Diploma</option>
    <option value="Bachelors" <?php echo $qualification == 'Bachelors' ? 'selected' : ''; ?>>Bachelors</option>
    <option value="Postgraduate" <?php echo $qualification == 'Postgraduate' ? 'selected' : ''; ?>>Postgraduate</option>
    <option value="Masters" <?php echo $qualification == 'Masters' ? 'selected' : ''; ?>>Masters</option>
    <option value="Honours" <?php echo $qualification == 'Honours' ? 'selected' : ''; ?>>Honours</option>
    <option value="Doctorate"<?php echo $qualification == 'Doctorate' ? 'selected' : ''; ?> >Doctorate</option>
             <option value="Other" <?php echo $qualification == 'Other' ? 'selected' : ''; ?>>Other</option>
            </select>
            <input type="text" name="otherQualification" id="otherQualificationField" style="display: none;" placeholder="Enter other qualification" value="<?php echo htmlspecialchars($otherQualification); ?>">

            <label>Attach your certificate: </label>
            <input type="file" accept="application/pdf" name="files[]" id="files[]" onchange="validateFile(this)">
            <label>Academic Transcript: </label>
  <input type="file"  accept="application/pdf" name="files[]" id="files[]" onchange="validateFile(this)"> 
            <p>Maximum allowed file size is <strong>2MB</strong></p><br><br>

            <div class="button-container">
                <input type="submit" value="Save" style="width: 100px; margin-left: 200px;">
                <input type="submit" value="View" style="width: 100px; margin-left: 150px;" onclick="window.location.href='viewQualification.php';">
            </div>
        </form>
    </div>
</section>
  

    </div>
  

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
                    

                </div>
                <!--STOPPED HERE-->
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


function Progress() {
        var progressBar = document.getElementById("progressBar");
        var message = document.getElementById("message");
        if (progressBar.value + 10 <= progressBar.max) {
            progressBar.value += 25;
        }
        if (progressBar.value === 25) {
            message.innerText = "Completion Status:25%";
      
  
        }else{
            message.innerText = "";
        }
    }

    
    function Progress() {
  alert("Academic Qualification saved successfully");
}

function toggleOtherField(selectedFieldId, otherFieldId) {
        const selectedField = document.getElementById(selectedFieldId);
        const otherField = document.getElementById(otherFieldId);
        if (selectedField.value === 'Other') {
            otherField.style.display = 'block';
        } else {
            otherField.style.display = 'none';
        }
    }

function validateForm() {
    var graduationYear = document.getElementById("graduationYear").value;
    var institution = document.getElementById("institution").value;
    var studyField = document.getElementById("studyField").value;
    var qualification = document.getElementById("qualification").value;
    var specifyInstitution = document.getElementById("specifyInstitution").value;
    var specifyQualification = document.getElementById("specifyQualification").value;
    var specifyInstitutionDiv = document.getElementById("specifyInstitutionDiv").style.display;
    var specifyQualificationDiv = document.getElementById("specifyQualificationDiv").style.display;

    if (graduationYear === "" || institution === "" || studyField === "" || qualification === "") {
        alert("Please fill out all required fields before submitting.");
        return false;
    }

    // Ensure "Please specify" is filled if "Other" is selected for institution
    if (specifyInstitutionDiv === "block" && specifyInstitution.trim() === "") {
        alert("Please specify the institution.");
        return false;
    }

    // Ensure "Please specify" is filled if "Other" is selected for qualification
    if (specifyQualificationDiv === "block" && specifyQualification.trim() === "") {
        alert("Please specify the qualification.");
        return false;
    }

    return true;
}

        function Progress() {
            var progressBar = document.getElementById("progressBar");
            var message = document.getElementById("message");
            if (progressBar.value + 10 <= progressBar.max) {
                progressBar.value += 25;
            }
            if (progressBar.value === 25) {
                message.innerText = "Completion Status:25%";
            } else {
                message.innerText = "";
            }
        }

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


function validateFile(input) {
            const maxSize = 2 * 1024 * 1024; // 2MB in bytes
            const warning = document.getElementById('fileSizeWarning');

            if (input.files && input.files[0]) {
                if (input.files[0].size > maxSize) {
                    warning.style.display = 'block'; // Show the warning message
                    input.value = ''; // Clear the file input
                    return false;
                } else {
                    warning.style.display = 'none'; // Hide the warning message if file is valid
                }
            }
        }

        function checkFileSize() {
            const fileInputs = document.querySelectorAll('input[type="file"]');
            for (let i = 0; i < fileInputs.length; i++) {
                if (!validateFile(fileInputs[i])) {
                    return false; // Prevent form submission if any file is invalid
                }
            }
            return true; // Allow form submission if all files are valid
        }

        </script>



    </body>
</html>