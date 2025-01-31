<?php
session_start();
require('database.php');

$timeout_duration = 3600000; 

if (isset($_SESSION['last_activity'])) {
 
    $session_age = time() - $_SESSION['last_activity'];

  
    if ($session_age > $timeout_duration) {
        session_unset();    
        session_destroy();  
        header("Location: Logout.php"); 
        exit;
    }
}


// Function to derive DOB and gender from ID number
function derive_dob_gender($id) {
    $currentYear = (int)date('y') . substr($id, 0, 2) . '-' . substr($id, 2, 2) . '-' . substr($id, 4, 2);
    if (substr($id, 0, 2) >= $currentYear) {
        $dob = '19' . substr($id, 0, 2) . '-' . substr($id, 2, 2) . '-' . substr($id, 4, 2);
    } else {
        $dob = '20' . substr($id, 0, 2) . '-' . substr($id, 2, 2) . '-' . substr($id, 4, 2);
    }
    $gender = (int)substr($id, 6, 1) % 2 === 0 ? 'Female' : 'Male';
    $citizenship = (int)substr($id, 10, 1) === 0 ? 'South African Citizen' : 'Permanent Resident';

    return [$dob, $gender, $citizenship];
}

// Validation functions
function validate_text_only($input) {
    return preg_match('/^[a-zA-Z]+$/', $input);
}

function validate_numbers_only($input) {
    return preg_match('/^\d+$/', $input);
}

function validate_sa_phone_number($phoneNumber) {
    $valid_prefixes = ['060', '061', '062', '063', '064', '065', '066', '067', '068', '071', '072', '073', '074', '076', '078', '079', '081'];
    return preg_match('/^\d{10}$/', $phoneNumber) && in_array(substr($phoneNumber, 0, 3), $valid_prefixes);
}

$id = $title = $name = $surname = $initials = $dob = $gender = $street = $suburb = $city = $postalCode = $province = $phoneNumber = $alternativeNumber = $citizenship = $race = $maritalStatus  = $disability = $disability_type = $disability_other = '';

