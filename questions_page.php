<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'mict');

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_GET) {
    // Retrieve data passed from the job listing page
    $job_id = htmlspecialchars($_GET['job_id']);
    $job_position = htmlspecialchars($_GET['job_position']);
}
// Fetch job positions from the database
$job_positions = [];
$job_sql = "SELECT job_id, job_title FROM job_positions";
$result = $conn->query($job_sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $job_positions[] = $row;
    }
}

$questions = [];  // Default empty array, will be populated via AJAX
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/mict-logo4.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 50px auto; padding: 20px; background: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h1 { text-align: center; }
        form { display: flex; flex-direction: column; gap: 20px; }
        textarea {
            width: 100%;
            height: 100px;
            padding: 12px;
            font-size: 16px;
            line-height: 1.5;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        textarea:focus {
            border-color: #007BFF;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            outline: none;
        }
        button {
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        button:hover {
            background-color: #0056b3;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        button:active {
            background-color: #004085;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Job Application</h1>

    <!-- Job Position Selection -->
    <form action="submit_responses.php" method="POST">
        <input type="hidden" name="job_id" id="job_id" value="">

        <!-- Dropdown for job positions -->
       <br> <h2><p><strong>Position:</strong> <?= $job_position ?></p></h2>
        <select name="job_position" id="job_position" onchange="updateJobId()">
            <option value="">Select a Job</option>
            <?php foreach ($job_positions as $job): ?>
                <option value="<?= htmlspecialchars($job['job_id']) ?>" data-title="<?= htmlspecialchars($job['job_title']) ?>">
                    <?= htmlspecialchars($job['job_title']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Questions will appear here dynamically -->
        <div id="questions-container"></div>

        <button type="submit">Submit Application</button>
    </form>
</div>

<script>
    // Function to update the hidden job_id field when the user selects a job position
    function updateJobId() {
        const jobSelect = document.getElementById('job_position');
        const jobId = jobSelect.value;
        document.getElementById('job_id').value = jobId;
        
        // Fetch questions based on the selected job
        fetchQuestions(jobId);
    }

    // Function to fetch questions based on job_id
    function fetchQuestions(jobId) {
        if (!jobId) return;

        // Fetch questions via AJAX
        fetch(`fetch_questions.php?job_id=${jobId}`)
            .then(response => response.json())
            .then(data => {
                const questionsContainer = document.getElementById('questions-container');
                questionsContainer.innerHTML = ''; // Clear any previous questions

                if (data.questions.length > 0) {
                    data.questions.forEach((question, index) => {
                        const questionHTML = `
                            <label>
                                ${question}
                                <textarea name="responses[${index}]" required></textarea>
                            </label>
                        `;
                        questionsContainer.innerHTML += questionHTML;
                    });
                } else {
                    questionsContainer.innerHTML = '<p>No questions available for this job.</p>';
                }
            })
            .catch(error => console.error('Error fetching questions:', error));
    }
</script>
</body>
</html>
