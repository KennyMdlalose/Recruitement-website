<?php
session_start();
require('database.php');

$id = $_SESSION['id_number']; // Logged-in user ID

// Fetch data from the database
$profileResult = mysqli_query($conn, "SELECT * FROM profile  WHERE id_number = '$id'");
$qualificationsResult = mysqli_query($conn, "SELECT * FROM academicrecord WHERE id_number = '$id'");
$languageResult = mysqli_query($conn, "SELECT * FROM language WHERE id_number = '$id'");
$skillsResult = mysqli_query($conn, "SELECT * FROM softskills WHERE id_number = '$id'");
$workResult = mysqli_query($conn, "SELECT * FROM workexperience, reference WHERE workexperience.id_number = '$id'");
$attachmentsResult = mysqli_query($conn, "SELECT * FROM attachments WHERE id_number = '$id'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: larger;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
            font-size: larger;
        }

        th {
            background-color: #f2f2f2;
            width: 150px;
        }

        tr:first-child th {
            background-color: #2b94da;
            color: white;
            text-align: center;
        }

        td {
            text-align: center;
        }

        .button-container {
            display: flex;
            gap: 40px;
            justify-content: center;
            margin-top: 1rem;
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

        label {
            font-size: larger;
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
<header class="header">
        <section class="flex">
            <nav class="navbar">
                <a href="Profile.php" style="margin-left:260px;">Home</a>
                <a href="jobList2.php">Job List</a>
                <a href="Contact.php">Contact Us</a>
                <a href="Logout.php">Logout</a>
            </nav>
        </section>
    </header>
    <br><br>

    <main>
        <!-- Section 1: Personal Details -->
        <section>
            <h2>Personal Details</h2>
            <table>
                <?php
                if ($profileResult && $row = mysqli_fetch_assoc($profileResult)) {
                    foreach ($row as $field => $value) {
                        echo "<tr><td>$field:</td><td>" . htmlspecialchars($value) . "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No data available.</td></tr>";
                }
                ?>
            </table>
        </section>

        <!-- Section 2: Qualifications -->
        <section>
            <h2>Qualifications</h2>
            <table>
                <?php
                if ($qualificationsResult && mysqli_num_rows($qualificationsResult) > 0) {
                    while ($row = mysqli_fetch_assoc($qualificationsResult)) {
                        foreach ($row as $field => $value) {
                            echo "<tr><td>$field:</td><td>" . htmlspecialchars($value) . "</td></tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='2'>No data available.</td></tr>";
                }
                ?>
            </table>
        </section>

        <!-- Section 3: Languages -->
        <section>
            <h2>Languages</h2>
            <table>
                <?php
                if ($languageResult && mysqli_num_rows($languageResult) > 0) {
                    while ($row = mysqli_fetch_assoc($languageResult)) {
                        foreach ($row as $field => $value) {
                            echo "<tr><td>$field:</td><td>" . htmlspecialchars($value) . "</td></tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='2'>No data available.</td></tr>";
                }
                ?>
            </table>
        </section>

        <!-- Section 4: Soft Skills -->
        <section>
            <h2>Soft Skills</h2>
            <table>
                <?php
                if ($skillsResult && mysqli_num_rows($skillsResult) > 0) {
                    while ($row = mysqli_fetch_assoc($skillsResult)) {
                        foreach ($row as $field => $value) {
                            echo "<tr><td>$field:</td><td>" . htmlspecialchars($value) . "</td></tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='2'>No data available.</td></tr>";
                }
                ?>
            </table>
        </section>

        <!-- Section 5: Work Experience and Attachments -->
        <section>
            <h2>Work Experience</h2>
            <table>
                <?php
                if ($workResult && mysqli_num_rows($workResult) > 0) {
                    while ($row = mysqli_fetch_assoc($workResult)) {
                        foreach ($row as $field => $value) {
                            echo "<tr><td>$field:</td><td>" . htmlspecialchars($value) . "</td></tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='2'>No data available.</td></tr>";
                }
                ?>
            </table>

            <h2>Attachments</h2>
            <table>
                <?php
                if ($attachmentsResult && mysqli_num_rows($attachmentsResult) > 0) {
                    while ($row = mysqli_fetch_assoc($attachmentsResult)) {
                        foreach ($row as $field => $value) {
                            echo "<tr><td>$field:</td><td>" . htmlspecialchars($value) . "</td></tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='2'>No data available.</td></tr>";
                }
                ?>
            </table>
        </section>

    </main>
      <!-- Footer Section -->
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
                <h3>Follow us</h3>
                <a href="https://m.facebook.com/people/MICT-SETA/100064473800888/?locale=br_FR"><i class="fab fa-facebook-f"></i> Facebook</a>
                <a href="https://twitter.com/mictseta?lang=en"><i class="fab fa-twitter"></i> Twitter</a>
                <a href="https://www.instagram.com/mictseta/?hl=en#:~:text=MICT%20SETA%20(%40mictseta)%20%E2%80%A2%20Instagram%20photos%20and%20videos"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="https://za.linkedin.com/company/mict-seta"><i class="fab fa-linkedin"></i> LinkedIn</a>
                <a href="https://www.youtube.com/@mictseta2918"><i class="fab fa-youtube"></i> YouTube</a>
            </div>
        </section>
        <div class="credit">&copy; copyright @ 2024 by <span>MICT SETA</span> all rights reserved!</div>
    </footer>
</body>
</html>

