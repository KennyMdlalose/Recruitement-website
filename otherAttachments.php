<?php
session_start();
require('database.php');

$message = '';
$id = $_SESSION['id_number'];

$sql = "SELECT * FROM upload WHERE id_number = '$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $id = $row['id_number'];

}


if(isset($_FILES['files']) && !empty($_FILES['files']['name'][0])){
    // Set the uploads path
    $folder = "Documents/";
    
    // The $_FILES variable holds a multidimensional array.
    $names = $_FILES['files']['name']; // array of file names
    $tmp_names = $_FILES['files']['tmp_name']; // array of temp file paths
    
    // Combine those two arrays into one.
    $upload_data = array_combine($tmp_names, $names);
    
    // Loop through the new array, move every file to the uploads folder and insert into the database.
    foreach ($upload_data as $temp_folder => $file) {
        // Move the file to the uploads folder.
        if(move_uploaded_file($temp_folder, $folder.$file)){
            // Prepare the SQL statement to insert the uploaded file into the upload table.
            $sql = "INSERT INTO upload (id_number,file_name, file_path) VALUES (?, ?, ?)";
            
            // Prepare and bind
            $stmt = $conn->prepare($sql);
            $file_path = $folder.$file;
            $stmt->bind_param("sss",$id, $file, $file_path);
            
               
                // Execute the query
                if ($stmt->execute()) {
                    $message .= "File uploaded successfully. ";
                    $_SESSION['toaster_message'] = "File & Details successfully.";
                    $_SESSION['toaster_type'] = "success";
                  } else {
                    $message .= "Failed to move file ";
                    $_SESSION['toaster_message'] = "Failed to move file ";
                    $_SESSION['toaster_type'] = "error";
                  }
              } else {
                $message .= "Error saving file '$file_path': " . mysqli_error($conn) . " ";
                $_SESSION['toaster_message'] = "Error saving file '$file_path' to the database: " . mysqli_error($conn);
                $_SESSION['toaster_type'] = "error";
              }
          }
    
    // Close the database connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Other Attachments</title>
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

        footer{
            margin-top: 200px;
        }

        .warning {
            text-align:center;
            color: red;
            margin-bottom: 10px;
            display: none; 
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

/* Toaster message styles */
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
                margin-top: 4rem;
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

    <section style="float: left;width: 20%;height: 700px; background:white;padding:5px;box-shadow: var(--box-shadow);font-size:larger;">
   

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
            <form action=" " method="Post" style="font-size: larger;" enctype="multipart/form-data">
          
            
            <h1>Upload Documents</h2> <br><br>


<div id="fileSizeWarning" class="warning">File size must not exceed 2MB!</div>

                <label for="myfile">CV: </label>
                <input type="file"  accept="application/pdf" name="files[]" id="files[]"onchange="validateFile(this)">
                <p>Maximum allowed file size is <strong>2MB</strong> </p><br>
                <label for="myfile">ID: </label>
                <input type="file"  accept="application/pdf" name="files[]" id="files[]" onchange="validateFile(this)">
                <p>Maximum allowed file size is <strong>2MB</strong> </p><br>
                <label for="myfile">Additional Document: </label>
                <input type="file"  accept="application/pdf" name="files[]" id="files[]" onchange="validateFile(this)">
                <p>Maximum allowed file size is <strong>2MB</strong> </p><br>
             


                <div class="button-container">
    <input type="submit" value="Save"  style="width: 100px;margin-left:300px;" onclick="Progress();" onclick="message();" onclick="resetTimer();">

                </div>

            </form>
        </div>
    </section>

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
            progressBar.value += 65;
        }
        if (progressBar.value === 100) {
            message.innerText = "Completion Status:100%";
      
  
        }else{
            message.innerText = "";
        }
    }
function message(){
    $message="Attachments saved ";
}

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

    <!-- contact us section ends-->
    <!--footer section starts-->
    <footer class="footer">
        <section class="grid">
            <div class="box">
                <h3>Quick link</h3>
                <a href="Profile.php"><i class="fas fa-angle-right"></i> Home</a>
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
        </section>
        <div class="credit">&copy; copyright @ 2024 by <span>THE HERD</span> all rights reserved!</div>
    </footer>
    <!--footer section ends-->

</body>
</html>