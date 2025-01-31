<?php
session_start();
require('database.php');



// Display the data in a table
$id = $_SESSION['id_number'];
$query = "SELECT * FROM language WHERE id_number = '$id'"; 
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name = "viewport" content="width=device-width, initial-scale=1.0">
        <title>View Language</title>
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
          padding: 0px;
          margin-left: 40%;
        }
        h1{
            text-align: center;
            
        }

        label{
       font-size: larger;
        }

        .button-container {
                display: flex;
                gap: 40px;
                justify-content: center;
                margin-top: 1rem;
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


        </style>
        <!-- cust css file link-->
      

    </head>
    <body>
   
        <!-- header section starts-->

    <header class="header">

        <section class="flex">

        <nav class="navbar">
                <a href="Profile.php" style="margin-left:260px;">Home</a>
                <a href="jobList2.php">Job List</a>
                <a href="Contact.php">Contact Us</a>
                <a href="Logout.php">Logout</a>
                </div>
            </nav>
        

        </section>
    </header> <br><br>
</head>
<body>



<section  style="margin-left:-100px;">
        <div class="container">
        <h1>View Languages </h1>
        <form action="Language.php" method="POST" >
        
    
        <?php
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    echo '<table>';
    echo '<tr><th></th><th></th></tr>';

    echo '<tr><td>Language:</td><td>' . htmlspecialchars($row['language']) . '</td></tr>';
    echo '<tr><td>Speak:</td><td>' . htmlspecialchars($row['speak']) . '</td></tr>';
    echo '<tr><td>Write:</td><td>' . htmlspecialchars($row['writing']) . '</td></tr>';
    echo '<tr><td>Read:</td><td>' . htmlspecialchars($row['reading']) . '</td></tr>';
 
    echo '</td></tr>';

    echo '</table>';

    echo '<br><br>';

    
   
} else {
    echo '<div style="text-align: center; font-size: larger; margin-top: 20px;">No data available.</div>';
}
mysqli_close($conn);
?>

<div class="button-container">
    <input type="submit" value="Back"  style="width: 100px;margin-left:10px;">
    
                </div>

                </div>
        </form>

       
    </div>
    </section>
  



    <!-- contact us section ends-->

        <!--footer section starts-->

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

      

       
 
         
    </body>
</html>