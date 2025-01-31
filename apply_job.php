<?php
session_start();
require('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the job and user information from the form submission
    $job_division = $_POST['job_division'];
    $job_id = $_POST['job_id'];
    $job_position = $_POST['job_position'];
    $job_reference = $_POST['job_reference'];
    $user_email = $_POST['user_email'];

    // Fetch user's ID number from their profile (assuming you have a users table)
    $query = "SELECT id_number FROM profile WHERE email = '$user_email'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $id_number = $user['id_number'];  // Fetch the user's ID number

        // Insert the application into the applications table
        $sql = "INSERT INTO applications (job_division,job_id, job_position, job_reference, user_email, id_number, application_date) 
                VALUES ('$job_division','$job_id', '$job_position', '$job_reference', '$user_email', '$id_number', NOW())";

        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("Successfully applied for the job!"); window.location.href = "home.php";</script>';
        } else {
            echo '<script>alert("Error: Could not apply for the job."); window.location.href = "home.php";</script>';
        }
    } else {
        echo '<script>alert("Error: Could not retrieve user profile."); window.location.href = "home.php";</script>';
    }

    mysqli_close($conn);
} else {
    echo '<script>alert("Invalid request method."); window.location.href = "joblist2.php";</script>';
}
?>
