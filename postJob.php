<?php

require('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form inputs
    $jobtype = $_POST['jobtype'];
    $division = $_POST['division'];
    $reference = $_POST['reference'];
    $position = $_POST['position'];
    $vacancies = $_POST['vacancies'];
    $emptype = $_POST['emptype'];
    $location = $_POST['location'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $renumeration = $_POST['renumeration']; // Fixed spelling here
    $description = $_POST['description'];
    $requirement = $_POST['requirement'];
    $system_skills = $_POST['system_skills'];
    $behavioural_competencies = $_POST['behavioural_competencies'];
    $functional_competencies = $_POST['functional_competencies'];

    // Insert the form data into the database
    $sql = "INSERT INTO postjob 
        (jobtype, division, reference, position, vacancies, emptype, location, startDate, endDate, renumeration, description, requirement, system_skills, behavioural_competencies, functional_competencies)
        VALUES 
        ('$jobtype', '$division', '$reference', '$position', '$vacancies', '$emptype', '$location', '$startDate', '$endDate', '$renumeration', '$description', '$requirement', '$system_skills', '$behavioural_competencies', '$functional_competencies')";

    // Check if the query is successful
  
    if (mysqli_query($conn, $sql)) {
           
        $_SESSION['toaster_message'] = "Job saved successfully";
        $_SESSION['toaster_type'] = "success";
       } else {
               $_SESSION['toaster_message'] = "Error: " . mysqli_error($conn);
           }
       } else {
           $_SESSION['message'] = "Please fill in all fields!";
       

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name="author" content="" />
  <link rel="stylesheet" href="style.css">
  <meta name='viewport' content='width=device-width, initial-scale=1'>

  <title>Dashboard</title>

  <link rel="icon" href="assets/images/mict-logo4.jpg">
  <!-- Plugin CSS -->
  <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/pagekit.min.css">
  <link rel="stylesheet" href="assets/plugins/font-awesome/css/all.min.css"> 
  <link rel="stylesheet" href="style.css">
  <!-- Custom styles for this template -->
  <link href="assets/css/custom.css" rel="stylesheet" />
</head>
<style>
/* Sidebar styles */
.secondary-sidebar {
    width: 250px; /* Adjusted width for better space */
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    background-color: #2b94da; /* Background color of the sidebar */
    padding: 0;
    overflow-y: auto;
}

.secondary-sidebar-bar {
    padding: 20px;
    text-align: center;
}

.secondary-sidebar-bar img {
    max-width: 100%;
    height: auto;
}

.secondary-sidebar-menu {
    padding: 0;
    margin: 0;
}

.accordion-menu {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.accordion-menu li {
    padding: 10px 20px;
    border-bottom: 1px solid #f1f1f1;
}

.accordion-menu li a {
    color: white;
    text-decoration: none;
    display: block;
    font-size: 16px;
    font-weight: bold;
}

.accordion-menu li a i {
    margin-right: 10px;
}

/* Hover effect for sidebar links */
.accordion-menu li a:hover {
    background-color: #1a6c99;
}

/* Active page link styling */
.accordion-menu li.active-page a {
    background-color: #1a6c99;
    color: #fff;
}

/* Page container margin adjustment */
.page-content {
    margin-left: 250px; /* Sidebar width offset */
    padding: 20px;
}

/* Post Job Container styling */
.container {
    max-width: 800px;
    background-color: #fff;
    padding: 30px; /* Increased padding for better spacing */
    margin: 20px auto;
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); /* Slight shadow for a modern look */
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 10px;
    font-weight: bold;
}

input, textarea, select {
    padding: 12px;
    margin-bottom: 18px;
    border: 1px solid #ccc;
    border-radius: 6px; /* Rounded inputs */
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #2b94da;
    color: #fff;
    cursor: pointer;
    padding: 10px 20px;
    border-radius: 6px;
    margin-top: 20px;
    width: fit-content;
    align-self: center; /* Center align submit button */
}

input[type="submit"]:hover {
    background-color: #1a6c99;
}

/* Text alignment and typography improvements */
h1, h3 {
    text-align: center;
    color: #2b94da;
}

textarea {
    height: 100px;
}

.container .message {
    text-align: center;
    color: green;
    margin-top: 20px;
}

/* Scrollbar for container */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-thumb {
    background-color: #888;
    border-radius: 8px;
}

::-webkit-scrollbar-thumb:hover {
    background-color: #555;
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
    transform: translateX(-50%) translateY(0); /* Move to the visible area */
    opacity: 1; /* Fully visible */
}
</style>

<body>
  <!-- Page Container -->
  <div class="page-container">
    <!-- Page Content -->
    <div class="page-content">

      <!-- Sidebar -->
     <!-- Sidebar -->
<div class="secondary-sidebar">
    <div class="secondary-sidebar-bar">
        <img class="logo-box" src="./assets/images/mictsetalogo.png" />
    </div>
    <div class="secondary-sidebar-menu">
        <ul class="accordion-menu">
            <li class="active-page">
                <a href="dashboard.php">
                    <i class="menu-icon fa fa-database"></i><span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="postJob.php">
                    <i class="menu-icon fa fa-folder"></i><span>Post Job</span>
                </a>
            </li>
            <li>
                <a href="manageJob.php">
                    <i class="menu-icon fas fa-briefcase"></i><span>Manage Jobs</span>
                </a>
            </li>
            <li>
                <a href="addUser.php">
                    <i class="menu-icon fa fa-user"></i><span>Add User</span>
                </a>
            </li>
            <li>
                <a href="applications-assessment.php">
                    <i class="menu-icon fa fa-folder"></i><span>Applications Assessment</span>
                </a>
            </li>
            <li>
                <a href="applicant-interview-result.php">
                    <i class="menu-icon fa fa-folder-open"></i><span>Applicant Interview Result</span>
                </a>
            </li>
            <li>
                <a href="onboard.php">
                    <i class="menu-icon fa fa-tasks"></i><span>Onboard</span>
                </a>
            </li>
        </ul>
    </div>
</div>

      <!-- Page Header -->
      <div class="page-header">

        <nav class="navbar navbar-default navbar-expand-md">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <div class="logo-sm">
                <a href="javascript:void(0)" id="sidebar-toggle-button"><i class="menu-icon fas fa-bars"></i></a>
            
                <a class="logo-box" href=""><span></span></a>
              </div>
              <button type="button" class="navbar-toggler collapsed" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
           
                <i class="fas fa-angle-down"></i>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->

            <div class="collapse navbar-collapse justify-content-between" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav mr-auto">
                <li class="collapsed-sidebar-toggle-inv"><a href="javascript:void(0)"
                    id="collapsed-sidebar-toggle-button"><i class="fas fa-bars"></i></a></li>
              </ul>
            </div>
         
            <p class="p-2 colour-theme"> <a href="Home.php"><span
                    class="colour-theme">LogOut</span></a></p>
       

          </div>
        </nav>

      </div><!-- /Page Header -->

      <!-- Page Inner -->
       
      <div class="page-inner no-page-title">
        <div id="main-wrapper">
          <div class="content-header">
          <div class="container">

            

    <form action=" " method="POST" style="font-size: larger;">
    <h1>Post Job</h1><br><br>

    <label for="jobtype">Job Type</label>
    <select id="jobtype" name="jobtype" required>
        <option value="#">Select type</option>
        <option value="internal">Internal</option>
        <option value="external">External</option>
        <option value="both">Both Internal and External</option>
    </select>
                
    <label for="division">Division</label>
    <select id="division" name="division" required>
        <option value="#">Select Division</option>
        <option value="Corporate">Corporate Services</option>
        <option value="Education">Education Training Quality Assurance</option>
        <option value="Human Resources">Human Resources</option>
        <option value="Learning Program">Learning Programmes</option>
        <option value="Marketing&Communications">Marketing & Communications</option>
        <option value="General">MICT General</option>
        <option value="Advertising">Advertising</option>
        <option value="Film&media">Film and Electronic Media</option>
        <option value="Data Analytics">Data Analytics</option>
        <option value="IT">Information Technology</option>
        <option value="Telecommunications">Telecommunications</option>
        <option value="QualityManagement">Quality Management & IT</option>
        <option value="Sector">Sector Skills Planning</option>
        <option value="SupplyChain">Supply Chain Management</option>
                    
      </select>
      <label for="reference">Reference Number</label>
    <input type="text" id="reference" name="reference" required>

    <label for="position">Job Position</label>
    <input type="text" id="position" name="position" required>

    <label for="vacancies">Number of Vacancies</label>
    <input type="number" id="vacancies" name="vacancies" value="1" min="1" max="10">
              
    <label for="emptype">Employment Type</label>
    <select id="emptype" name="emptype" required>
        <option value="#">Select Employment Type</option>
        <option value="permanent">Permanent Employment</option>
        <option value="Temporary">Temporary Employment</option>
        <option value="Contract">Contract Employment</option>
        <option value="Part-Time">Part-Time Employment</option>
        <option value="Freelance/Independent">Freelance/Independent Contractors</option>
        <option value="Internship">Internships/Apprenticeships</option>
        <option value="Casual">Casual Employment</option>
    </select>

    <label for="location">Location</label>
    <select id="location" name="location" required>
        <option value="#">Select Location</option>
        <option value="Head Office (Midrand, Gauteng)">Head Office (Midrand, Gauteng)</option>
        <option value="Regional Office (Durban, KwaZulu-Natal)">Regional Office (Durban, KwaZulu-Natal)</option>
        <option value="Regional Office (Cape Town, Western Cape)">Regional Office (Cape Town, Western Cape)</option>
        <option value="Regional Office (East London, Eastern Cape)">Regional Office (East London, Eastern Cape)</option>
        <option value="Satellite Office (Klerksdorp, North West)">Satellite Office (Klerksdorp, North West)</option>
        <option value="Regional Office (Free State)">Regional Office (Free State)</option>
                    
    </select>
                
    <label for="startDate">Job Posted Date</label>
    <input type="date" id="startDate" name="startDate" required>

    <label for="endDate">End Date</label>
    <input type="date" id="endDate" name="endDate" required>

    <label for="remuneration">All-Inclusive Remuneration (TCTC per annum)</label>
    <input type="text" id="renumeration" name="renumeration" placeholder="R331 034.00 – R447 780.00">

    <label for="description">Job Description</label>
    <textarea id="description" name="description" required></textarea>

    <label for="requirement">Minimum Requirement</label>
    <textarea id="requirement" name="requirement" required></textarea>

    <label for="system_skills">System Skills</label>
    <input type="text" id="system_skills" name="system_skills" placeholder="Microsoft Office, SAGE">

    <label for="behavioural_competencies">Behavioural Competencies</label>
    <textarea id="behavioural_competencies" name="behavioural_competencies"></textarea>

    <label for="functional_competencies">Functional Competencies</label>
    <textarea id="functional_competencies" name="functional_competencies"></textarea>

    <div style="text-align:center;margin-top:10px;margin-bottom:10px;">
        <?php
        if (isset($message)) {
            echo $message;   
        }
        ?>
    </div>
    <input type="submit" value="Post Job">
            </form>
        </div>
    </section>


        

        <div class="page-footer"> 
 
        <div class="credit" style="text-align:center;">&copy; copyright @ 2024 by <span>THE HERD</span> All rights reserved!</div>
        </div>
      </div><!-- /Page Inner -->

    </div><!-- /Page Content --> 
  </div><!-- /Page Container -->
 

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
  <script src="assets/plugins/jquery/jquery-3.5.1.min.js"></script>
  <script src="assets/plugins/jquery/jquery.slimscroll.min.js"></script>
  <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/pagekit.min.js"></script>

  <script src='assets/plugins/charts/Chart.bundle.min.js'></script>
  <script src="assets/js/custom.js"></script>

</body>

</html> 