<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name = "viewport" content="width=device-width, initial-scale=1.0">
        <title>Post job</title>
        <link rel="stylesheet" href="css/style.css">
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

        .navbar{
          margin-left: 60%;
        }
        h1{
            text-align: center;
        }
        </style>
        <!-- cust css file link-->
      

    </head>
    <body>

        <!-- header section starts-->

    <header class="header">

        <section class="flex">


            <nav class="navbar" >
                <a href="Applicant Home.html">home</a>
                <a href="apply.html">profile </a>
                <a href="Jobs.html">all jobs</a>
                <a href="About.html">about us</a>
                <a href="Contact.html">contact us</a>
            </nav>

        </section>
    </header> <br><br>
</head>
<body>




    <section class="job-posting-form" style="margin-top: 30px;font-size: larger;">
        <form action="#" method="post">
            <h1>Personal Information</h1><br><br>

            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname" required>


            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname" required>


            <label for="lname">ID Number or Passport:</label>
            <input type="text" id="lname" name="lname" required>




            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="4" required></textarea>

            <label for="gender">GENDER:</label>
            <select name="gender" id="gender">
                <option value="none"> - </option>
                <option value="university">Male</option>
                <option value="previousjob">Female</option>
            </select><br><br>


            <label for="work-experience" style="margin-bottom:10px;">Please select the race that you identitfy with:</label>
            <select name="work-experience" id="work-experience">
                <option value="none"> - </option>
                <option value="">Black</option>
                <option value="">White</option>
                <option value="">Coloured</option>
                <option value="">Indian</option>
               
            </select>
            

            <label for="disability">Disability:</label>
                <select name="disability" id="disability">
                    <option value="none"> - </option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>  <br><br>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
            
            <label for="lname">Contact Number:</label>
            <input type="text" id="lname" name="lname" required>

            <label for="lname">Alternative Number:</label>
            <input type="text" id="lname" name="lname" required>
            <h1>Job Specific Information</h1><br><br>

            <label for="salary-range">Expected salary:</label>
            <input type="text" id="salary-range" name="salary-range" required><br><br>
            <label for="work-experience">Work Exprerience:</label>
           
            <select name="work-experience" id="work-experience">
                <option value="none"> - </option>
                <option value="none">None</option>
                <option value="months">1-5 Months</option>
                <option value="years">1-4 years</option>
                <option value="above">5 years and above</option>
            </select>  
            
    
            
            <br><br>

            

            <h1>Upload Documents</h2> <br><br>

                <label for="myfile">Resume CV:</label>
                <input type="file" id="myfile" name="myfile"><br><br>
                <label for="myfile">Cover Letter:</label>
                <input type="file" id="myfile" name="myfile"><br><br>
                <label for="myfile">Additional Document:</label>
                <input type="file" id="myfile" name="myfile"><br><br>
             



            <button type="apply" onclick="myFunction()" class="btn">Save</button>
        </form>

    </section>
    <script>
        function myFunction() {
  alert("Successfully Saved");
  
}

</script>



    <!-- contact us section ends-->

        <!--footer section starts-->

        <footer class="footer">
            <section class="grid">
                <div class="box">
                    <h3>Company</h3>
                    <a href="ApplicantHome.html"><i class="fas fa-angle-right"></i>home</a>
                    <a href="about.html"><i class="fas fa-angle-right"></i>about us</a>
                    <a href="joblist.html"><i class="fas fa-angle-right"></i>all jobs</a>
                    <a href="contact.html"><i class="fas fa-angle-right"></i>contact us</a>
                 
                </div>
                <div class="box">
                    <h3>Quick links</h3>
                    <a href="indexLOGACC.html"><i class="fas fa-angle-right"></i> account</a>
                    <a href="indexlog.html"><i class="fas fa-angle-right"></i> login</a>
                    <a href="indexdashboardAPPLICANT.html"><i class="fas fa-angle-right"></i> applicant dashboard</a>
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

            <div class="credit">&copy; copyright @ 2023 by <span>THE HERD</span> all rights reserved!</div>

        </footer>

        <!--footer section ends-->



        <!-- cust js file link-->

        <script src="js/script.js"></script>

    </body>
</html>