// Fetch logged-in user's email from the session
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Retrieve profile details from the database for the logged-in user
    $sql = "SELECT * FROM profile WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id_number'];
        $title = $row['title'];
        $name = $row['name'];
        $surname = $row['surname'];
        $initials = $row['initials'];
        $dob = $row['dob'];
        $gender = $row['gender'];
        $street = $row['street'];
        $suburb = $row['suburb'];
        $city = $row['city'];
        $postalCode = $row['postalCode'];
        $province = $row['province'];
        $phoneNumber = $row['phoneNumber'];
        $alternativeNumber = $row['alternativeNumber'];
        $citizenship = $row['citizenship'];
        $race = $row['race'];
        $maritalStatus = $row['maritalStatus'];
        $disability = $row['disability'];
        $disability_type = $row['disability_type'];
        $disability_other = $row['disability_other'];
     
    } else {
        // Check if ID and email are provided in URL
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            list($dob, $gender, $citizenship) = derive_dob_gender($id);
        }
    }
}

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_number'];
    $title = $_POST['title'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $initials = $_POST['initials'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $street = $_POST['street'];
    $suburb = $_POST['suburb'];
    $city = $_POST['city'];
    $postalCode = $_POST['postalCode'];
    $province = $_POST['province'];
    $citizenship = $_POST['citizenship'];
    $race = $_POST['race'];
    $phoneNumber = $_POST['phoneNumber'];
    $alternativeNumber = $_POST['alternativeNumber'];
    $maritalStatus = $_POST['maritalStatus'];
    $disability = $_POST['disability'];
    $disability_type = $_POST['disability_type'];
    $disability_other = $_POST['disability_other'];
   
    // Validation
    if (strlen($id) !== 13) {
        $_SESSION['toaster_message'] = "ID must be exactly 13 characters long!";
        $_SESSION['toaster_type'] = "error";
    } elseif (!validate_text_only($name) || !validate_text_only($surname) || !validate_text_only($initials) || !validate_text_only($city)) {
        $_SESSION['toaster_message'] = "Name, Surname, Initials, and City must contain letters only!";
        $_SESSION['toaster_type'] = "error";
    } elseif (!validate_numbers_only($postalCode)) {
        $_SESSION['toaster_message'] = "Postal Code must contain numbers only!";
        $_SESSION['toaster_type'] = "error";
    } elseif (!validate_sa_phone_number($phoneNumber)) {
        $_SESSION['toaster_message'] = "Invalid South African phone number!";
        $_SESSION['toaster_type'] = "error";
    } elseif ($alternativeNumber && (!validate_numbers_only($alternativeNumber) || !validate_sa_phone_number($alternativeNumber))) {
        $_SESSION['toaster_message'] = "Alternative Number must be a valid South African phone number!";
        $_SESSION['toaster_type'] = "error";
    } else {
        // Check if profile exists, update if it does, otherwise insert new
        $sql = "SELECT * FROM profile WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Update existing profile
            $sql = "UPDATE profile SET 
                        title='$title', 
                        name='$name', 
                        surname='$surname', 
                        initials='$initials', 
                        dob='$dob', 
                        gender='$gender', 
                        street='$street', 
                        suburb='$suburb', 
                        city='$city', 
                        postalCode='$postalCode', 
                        province='$province', 
                        phoneNumber='$phoneNumber', 
                        alternativeNumber='$alternativeNumber', 
                        citizenship='$citizenship', 
                        race='$race', 
                        maritalStatus='$maritalStatus', 
                        disability='$disability', 
                        disability_type='$disability_type', 
                        disability_other='$disability_other'
                   
                    WHERE id_number='$id'";
        } else {
            // Insert new profile
            $sql = "INSERT INTO profile (email, id_number, title, name, surname, initials, dob, gender, street, suburb, city, postalCode, province, phoneNumber, alternativeNumber, citizenship, race, maritalStatus,disability, disability_type, disability_other) 
                    VALUES ('$email', '$id', '$title', '$name', '$surname', '$initials', '$dob', '$gender', '$street', '$suburb', '$city', '$postalCode', '$province', '$phoneNumber', '$alternativeNumber', '$citizenship', '$race', '$maritalStatus', '$disability', '$disability_type', '$disability_other')";
        }

        if (mysqli_query($conn, $sql)) {
            $_SESSION['toaster_message'] = "Details saved successfully";
            $_SESSION['toaster_type'] = "success";
            header("Location: Profile.php");
            exit();
        } else {
            $_SESSION['toaster_message'] = "Error: " . mysqli_error($conn);
            $_SESSION['toaster_type'] = "error";
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
        <title>Profile</title>
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
               border: 1px solid #ccc;
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

        label{
       font-size: larger;
        }

        .button-container {
                display: flex;
                gap: 40px;
          
            }


            table {
    width: 100%; 
    border-collapse: collapse;
    margin-top: 20px;
    table-layout: fixed; 
    margin-left: -60px;
}

th, td {
    border: 1px solid #ccc;
    padding: 15px; 
    text-align: left;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap; 
    width: 71px;
}



th {
    background-color: #f2f2f2;
    width: 71px;
}

.actions {
    display: flex;
    gap: 10px;
}

.edit {
    background-color: #2b94da;
    color: #fff;
    padding: 5px 10px;
    border: none;
    cursor: pointer;
    border-radius: 4px;
    text-decoration: none;
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


        </style>
        <!-- cust css file link-->
      

    </head>
    <body>
   
        <!-- header section starts-->

    <header class="header">

        <section class="flex">

        <nav class="navbar">
                <a href="home.php" style="margin-left:260px;">Home</a>
                <a href="jobList2.php">Job List</a>
                <a href="Contact.php">Contact Us</a>
                <a href="Logout.php">Logout</a>
                </div>
            </nav>
        

        </section>
    </header> <br><br>
</head>
<body>

<section  style="float: left;width: 20%;height: 1620px; background:white;padding:5px;box-shadow: var(--box-shadow);font-size:larger; border: 1px solid #ccc;">

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
    <form action="#" method="POST">
        <h1>Person Details</h1><br><br>

   
        <label for="id">ID Number</label>
        <input type="text"    name="id_number" id="id_number" maxlength="13" value="<?php echo htmlspecialchars($id); ?>" required readonly>

        <label for="name">Title</label>
        <select name="title" id="title" class="input">
            <option value="" disabled <?php echo empty($title) ? 'selected' : ''; ?>>Select</option>
            <option value="Mr" <?php echo ($title == 'Mr') ? 'selected' : ''; ?>>Mr</option>
            <option value="Ms" <?php echo ($title == 'Ms') ? 'selected' : ''; ?>>Ms</option>
            <option value="Mrs" <?php echo ($title == 'Mrs') ? 'selected' : ''; ?>>Mrs</option>
            <option value="Dr" <?php echo ($title == 'Dr') ? 'selected' : ''; ?>>Dr</option>
        </select>


        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>">

        <label for="surname">Surname</label>
        <input type="text" name="surname" id="surname" value="<?php echo htmlspecialchars($surname); ?>">

        <label for="name">Initials</label>
        <input type="text" name="initials" id="initials" value="<?php echo htmlspecialchars($initials); ?>" >

    
        <label for="dob">Date of Birth</label>
        <input type="date" name="dob" id="dob" value="<?php echo htmlspecialchars($dob); ?>" required readonly>
        <label for="gender">Gender</label>
        <input type="text" name="gender" id="gender" value="<?php echo htmlspecialchars($gender); ?>" required readonly>
        <label for="citizenship">Citizenship</label>
        <input type="text" name="citizenship" id="citizenship" value="<?php echo htmlspecialchars($citizenship); ?>" required readonly>

        <label>Race</label>
        <select name="race" id="race" class="input" onchange="toggleOtherRace()">
            <option value="" disabled <?php echo empty($race) ? 'selected' : ''; ?>>Select</option>
            <option value="African" <?php echo ($race == 'African') ? 'selected' : ''; ?>>African</option>
            <option value="White" <?php echo ($race == 'White') ? 'selected' : ''; ?>>White</option>
            <option value="Coloured" <?php echo ($race == 'Coloured') ? 'selected' : ''; ?>>Coloured</option>
            <option value="Indian" <?php echo ($race == 'Indian') ? 'selected' : ''; ?>>Indian</option>
            <option value="Other" <?php echo ($race == 'Other') ? 'selected' : ''; ?>>Other</option>
        </select>

          <!-- Hidden input for specifying other languages -->
    <div id="otherRace">
        <label for="otherRace">Specify Other Race</label>
        <input type="text" name="otherRace" id="otherRace">
    </div>


        <h1>Address</h1>


        <label for="street">Street Address</label>
        <input type="text" name="street" id="street" value="<?php echo htmlspecialchars($street); ?>">
        <label for="street">Suburb</label>
        <input type="text" name="suburb" id="suburb" value="<?php echo htmlspecialchars($suburb); ?>">
        <label for="city">City</label>
        <input type="text" name="city" id="city" value="<?php echo htmlspecialchars($city); ?>" >

    
        <label for="postal">Postal Code</label>
        <input type="text" name="postalCode" id="postalCode" pattern="\d*" maxlength="4" value="<?php echo htmlspecialchars($postalCode); ?>" >


        <label for="province">Province</label>
        <select name="province" id="province" class="input" >
            <option value="" disabled <?php echo empty($province) ? 'selected' : ''; ?>>Select</option>
            <option value="Gauteng" <?php echo ($province == 'Gauteng') ? 'selected' : ''; ?>>Gauteng</option>
            <option value="Eastern Cape" <?php echo ($province == 'Eastern Cape') ? 'selected' : ''; ?>>Eastern Cape</option>
            <option value="Western Cape" <?php echo ($province == 'Western Cape') ? 'selected' : ''; ?>>Western Cape</option>
            <option value="Northern Cape" <?php echo ($province == 'Northern Cape') ? 'selected' : ''; ?>>Northern Cape</option>
            <option value="Limpopo" <?php echo ($province == 'Limpopo') ? 'selected' : ''; ?>>Limpopo</option>
            <option value="Free State" <?php echo ($province == 'Free State') ? 'selected' : ''; ?>>Free State</option>
            <option value="Kwa-Zulu Natal" <?php echo ($province == 'Kwa-Zulu Natal') ? 'selected' : ''; ?>>Kwa-Zulu Natal</option>
            <option value="Mpumalanga" <?php echo ($province == 'Mpumalanga') ? 'selected' : ''; ?>>Mpumalanga</option>
            <option value="North West" <?php echo ($province == 'North West') ? 'selected' : ''; ?>>North West</option>
        </select>

        


        <label for="phoneNumber">Phone Number</label>
        <input type="tel" name="phoneNumber" id="phoneNumber" pattern="\d*" maxlength="10" value="<?php echo htmlspecialchars($phoneNumber); ?>" >
        <label for="phoneNumber">Alternative Number</label>
        <input type="tel" name="alternativeNumber" id="alternativeNumber" pattern="\d*" maxlength="10" value="<?php echo htmlspecialchars($alternativeNumber); ?>" >

        <label>Marital Status</label>
        <select name="maritalStatus" id="maritalStatus" class="input" >
            <option value="" disabled <?php echo empty($maritalStatus) ? 'selected' : ''; ?>>Select</option>
            <option value="Single" <?php echo ($maritalStatus == 'Single') ? 'selected' : ''; ?>>Single</option>
            <option value="Married" <?php echo ($maritalStatus == 'Married') ? 'selected' : ''; ?>>Married</option>
            <option value="Widowed" <?php echo ($maritalStatus == 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
            <option value="Divorced" <?php echo ($maritalStatus == 'Divorced') ? 'selected' : ''; ?>>Divorced</option>
        </select>


        <label for="disability">Do you have a disability?</label>
        <select name="disability" id="disability" onchange="toggleDisabilityType()" >
            <option value="">Select</option>
            <option value="Yes" <?php echo ($disability == 'Yes') ? 'selected' : ''; ?>>Yes</option>
            <option value="No" <?php echo ($disability == 'No') ? 'selected' : ''; ?>>No</option>
        </select>

        <div id="disabilityTypeContainer" style="display: <?php echo ($disability == 'Yes') ? 'block' : 'none'; ?>">
            <label for="disability_type">Type of Disability</label>
            <select name="disability_type" id="disability_type" onchange="toggleDisabilityOther()" 
                    <?php echo ($disability == 'Yes') ? 'required' : ''; ?>>
                <option value="">Select</option>
                <option value="Physical" <?php echo ($disability_type == 'Physical') ? 'selected' : ''; ?>>Physical</option>
                <option value="Visual" <?php echo ($disability_type == 'Visual') ? 'selected' : ''; ?>>Visual</option>
                <option value="Hearing" <?php echo ($disability_type == 'Hearing') ? 'selected' : ''; ?>>Hearing</option>
                <option value="Mental" <?php echo ($disability_type == 'Mental') ? 'selected' : ''; ?>>Mental</option>
                <option value="Other" <?php echo ($disability_type == 'Other') ? 'selected' : ''; ?>>Other</option>
            </select>

            <div id="disabilityOtherContainer" style="display: <?php echo ($disability_type == 'Other') ? 'block' : 'none'; ?>">
                <label for="disability_other">Specify Other Disability</label>
                <input type="text" name="disability_other" id="disability_other" value="<?php echo htmlspecialchars($disability_other); ?>">
            </div>
        </div>


    <div class="button-container">
    <input type="submit" value="Save"  style="width: 150px;margin-left:180px;font-size:medium;" onclick="Progress();" onclick="resetTimer();">
    <a href="viewProfile.php"  class="view" name="view" style="width: 130px;font-size:medium;">View Profile</a>
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

            <div class="credit">&copy; copyright @ 2024 by <span>MICT SETA</span> all rights reserved!</div>

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

               function Progress() {
        var progressBar = document.getElementById("progressBar");
        var message = document.getElementById("message");
        if (progressBar.value + 10 <= progressBar.max) {
            progressBar.value += 10;
        }
        if (progressBar.value == 10) {
            message.innerText = "Completion Status:10%";
      
  
        }else{
            message.innerText = "";
        }
    }

       
    function toggleDisabilityType() {
    var disability = document.getElementById('disability').value;
    var disabilityTypeContainer = document.getElementById('disabilityTypeContainer');
    var disabilityType = document.getElementById('disability_type');
    var disabilityOther = document.getElementById('disability_other');
    
    if (disability === 'Yes') {
        disabilityTypeContainer.style.display = 'block';
        disabilityType.required = true;
    } else {
        disabilityTypeContainer.style.display = 'none';
        disabilityType.required = false;
        disabilityType.value = '';
        disabilityOther.value = '';
        document.getElementById('disabilityOtherContainer').style.display = 'none';
    }
}

function toggleDisabilityOther() {
    var disabilityType = document.getElementById('disability_type').value;
    var disabilityOtherContainer = document.getElementById('disabilityOtherContainer');
    
    if (disabilityType === 'Other') {
        disabilityOtherContainer.style.display = 'block';
    } else {
        disabilityOtherContainer.style.display = 'none';
        document.getElementById('disability_other').value = '';
    }
}

// Initialize the form based on the current selection
toggleDisabilityType();
toggleDisabilityOther();


        function toggleCriminalRecordDetails() {
            var criminalRecord = document.getElementById('criminal_record').value;
            document.getElementById('criminalRecordDetailsContainer').style.display = criminalRecord === 'Yes' ? 'block' : 'none';
        }

        let timeout;

function resetTimer() {
    // Reset the timer on any activity
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        alert("You have been inactive for 30 minutes . You will be logged out.");
        window.location.href = "Logout.php"; 
    }, 3600000); 
}

document.onmousemove = resetTimer;
document.onkeydown = resetTimer;
document.onscroll = resetTimer;
document.onclick = resetTimer;


resetTimer();

function toggleOtherRace() {
            var languageSelect = document.getElementById("race");
            var otherLanguageField = document.getElementById("otherRace");

            if (languageSelect.value === "Other") {
                otherLanguageField.style.display = "block";
            } else {
                otherLanguageField.style.display = "none";
            }
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