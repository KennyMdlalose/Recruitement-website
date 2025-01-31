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
       
        </section>
    </header> <br><br>

    <section style="float: left;width: 20%;height:300px; background:white;padding:5px;box-shadow: var(--box-shadow);font-size:larger;">

    
<br>
<a href="dashBoard.php" style="color: black;"><i class="fa fa-user"></i>DashBoard</a>
<br><br>
<br><br>
<a href="HR.php" style="color: black;"><i class="fa fa-user"></i> Post Job</a>
<br><br>
<br><br>
<a href="changePassword2.php" style="color: black;"><i class="fa fa-key"></i> Change Password</a>
<br><br>
<br><br>
<a href=" " style="color: black;"><i class="fa fa-folder"></i>View Applied Job</a>
<br><br>
<br><br>
        <a href="Logout.php" style="color: black;" ><i class="fa fa-sign-out"></i> Logout</a>
    </section>

    <section>
        <div class="container">
            <form action="#" method="post" style="font-size:larger;">
                <h1>Change Password</h1><br><br>
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your new password">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Enter your new password">
                <div class="button-container">
                    <input type="update" value="Update" onclick="myFunction()">
                    <input type="cancel" value="Cancel">
                </div>
            </form>
        </div>
    </section>

    <script>
        function myFunction() {
  alert("Password updated successfully");
  
}

</script>

    <!-- contact us section ends-->
    <!--footer section starts-->
    <footer class="footer">
        <section class="grid">
            <div class="box">
                <h3>Quick link</h3>
                <a href="Logout.php"><i class="fas fa-angle-right"></i> Logout</a>
            </div>
            <div class="box">
                <h3>Extra links</h3>
                <a href=" "><i class="fas fa-angle-right"></i>Help</a>
           
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

    <!-- cust js file link-->
    <script src="js/script.js"></script>
</body>
</html>
