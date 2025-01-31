<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'mict');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert responses into the database
$job_id = intval($_POST['job_id']);
$candidate_id = rand(1000, 9999); // Replace with actual candidate identifier logic

foreach ($_POST['responses'] as $question_id => $response) {
    $stmt = $conn->prepare("INSERT INTO responses (candidate_id, question_id, job_title, response_text) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $candidate_id, $question_id, $job_title, $response);
    $stmt->execute();
}

echo "Thank you for completing the application. Your responses have been submitted.";
?>
