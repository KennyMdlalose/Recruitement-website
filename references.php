<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post job</title>
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
    </style>
</head>
<body>
    <!-- header section starts-->
    <header class="header">
        <section class="flex">
            <nav class="navbar">
                <a href="Profile.php" style="margin-left:260px;">Home</a>
                <a href="SearchjobIT.php">Job List</a>
                <a href="Contact.php">Contact Us</a>
                <a href="Logout.php">Logout</a>
            </nav>
        </section>
    </header> <br><br>

    <section style="float: left;width: 20%;height:500px; background:white;padding:5px;box-shadow: var(--box-shadow);font-size:larger;">
<br><br>
<progress id="progressBar" value="0" max="100" style="width:210px; margin-left:10px;"></progress>   
<br><br>
<p id="message" style="margin-left:40px;">Completion Status:0%</p>
<br><br>
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
<a href="references.php"  style="color: black;"><i class="fa fa-users"></i> References</a>
<br><br>
<br><br>
<a href="workExperience.php"  style="color: black;"><i class="fa fa-briefcase"></i> Working Experience</a>
<br><br>
<br><br>
<a href="otherAttachments.php"  style="color: black;"><i class="fa fa-folder-open"></i> Other Attachments</a>
<br><br>
<br><br>
<a href="appliedJob.php"  style="color: black;"><i class="fa fa-bookmark"></i> Applied Jobs</a>
<br><br>
<br><br>
<a href="changePassword.php" style="color: black;"><i class="fa fa-key"></i> Settings</a>
<br><br>
<br><br>
<a href="Logout.php"   style="color: black;" ><i class="fa fa-sign-out"></i> Logout</a>
    </section>

    <section>
        <div class="container">
            <form action="#" method="post" style="font-size:larger;">
                <h1>Add Reference </h1><br><br>
                <div>
                <label>Referee Name</label>
                <input class="form-control" placeholder="Enter referee name" type="text" name="name" required> 
                </div>
                <div>
                <label>Referee Email</label>
                <input class="form-control" placeholder="Enter referee email" type="email" name="email" required> 
                </div>
                <div>
                <label>Referee Title</label>
                <input class="form-control" placeholder="Enter referee title" type="text" name="title" required> 
                </div>
                <div>
                <label>Referee Phone</label>
                <input class="form-control" placeholder="Enter referee phone" type="text" name="phone" required> 
                </div>
                <div>
                <label>Institution Name</label>
                <input class="form-control" placeholder="Enter institution name" type="text" name="institution" required>    
                </div>
                <input type="update" value="Update" onclick="Progress()" style="margin-left:350px;">
            </form>
        </div>
    </section>

    <script>

function Progress() {
        var progressBar = document.getElementById("progressBar");
        var message = document.getElementById("message");
        if (progressBar.value + 10 <= progressBar.max) {
            progressBar.value += 45;
        }
        if (progressBar.value === 45) {
            message.innerText = "Completion Status:45%";
      
        }else{
            message.innerText = "";
        }
    }
</script>

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

 
</body>
</html>
