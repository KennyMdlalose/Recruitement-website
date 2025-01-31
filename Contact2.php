<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name = "viewport" content="width=device-width, initial-scale=1.0">
        <title>Contact Us</title>
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
        <!-- cust css file link-->
      

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


    <!-- contact us section starts-->

   

       
</head>
<body>

    <div class="container" style="font-size: larger;">
        <h2 style="margin-bottom: 10px;font-size: 20px;text-align: center;">Office Branches</h2>
        <div>
            <h3 style="margin-top: 15px;">Head Office, Midrand</h3>
            <address style="margin-top: 10px;">Block 2, Level 3 West P. O. Box 5585<br>
                HALFWAY HOUSE<br>
                1685 <br>
                Gallagher Convention Centre <br>
                Gallagher Estate <br>
                19 Richards Drive <br>
                Halfway House <br>
                MIDRAND <br>
                1685<br></address> 
            <p style="margin-top: 5px;">Tel: (011) 207 2600
                Fax: (011) 805 6833</p>
        </div>

        <div>
            <h3 style="margin-top: 10px;margin-bottom: 10px;">Regional Office, Durban</h3>
            <address> Bay House, P. O. Box 763<br>
                Durban<br>
                4000<br>
                KWAZULU-NATAL <br>
                333 Anton Lembede (Smith Street),<br>
                4 th Floor,<br>
                Durban<br>
                4001<br>
            </address>
            <p style="margin-top: 5px;">Tel: (031) 307 7248
                Fax: (031) 307 5842
                 Helvy Ndlovu</p>

        </div>
    </div class= "container" >

        <form style="font-size: larger;margin-left: 250px; width:60%">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="division">Division:</label>
            <select id="division" name="division"  required>
         <option value="">Selcet Division</option>  
        <option value="Corporate">Corporate Services</option>
        <option value="Education">Education Training Quality Assurance</option>
        <option value="marketing">Marketing & Communication</option>
        <option value="it">IT & Quality Management</option>
        <option value="ceo">Office of the CEO</option>
        <option value="HR">Human Resources</option>
        <!-- Add more options as needed -->
    </select>
            <label for="message">Your Message:</label>
            <textarea id="message" name="message" rows="4" required></textarea>



            <input type="submit"  onclick="myFunction()" value="Submit" class="btn" style="width: 100px;margin-left:300px;">

            
        </form>
    </div>

    <script>
        function myFunction() {
  alert("Submitted successfully");
}
    </script>
        <h2>Location on the Map</h2>
        <div class="map-container">
            <!-- Google Map iframe goes here -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12345.678901234567!2d0.000000!3d0.000000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDjCsDU1JzE1LjkiTiAwwrAwMScwMy45Ilc!5e0!3m2!1sen!2sus!4v1111111111111!5m2!1sen!2sus" allowfullscreen=" " loading="lazy" ></iframe>
        </div>
        
    </div>
    
    </section>



    <!-- contact us section ends-->

        <!--footer section starts-->

        <footer class="footer">
            <section class="grid">
                <div class="box">
                    <h3>Quick link</h3>
                   
                    <a href="Home.php"><i class="fas fa-angle-right"></i> Home</a>
                    <a href="Logout.php"><i class="fas fa-angle-right"></i> Logout</a>
                </div>
                <div class="box">
                    <h3>Extra links</h3>
                    <a href="Help.php"><i class="fas fa-angle-right"></i>Help</a>
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

            <div class="credit">&copy; copyright @ 2024 by <span>THE HERD</span> all rights reserved!</div>

        </footer>

        <!--footer section ends-->



        <!-- cust js file link-->

        <script >
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