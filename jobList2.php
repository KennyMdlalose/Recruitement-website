<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job List</title>
    <link rel="icon" href="images/mict-logo4.jpg">
    <link rel="stylesheet" href="style.css">
    <style>
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
               
.toaster {
    position: fixed;
    top: 20px; 
    left: 50%; 
    transform: translateX(-50%) translateY(-100%); 
    padding: 15px 20px;
    background-color: #4CAF50; 
    color: white;
    font-size: 16px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    z-index: 1000;
    transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
    opacity: 0; 
}

.toaster.error {
    background-color: #f44336; 
}

.toaster.show {
    transform: translateX(-50%) translateY(0); /* Move to the visible area */
    opacity: 1; /* Fully visible */
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
    
        <!-- header section starts-->

        <header class="header">

            <section class="flex">
    
    
                <div id="menu-btn" class="fas fa-bars-staggered"></div>
    
                <a href="home.html" class="logo"> <img src="images/mict_logo-home.png" alt=""></a>
    
                
                <nav class="navbar">
    <a href="Profile.php" style="margin-left:260px;">Home</a>
    <a href="jobList2.php">Job List</a>
    <a href="Contact.php">Contact Us</a>
    <a href="Logout.php">Logout</a>
    </div>
</nav>
    
    
            </section>
        </header>
    
    
        <!-- header section ends-->
    
    
        <!-- home section starts-->
    
        <div class="home-container">
            
        <section class="category">
    
          
                <h1 class="heading">Popular Job Categories</h1>
        <div class="box-container">
       
            <a href="Media_Jobs2.php" class="box">
                <i class="fa-solid fa-film"></i>
                <div>
                    <h3>Film & Electronic Media</h3>
                    <span></span>
                </div>
            </a>
          
            <a href="IT_Jobs2.php" class="box">
                <i class="fas fa-bullhorn"></i>
                <div>
                    <h3>IT & Quality Management</h3>
                    <span></span>
                </div>
            </a>
            <a href="HumanResource_Jobs2.php" class="box">
                <i class="fas fa-headset"></i>
                <div>
                    <h3>Human Resources</h3>
                    <span></span>
                </div>
            </a>
            <a href="General_Jobs2.php" class="box">
                <i class="fas fa-wrench"></i>
                <div>
                    <h3>MICT General</h3>
                    <span></span>
                </div>
            </a>
            <a href="SupplyChain_Jobs2.php" class="box">
                <i class="fas fa-shipping-fast"></i>
                <div>
                    <h3>Supply Chain Management</h3>
                    <span></span>
                </div>
            </a>
            <a href="Software_Jobs2.php" class="box">
                <i class="fa-solid fa-file"></i>
                <div>
                    <h3>Data & Analytics</h3>
                    <span></span>
                </div>
            </a>

            <a href="Corporate2.php" class="box">
                <i class="fa-solid fa-building"></i>
                <div>
                    <h3>Corporative Services</h3>
                    <span></span>
                </div>
            </a>

            <a href="Education2.php" class="box">
            <i class="fa-solid fa-chalkboard"></i>
                <div>
                    <h3>Education Training</h3>
                    <span></span>
                </div>
            </a>

            <a href="learnProgram2.php" class="box">
                <i class="fa-solid fa-book"></i>
                <div>
                    <h3>Learning Programs</h3>
                    <span></span>
                </div>
            </a>

            <a href="Advertising2.php" class="box">
                <i class="fa-solid fa-newspaper"></i>
                <div>
                    <h3>Advertising</h3>
                    <span></span>
                </div>
            </a>

            <a href="Telecommunication.php" class="box">
                <i class="fa-solid fa-mobile-alt"></i>
                <div>
                    <h3>Telecommunications</h3>
                    <span></span>
                </div>
            </a>

        </div>
              
                </section>
        
      >
    
        </div>
    
    
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
                        <a href="Help.php"><i class="fas fa-angle-right"></i>Help </a>
                        <a href="FAQ.php"><i class="fas fa-angle-right"></i>FAQ </a>
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
    
                <div class="credit">&copy; copyright @ 2024 by <span>MICT SETA</span> all rights reserved!</div>
    
            </footer>

            <div id="toaster" class="toaster"></div>
        <script >
               document.addEventListener("DOMContentLoaded", function() {
        const toaster = document.getElementById("toaster");

        <?php if (isset($_SESSION['toaster_message'])) { ?>
            toaster.innerText = "<?php echo $_SESSION['toaster_message']; ?>";
            toaster.classList.add("show");
            <?php if ($_SESSION['toaster_type'] == "error") { ?>
                toaster.classList.add("error");
            <?php } ?>
            
            setTimeout(() => {
                toaster.classList.remove("show");
            }, 5000); // Hide the message after 5 seconds

            // Clear the message after displaying it
            <?php unset($_SESSION['toaster_message']); ?>
            <?php unset($_SESSION['toaster_type']); ?>
        <?php } ?>
    });



            </script>
</body>
</html>