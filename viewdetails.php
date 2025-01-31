<?php
session_start();
require('database.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch profile data
$sqlProfile = "SELECT name, surname, dob, gender, race, maritalStatus, street, suburb, phoneNumber, email FROM profile";
$resultProfile = $conn->query($sqlProfile);

// Fetch work experience data
$sqlWorkExperience = "SELECT company, location, position, industry, reasonleaving, description FROM workexperience";
$resultWorkExperience = $conn->query($sqlWorkExperience);

// Fetch work experience data
$sqlEducation = "SELECT institution, studyField, qualification, graduationYear FROM academicrecord";
$resultEducation = $conn->query($sqlEducation);


// Fetch Language  data
$sqlLanguage = "SELECT language, speak, writing, reading FROM language";
$resultLanguage = $conn->query($sqlLanguage);

// Fetch Skills  data
$sqlSkills = "SELECT skills, rating, otherSkills FROM softskills";
$resultSkills = $conn->query($sqlSkills);

// Fetch resume data (assuming table `resumes` with columns `id`, `name`, and `file_path`)
$sql = "SELECT file_name, file_path FROM upload WHERE user_id = ?"; // Use a parameterized query for security
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$userId = 1; // Replace with the actual user ID
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $resumeName = $row['file_name'];
    $resumePath = $row['file_path'];
} else {
    $resumeName = null;
    $resumePath = null;
}

