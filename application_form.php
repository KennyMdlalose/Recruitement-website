<?php
// Capture the job_id passed from the Apply button
$job_id = intval($_GET['job_id']);

if ($_GET) {
    // Retrieve data passed from the job listing page
    $job_division = htmlspecialchars($_GET['job_division']);
    $job_id = htmlspecialchars($_GET['job_id']);
    $job_position = htmlspecialchars($_GET['job_position']);
    $job_reference = htmlspecialchars($_GET['job_reference']);
    $user_email = htmlspecialchars($_GET['user_email']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questionnaire Form</title>
    <link rel="icon" href="images/mict-logo4.jpg">
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 50px auto; padding: 20px; background: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h1 { text-align: center; }
        form { display: flex; flex-direction: column; gap: 15px; }
        input, button { padding: 10px; font-size: 16px; }
    </style>
</head>
<body>
    <div class="container">
      
       
<form action="questions_page.php" method="GET">
    <h1>Questionnaire Form</h1>
    <p><strong>Position:</strong> <?= $job_position ?></p>
    <label for="applicant_name">Your Name:</label>
    <input type="text" id="applicant_name" name="applicant_name" required>
    <label for="applicant_email">Your Email:</label>
    <input type="email" id="applicant_email" name="applicant_email" value="<?= $user_email ?>" required>
    <label for="resume">Upload Resume:</label>
    <input type="file" id="resume" name="resume" required>
    
    <!-- Hidden fields to pass data -->
    <input type="hidden" name="job_id" value="<?= $job_id ?>">
    <input type="hidden" name="job_position" value="<?= $job_position ?>">

    <button type="submit">Next</button><button type="button" class="btn-close" onclick="window.location.href='jobList2.php';">Back</button>

</form>
    </div>
</body>
</html>
