<?php
session_start();
require('database.php');

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['email'])) {
    // Redirect to the login page with the current page as the redirect URL
    header("Location: LoginApplicant.php?redirect_to=" . urlencode($_SERVER['REQUEST_URI']));
    exit();
}

// Get the logged-in user's information from the session
$user_email = $_SESSION['email'];

$result = mysqli_query($conn, "SELECT * FROM postJob WHERE division = 'HumanResources'");

?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Human Resource</title>
    <link rel="icon" href="images/mict-logo4.jpg">
    <link rel="stylesheet" href="style.css">
    <style>
        header {
            background-image: url(images/mictsetalogo.png);
            background-repeat: no-repeat;
            width: 100%;
            height: 90px;
            margin-bottom: 0;
        }

        .navbar {
            margin-left: 35%;
            padding: 0;
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
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
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

        input[type="submit"] {
            width: 100px;
            height: 40px;
            cursor: pointer;
        }

        /* Container styling 
        .home-container {
            max-width: 1000px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            border: 1px solid #ccc;
        } */

        


        .home {
            width: max-content;
        }
        h3 {
            text-align: center;
            font-size: 24px;
        }

        p {
            font-size: 16px;
        }

        .job-container {
            width: 100%;
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .job-container p {
            margin-bottom: 10px;
        }

        .job-container p:last-child {
            margin-bottom: 0;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #f1f1f1;
            margin-top: 20px;
        }

        footer .grid {
            display: flex;
            justify-content: space-around;
        }

        footer .box {
            flex: 1;
            padding: 10px;
        }

        footer .box h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        footer .box a {
            display: block;
            margin-bottom: 5px;
            color: #333;
            text-decoration: none;
        }

        footer .box a:hover {
            color: #007bff;
        }

        footer .credit {
            margin-top: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    
        <!-- header section starts-->

        <header class="header">

            <section class="flex">
    
    
                <div id="menu-btn" class="fas fa-bars-staggered"></div>
    
                <a href="Home.php" class="logo"> <img src="images/mict_logo-home.png" alt=""></a>
    
                <nav class="navbar">
                <a href="Home.php" style="margin-left:260px;">Home</a>
                <a href="joblist.php">Job List</a>
                <a href="Contact2.php">Contact Us</a>
                <div class="dropdown" >
                    <a href="#" class="dropbtn">Login</a>
                    <div class="dropdown-content">
                        <a href="LoginApplicant.php">Applicant</a>
                        <a href="LoginHR.php">Employer</a>
                    </div>
                </div>
              
                    <a href="RegisterApplicant.php">Register</a>
                 
            </section>
        </header>
    
        <!-- header section ends-->
    
    
        <!-- home section starts-->
    
        <div class="home-container">
            
            <section class="home">
    
                <section class="home">
    
                    <form action="apply_job.php" method="post">
                        <h3>Human Resource</h3>


                        

<p>
<?php 
if ($result && mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        // Define a consistent style for both labels and items
          // Job ID for the specific job post
        
        $labelStyle = 'font-weight: bold; text-decoration-line: underline; text-align: center; font-size: 16px;'; // Customize the font size and style as needed
        $itemStyle = 'text-align: center; font-size: 16px;'; // Customize the font size to match the labels
        $containerStyle = 'border: 1px solid #ccc; padding: 20px; margin-bottom: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);'; // Container style

        echo '<div style="'.$containerStyle.'">';  // Start container div

        echo '<p style="'.$labelStyle.'">Job Type: </p>';
        echo '<p style="'.$itemStyle.'">'.htmlspecialchars($row['jobtype']).'</p><br>';

        echo '<p style="'.$labelStyle.'">Division: </p>';
        echo '<p style="'.$itemStyle.'">'.htmlspecialchars($row['division']).'</p><br>';

        echo '<p style="'.$labelStyle.'"> Reference: </p>';
        echo '<p style="'.$itemStyle.'">'.htmlspecialchars($row['reference']).'</p><br>';

        echo '<p style="'.$labelStyle.'">Job Position: </p>';
        echo '<p style="'.$itemStyle.'">'.htmlspecialchars($row['position']).'</p><br>';

        echo '<p style="'.$labelStyle.'">Number of Vacancies: </p>';
        echo '<p style="'.$itemStyle.'">'.htmlspecialchars($row['vacancies']).'</p><br>';

        echo '<p style="'.$labelStyle.'">Employment Type: </p>';
        echo '<p style="'.$itemStyle.'">'.htmlspecialchars($row['emptype']).'</p><br>';

        echo '<p style="'.$labelStyle.'">Job Location: </p>';
        echo '<p style="'.$itemStyle.'">'.htmlspecialchars($row['location']).'</p><br>';

        echo '<p style="'.$labelStyle.'">Start Date: </p>';
        echo '<p style="'.$itemStyle.'">'.htmlspecialchars($row['startDate']).'</p><br>';

        echo '<p style="'.$labelStyle.'">End Date: </p>';
        echo '<p style="'.$itemStyle.'">'.htmlspecialchars($row['endDate']).'</p><br>';

        echo '<p style="'.$labelStyle.'">All-Inclusive Remuneration (TCTC per annum): </p>';
        echo '<p style="'.$itemStyle.'">'.htmlspecialchars($row['remuneration']).'</p><br>';
        

        echo '<p style="'.$labelStyle.'">Job Description: </p>';
        echo '<p style="'.$itemStyle.'">'.htmlspecialchars($row['description']).'</p><br>';

        echo '<p style="'.$labelStyle.'">Job Requirement: </p>';
        echo '<p style="'.$itemStyle.'">'.htmlspecialchars($row['requirement']).'</p><br>';

        echo '<p style="'.$labelStyle.'">System Skills: </p>';
        echo '<p style="'.$itemStyle.'">'.htmlspecialchars($row['system_skills']).'</p><br>';

        echo '<p style="'.$labelStyle.'">Behavioural Competencies: </p>';
        echo '<p style="'.$itemStyle.'">'.htmlspecialchars($row['behavioural_competencies']).'</p><br>';

        echo '<p style="'.$labelStyle.'">Functional Competencies: </p>';
        echo '<p style="'.$itemStyle.'">'.htmlspecialchars($row['functional_competencies']).'</p><br>';

      

  

                  // Add hidden inputs to capture job information when applying
                  echo '
                  
                  <input type="hidden" name="job_id" value="'. htmlspecialchars($row['job_id']) .'">
                  <input type="hidden" name="job_position" value="'. htmlspecialchars($row['position']) .'">
                  <input type="hidden" name="job_reference" value="'. htmlspecialchars($row['reference']) .'">
                  <input type="hidden" name="user_email" value="'. htmlspecialchars($user_email) .'">
                  
                  <input type="submit" value="Apply Now" class="btn">';

                  echo '</div>';
              }
          } else {
              echo '<p>No jobs available at the moment.</p>';
          }

          mysqli_close($conn);
          ?>
</p>

                                          

                       
                           
                       
                        
                    </form>
                </section>
        
                </form>
            </section>
    
        </div>
    
        <script>
        function myFunction() {
  alert("Successfully Applied");
  
}

</script>

            <!--footer section starts-->
    
            <footer class="footer">
                <section class="grid">
                    <div class="box">
                        <h3>Quick links</h3>
                        <a href="Home.php"><i class="fas fa-angle-right"></i>Home</a>
                        <a href="Logout.php"><i class="fas fa-angle-right"></i>Logout</a>
                    </div>
    
                    <div class="box">
                        <h3>Extra links</h3>
                       
                        <a href=" "><i class="fas fa-angle-right"></i>FAQ </a>
                        <a href=" "><i class="fas fa-angle-right"></i>Report Fraud</a>
    
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
</body>
</html>