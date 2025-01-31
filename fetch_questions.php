<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'mict');

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['job_id'])) {
    $job_id = (int)$_GET['job_id'];

    // Fetch questions for the selected job
    $question_sql = "SELECT question_text FROM job_questions WHERE job_id = $job_id";
    $question_result = $conn->query($question_sql);

    $questions = [];
    if ($question_result && $question_result->num_rows > 0) {
        while ($row = $question_result->fetch_assoc()) {
            $questions[] = $row['question_text'];
        }
    }

    // Return questions as JSON
    echo json_encode(['questions' => $questions]);
}
?>