$stmt->close();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Graduate Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
            background-image: url('images/mict-logo3.jpg'); /* Path to your background image */
        background-size: cover; /* Ensure the image covers the entire background */
        background-position: center; /* Centers the image */
        background-attachment: fixed; /* Keeps the image in place while scrolling */
        background-repeat: no-repeat; /* Avoids repeating the background */
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .status {
            color: red;
            margin-bottom: 20px;
        }

        .dropdown {
            margin-bottom: 10px;
        }

        .dropdown button {
            width: 100%;
            background-color: #003366;
            color: white;
            border: none;
            padding: 10px;
            text-align: left;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        .dropdown-content {
            display: none;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f1f1f1;
            margin-top: 5px;
        }

        .dropdown button:focus + .dropdown-content {
            display: block;
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

    footer {
        text-align: center;
        padding: 20px;
        background-color: #f1f1f1;
        margin-top: 20px;
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
    
      
</nav>

</section>
</header>
    <div class="container">
        <div class="header">My Application</div>
        <div class="status">Application Status</div>

        <div class="dropdown">
            <button onclick="toggleDropdown('info')">My Information</button>
            <div class="dropdown-content" id="info">
                <?php
                if ($resultProfile && $resultProfile->num_rows > 0) {
                    $row = $resultProfile->fetch_assoc();
                    echo "<p><strong>Legal Name:</strong> " . htmlspecialchars($row['name']) . "</p>";
                    echo "<p><strong>Surname:</strong> " . htmlspecialchars($row['surname']) . "</p>";
                    echo "<p><strong>Date Of Birth:</strong> " . htmlspecialchars($row['dob']) . "</p>";
                    echo "<p><strong>Gender:</strong> " . htmlspecialchars($row['gender']) . "</p>";
                    echo "<p><strong>Race:</strong> " . htmlspecialchars($row['race']) . "</p>";
                    echo "<p><strong>Maritial Status:</strong> " . htmlspecialchars($row['maritalStatus']) . "</p>";
                    echo "<p><strong>Address:</strong> " . htmlspecialchars($row['street']) . "</p>";
                    echo "<p><strong>Suburb:</strong> " . htmlspecialchars($row['suburb']) . "</p>";
                    echo "<p><strong>Phone:</strong> " . htmlspecialchars($row['phoneNumber']) . "</p>";
                    echo "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
                 
                } else {
                    echo "<p>No profile data found.</p>";
                }
                ?>
            </div>
        </div>

        <div class="dropdown">
            <button onclick="toggleDropdown('work')">Work Experience</button>
            <div class="dropdown-content" id="work">
                <?php
                if ($resultWorkExperience && $resultWorkExperience->num_rows > 0) {
                    while ($row = $resultWorkExperience->fetch_assoc()) {
                        echo "<p><strong>Company:</strong> " . htmlspecialchars($row['company']) . "</p>";
                        echo "<p><strong>Location:</strong> " . htmlspecialchars($row['location']) . "</p>";
                        echo "<p><strong>Position:</strong> " . htmlspecialchars($row['position']) . "</p>";
                        echo "<p><strong>Industry:</strong> " . htmlspecialchars($row['industry']) . "</p>";
                        echo "<p><strong>Reason for Leaving:</strong> " . htmlspecialchars($row['reasonleaving']) . "</p>";
                        echo "<p><strong>Description:</strong> " . htmlspecialchars($row['description']) . "</p><hr>";
                    }
                } else {
                    echo "<p>No work experience data found.</p>";
                }
                ?>
            </div>
        </div>

        <div class="dropdown">
            <button onclick="toggleDropdown('education')">Education</button>
            <div class="dropdown-content" id="education">
                <!-- Content for Education -->
                <?php
                if ($resultEducation && $resultEducation->num_rows > 0) {
                    while ($row = $resultEducation->fetch_assoc()) {
                        echo "<p><strong>Institution:</strong> " . htmlspecialchars($row['institution']) . "</p>";
                        echo "<p><strong>Study Field:</strong> " . htmlspecialchars($row['studyField']) . "</p>";
                        echo "<p><strong>Qualification:</strong> " . htmlspecialchars($row['qualification']) . "</p>";
                        echo "<p><strong>Graduation Year:</strong> " . htmlspecialchars($row['graduationYear']) . "</p>";
                        
                    }
                } else {
                    echo "<p>No Academic Record data found.</p>";
                }
                ?>
            </div>
        </div>

        <div class="dropdown">
            <button onclick="toggleDropdown('languages')">Languages</button>
            <div class="dropdown-content" id="languages">
                <!-- Content for Languages -->
                <?php
                if ($resultLanguage && $resultLanguage->num_rows > 0) {
                    while ($row = $resultLanguage->fetch_assoc()) {
                        echo "<p><strong>Language:</strong> " . htmlspecialchars($row['language']) . "</p>";
                        echo "<p><strong>Speaking?:</strong> " . htmlspecialchars($row['speak']) . "</p>";
                        echo "<p><strong>Writing?:</strong> " . htmlspecialchars($row['writing']) . "</p>";
                        echo "<p><strong>Reading?:</strong> " . htmlspecialchars($row['reading']) . "</p>";
                        
                    }
                } else {
                    echo "<p>No Academic Record data found.</p>";
                }
                ?>
            </div>
        </div>

        <div class="dropdown">
            <button onclick="toggleDropdown('skills')">Skills</button>
            <div class="dropdown-content" id="skills">
                <!-- Content for Skills -->
                <?php
                if ($resultSkills && $resultSkills->num_rows > 0) {
                    while ($row = $resultSkills->fetch_assoc()) {
                        echo "<p><strong>Skills:</strong> " . htmlspecialchars($row['skills']) . "</p>";
                        echo "<p><strong>Rating?:</strong> " . htmlspecialchars($row['rating']) . "</p>";
                        echo "<p><strong>Other Skills:</strong> " . htmlspecialchars($row['otherSkills']) . "</p>";
                        
                        
                    }
                } else {
                    echo "<p>No Skills data found.</p>";
                }
                ?>
            </div>
        </div>

        <div class="dropdown">
            <button onclick="toggleDropdown('resume')">Resume/CV</button>
            <div class="dropdown-content" id="resume">
                <!-- Content for Resume/CV -->
                <?php if ($resumePath): ?>
        <p><strong>Resume Name:</strong> <?= htmlspecialchars($resumeName) ?></p>
        <a href="<?= htmlspecialchars($resumePath) ?>" download>Download Resume</a>
    <?php else: ?>
        <p>No resume found for this user.</p>
    <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown(id) {
            const content = document.getElementById(id);
            const isVisible = content.style.display === 'block';

            document.querySelectorAll('.dropdown-content').forEach(el => el.style.display = 'none');

            if (!isVisible) {
                content.style.display = 'block';
            }
        }
    </script>

      <!-- Footer Section -->
      <footer class="footer">
        <div class="credit">&copy; copyright @ 2024 by <span>MICT SETA</span> all rights reserved!</div>
    </footer>
</body>
</html>
