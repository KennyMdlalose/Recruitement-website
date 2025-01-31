<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name = "viewport" content="width=device-width, initial-scale=1.0">
        <title>Report Fraud</title>
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
                margin: 20px auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    
           
            input[type="submit"]{
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
    
        </style>
  
      

    </head>
    <body>

        <!-- header section starts-->

    <header class="header">

        <section class="flex">


        <div id="menu-btn" class="fas fa-bars-staggered"></div>
    
    <a href="home.php" class="logo"> <img src="images/mict_logo-home.png" alt=""></a>

    <nav class="navbar">
    <a href="Home.php" style="margin-left:260px;">Home</a>
    <a href="joblist.php">Job List</a>
    <a href="Contact.php">Contact Us</a>
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


    <!-- contact us section starts-->

   

       
</head>
<body>
  

    <section class="about">

  
        <div class="box">
            <h3>Report Fraud</h3>
            <p style="text-align:center;">About the Facility</p>

<p> The MICT SETA established a whistleblowing hotline facility for anonymous reporting of any founded or suspected allegations of fraud/corruption, to assist with its efforts of combating and preventing acts of dishonesty, unethical behaviour or favouritism.</p>

<p>What to report?</p>

<p>Stakeholders are encouraged to utilise this hotline facility for reporting of, but not limited to the following: </p>



  <p>1. Fraud, corruption or theft </p>
  <p>2. Contract and/or procurement irregularities </p>
  <p>3. Conflicts of interest </p>
  <p>4. Harassment </p>
  <p>5. Discrimination </p>
  <p>6. Nepotism </p>
  <p>7. Misuse of property </p>
  <p>8. Misconduct </p>
  <p>9. Maladministration </p>
  <p>10. Abuse of authority </p>
  <p>11. Mismanagement of funds </p>
  <p>13. Any unethical or illegal actions </p>
  <p>14.  Any other related information that may assist with combating and prevention of dishonesty, unethical behaviour and favouritism. </p>

</p>

<p>Will I be protected from victimisation?</p>

<p>All disclosures made through this facility will be completely anonymous and protected from any form of victimisation in line with the Protected Disclosures Act, Act 26 of 2000.</p>

<p>How to report allegations of fraud/corruption? </p>

<p>Any allegations of fraud/corruption as defined above are encouraged to be reported through the anonymous MICT SETA Whistle Blowing email at mict@thehotline.co.za in English or Free Call on 0800 053 927. </p>

<p>Reports may also be made in any of the other official languages of the Republic of South Africa during workdays, between 08:00 am and 16:30 pm. </p>

<p> Fraud and corruption is everyone’s business, report it, do not support it!</p>
          
        </div>
    </section>

 


    <!-- contact us section ends-->

        <!--footer section starts-->

        <footer class="footer">
            <section class="grid">
                <div class="box">
                    <h3>Quick link</h3>

                    <a href="Home.php"><i class="fas fa-angle-right"></i> Home</a>
                 
                  
                  
                 
                </div>
                <div class="box">
                    <h3>Extra links</h3>
               
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
                    

                </div>
                <!--STOPPED HERE-->
            </section>

            <div class="credit">&copy; copyright @ 2024 by <span>THE HERD</span> All rights reserved!</div>

        </footer>

        <!--footer section ends-->



        <!-- cust js file link-->

        <script src="js/script.js"></script>

    </body>
</html>