<?php
session_start();
require('database.php');

// Assuming user email is stored in session when the user logs in
$user_email = $_SESSION['email'] ?? ''; 

$result = mysqli_query($conn, "SELECT * FROM postJob WHERE division = 'General'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT & Quality Management</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/mict-logo4.jpg">
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-image: url('images/mict-logo3.jpg'); /* Path to your background image */
        background-size: cover; /* Ensure the image covers the entire background */
        background-position: center; /* Centers the image */
        background-attachment: fixed; /* Keeps the image in place while scrolling */
        background-repeat: no-repeat; /* Avoids repeating the background */
    }

    header {
        background-image: url(images/mictsetalogo.png);
        background-repeat: no-repeat;
        height: 90px;
    }

    h3 {
        text-align: center;
        font-size: 26px; /* Increased font size */
        color: #333;
    }

    .job-container {
        border: 1px solid #ccc;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        max-width: 100%;
        box-sizing: border-box;
    }

    .job-title {
        font-size: 36px; /* Increased font size */
        color: #333;
        margin: 0;
        text-align: center; /* Center align the job title */
    }

    .status {
        display: block;
        width: fit-content;
        padding: 5px 10px;
        background-color: #28a745;
        color: white;
        border-radius: 5px;
        font-weight: bold;
        text-align: center;
        margin: 10px auto;
    }

    .job-detail {
        margin: 12px 0;
        font-size: 18px;
    }

    .job-detail label {
        font-weight: bold;
    }

    .requirements-list {
        margin: 12px 0;
        padding-left: 20px;
        font-size: 18px;
    }

    footer {
        text-align: center;
        padding: 20px;
        background-color: #f1f1f1;
        margin-top: 20px;
    }

    .btn {
        display: block;
        margin: 20px auto;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-align: center;
        width: fit-content;
        font-size: 18px;
    }

    /* Style for the scrollable job listing container */
    .job-listing {
        max-height: 600px;
        overflow-y: auto;
        margin-bottom: 20px;
    }

    /* Ensure the job containers stack vertically */
    .job-container {
        margin-bottom: 20px;
    }

    /* Optional: Style the scrollbar */
    .job-listing::-webkit-scrollbar {
        width: 8px;
    }

    .job-listing::-webkit-scrollbar-thumb {
        background-color: #007bff;
        border-radius: 10px;
    }
    .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header class="header">

<section class="flex">


    <div id="menu-btn" class="fas fa-bars-staggered"></div>

    <a href="home.php" class="logo"> <img src="images/mict_logo-home.png" alt=""></a>

    

    <nav class="navbar">
    <a href="Home.php" style="margin-left:260px;">Home</a>
    <a href="jobList.php">Job List</a>
    <a href="Contact2.php">Contact Us</a>
    <div class="dropdown" >
        <a href="#" class="dropbtn">Login</a>
        <div class="dropdown-content">
            <a href="LoginApplicant.php">Applicant</a>
            <a href="LoginHR.php">Employer</a>
        </div>
    </div>
  
        <a href="RegisterApplicant.php">Register</a>
      
</nav>

</section>
</header>

    <!-- Home Section -->
    <section class="home">
        <div class="job-listing">
            <?php 
            if ($result && mysqli_num_rows($result) > 0) {
                $current_date = date('Y-m-d'); // Get today's date


                while($row = mysqli_fetch_assoc($result)) {
                    $job_end_date = $row['endDate'];
                    $is_expired = strtotime($job_end_date) < strtotime($current_date); // Check if the job is expired


                    echo '<form action="apply_job.php" method="post">';

                    echo '<div class="job-container">';
                    echo '<h1 class="job-title">'.$row['division'].'</h1>';

                     // Display status based on job expiration
                     if ($is_expired) {
                        echo '<span class="status" style="background-color: #dc3545;">Closed</span>';
                    } else {
                        echo '<span class="status">Hiring</span>';
                    }

                    

                    echo '<div class="job-detail"><label>Needed:</label> '.$row['vacancies'].'</div>';
                    echo '<div class="job-detail"><label>Position:</label> '.$row['position'].'</div>';
                    echo '<div class="job-detail"><label>Reference:</label> '.$row['reference'].'</div>';
                    echo '<div class="job-detail"><label>Job Type:</label> '.$row['emptype'].'</div>';
                    echo '<div class="job-detail"><label>Location:</label> '.$row['location'].'</div>';
                    echo '<div class="job-detail"><label>Start Date:</label> '.$row['startDate'].'</div>';
                    echo '<div class="job-detail"><label>End Date:</label> '.$row['endDate'].'</div>';
                    echo '<div class="job-detail"><label>Description:</label> '.htmlspecialchars($row['description']).'</div>';
                    echo '<div class="job-detail"><label>Requirements:</label></div>';
                    echo '<ul class="requirements-list">';
                    foreach (explode(',', $row['requirement']) as $requirement) {
                        echo '<li>'.htmlspecialchars(trim($requirement)).'</li>';
                    }
                    echo '</ul>';
                    echo '<div class="job-detail"><label>System Skills:</label> '.htmlspecialchars($row['system_skills']).'</div>';
                    echo '<div class="job-detail"><label>Behavioural Competencies:</label> '.htmlspecialchars($row['behavioural_competencies']).'</div>';
                    echo '<div class="job-detail"><label>Functional Competencies:</label> '.htmlspecialchars($row['functional_competencies']).'</div>';

                    // Form and button (disable if job is expired)
                    echo '<input type="hidden" name="job_division" value="'.htmlspecialchars($row['division']).'">';
                    echo '<input type="hidden" name="job_id" value="'.htmlspecialchars($row['job_id']).'">';
                    echo '<input type="hidden" name="job_position" value="'.htmlspecialchars($row['position']).'">';
                    echo '<input type="hidden" name="job_reference" value="'.htmlspecialchars($row['reference']).'">';
                    echo '<input type="hidden" name="user_email" value="'.htmlspecialchars($user_email).'">';

                    if ($is_expired) {
                        echo '<button type="button" class="btn" style="background-color: #6c757d; cursor: not-allowed;" disabled>Apply Now</button>';
                    } else {
                        echo '<input type="submit" value="Apply Now" class="btn">';
                    }

                    
                    
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo '<p style="text-align: center;">No data available</p>';
            }

            mysqli_close($conn);
            ?>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="credit">&copy; copyright @ 2024 by <span>MICT SETA</span> all rights reserved!</div>
    </footer>
</body>
</html>
