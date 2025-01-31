<?php
session_start();
require('database.php');

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch vacancy data from the database
$sql = "SELECT job_id, division, position, description FROM postjob"; // Ensure 'id' exists in the table
$result = $conn->query($sql);

$vacancies = [];

if ($result->num_rows > 0) {
    // Store data into an array
    while($row = $result->fetch_assoc()) {
        $vacancies[] = $row;
    }
} else {
    echo "0 results";
}

$conn->close();
?>
<style>
        header {
            background-image: url(images/mictsetalogo.png);
            background-repeat: no-repeat;
            width: 100%;
            height: 90px;
            margin-bottom: 0px;
        }
        .navbar {
            margin-left: 35%;
            margin-right: 0px;
            padding: 0px;
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

        input[type="submit"]{

            width: 100px;
            height: 40px;
        }
        .container {
    width: 80%;
    margin: 20px auto;
    max-width: 1000px;
}

.title {
    text-align: center;
    font-size: 2rem;
    margin-bottom: 30px;
}

.vacancy-card {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.vacancy-title {
    font-size: 1.8rem;
    font-weight: bold;
    color: #333;
}

.needed {
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 10px;
}

.description {
    font-size: 1rem;
    color: #444;
}

hr {
    border: none;
    height: 2px;
    background-color: #007bff;
    width: 50%;
    margin-top: 10px;
    margin-bottom: 10px;
}

    </style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/mict-logo4.jpg">
    
</head>
<body>

    <!-- header section starts-->

    <header class="header">

        <section class="flex">

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
                  
            </nav>

        </section>
    </header>

    <!-- header section ends-->

    <!-- home section starts-->

    <div class="home-container">
        <section class="home">
            <form id="categoryForm" onsubmit="return redirectToPage()">
                <h3>Find your next job</h3>

                <select name="title" id="categorySelect" class="input" required>
    <option value="" disabled selected>Select a Category</option>
    <option value="IT" >IT & Quality Management</option>
    <option value="Film & Electronic Media" >Film & Electronic Media</option>
    <option value="Human Resource" >Human Resources</option>
    <option value="MICT General" >MICT General</option>
    <option value="Supply Chain" >Supply Chain</option>
    <option value="Data & Analytics" >Data & Analytics</option>
</select>
                <input type="submit" class="btn">
            </form>
        </section>
    </div>

    <div class="container">
        <h1 class="title">Vacancy List</h1>
        <?php if (count($vacancies) > 0): ?>
            <?php foreach ($vacancies as $vacancy): ?>
                <div class="vacancy-card">
    <h2 class="vacancy-title">
    <a href="jobDetails.php?id=<?php echo $vacancy['job_id']; ?>"><?php echo htmlspecialchars($vacancy['division']); ?></a>
        </a>
    </h2>
    <p class="needed">Needed: <?php echo $vacancy['position']; ?></p>
    <p class="description"><?php echo $vacancy['description']; ?></p>
    <hr>
</div>

            <?php endforeach; ?>
        <?php else: ?>
            <p>No vacancies available.</p>
        <?php endif; ?>
    </div>
    </div>

    <script>
       function redirectToPage() {
        var category = document.getElementById("categorySelect").value;
        if (category === "IT") {
            window.location.href = "IT.php";
            return false;

 
        } else if(category ==="Film & Electronic Media"){
            window.location.href = "Media_Jobs.php";
              return false;

        }else if(category ==="Human Resource"){
        window.location.href = "HumanResource_Jobs.php";
        return false;

        }else if(category ==="MICT General"){
       window.location.href = "General.php"; 
       return false;

        }else if(category ==="Supply Chain"){
        window.location.href = "SupplyChain_Jobs.php"; 
        return false;

        }else if(category ==="Data & Analytics"){
        window.location.href = "IT_Jobs.php"; 
        return false;

        }else{
        alert("Please select a category.");
    }
  
};
    window.onload = function() {

window.history.pushState(null, null, window.location.href);


window.onpopstate = function() {

    window.history.pushState(null, null, window.location.href);

};
}; 
    </script>

    <footer class="footer">
        <section class="grid">
            <div class="box">
                <h3>Quick links</h3>
                <a href="Home.php"><i class="fas fa-angle-right"></i> Home</a>
           
            </div>
            <div class="box">
                <h3>Extra links</h3>
                <a href="About.php"><i class="fas fa-angle-right"></i> About Us</a>
                <a href="FAQ.php"><i class="fas fa-angle-right"></i> FAQ</a>
                <a href="FraudReport.php"><i class="fas fa-angle-right"></i> Report Fraud</a>
            </div>
            <div class="box">
                <h3>Follow us</h3>
                <a href="https://m.facebook.com/people/MICT-SETA/100064473800888/?locale=br_FR"><i class="fab fa-facebook-f"></i> Facebook</a>
                <a href="https://twitter.com/mictseta?lang=en"><i class="fa-brands fa-x-twitter"></i> X</a>
                <a href="https://www.instagram.com/mictseta/?hl=en#:~:text=MICT%20SETA%20(%40mictseta)%20%E2%80%A2%20Instagram%20photos%20and%20videos"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="https://za.linkedin.com/company/mict-seta"><i class="fab fa-linkedin"></i> LinkedIn</a>
                <a href="https://www.youtube.com/@mictseta2918"><i class="fab fa-youtube"></i> YouTube</a>
            </div>
        </section>
        <div class="credit" style="text-align:center;">&copy; copyright @ 2024 by <span>MICT SETA</span> All rights reserved!</div>
         </footer></div>

</body>
</html>
