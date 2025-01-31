<?php
session_start();
require('database.php');

// Check if 'id' parameter is in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("<div class='error-message'>Error: Job ID is missing. Please try again.</div>");
}

$user_email = $_SESSION['email'] ?? ''; // Ensure session variable matches the working page
$job_id = intval($_GET['id']);

$sql = "SELECT jobtype, division, reference, status, position, vacancies, location, startDate, endDate, description, requirement, system_skills, behavioural_competencies FROM postjob WHERE job_id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("<div class='error-message'>Query preparation failed: " . $conn->error . "</div>");
}

$stmt->bind_param("i", $job_id);

if (!$stmt->execute()) {
    die("<div class='error-message'>Query execution failed: " . $stmt->error . "</div>");
}

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $job_details = $result->fetch_assoc();

    // Get current date
    $current_date = date('Y-m-d'); // Format: YYYY-MM-DD

    // Check if the job is expired
    $is_expired = ($current_date > $job_details['endDate']);
    ?>
    <div class="container">
        <div class="job-header">
            <h1><?php echo htmlspecialchars($job_details['division']); ?></h1>
            <div class="hiring-status">
                <p>Needed: <?php echo htmlspecialchars($job_details['vacancies']); ?></p>
                <span class="badge <?php echo ($job_details['status'] == 'closed') ? 'bg-danger' : 'bg-success'; ?>">
                    <?php echo htmlspecialchars($job_details['status']); ?>
                </span>
            </div>
        </div>
        <hr>
        <div class="job-content">
            <p><strong>Position:</strong> <?php echo htmlspecialchars($job_details['position']); ?></p>
            <p><strong>Reference:</strong> <?php echo htmlspecialchars($job_details['reference']); ?></p>
            <p><strong>Job Type:</strong> <?php echo htmlspecialchars($job_details['jobtype']); ?></p>
            <p><strong>Location:</strong> <?php echo htmlspecialchars($job_details['location']); ?></p>
            <p><strong>Start Date:</strong> <?php echo htmlspecialchars($job_details['startDate']); ?></p>
            <p><strong>End Date:</strong> <?php echo htmlspecialchars($job_details['endDate']); ?></p>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($job_details['description']); ?></p>

            <h3>Requirements:</h3>
            <ul class="centered-list">
                <?php foreach (explode(',', $job_details['requirement']) as $requirement): ?>
                    <li><?php echo htmlspecialchars($requirement); ?></li>
                <?php endforeach; ?>
            </ul>

            <h3>System Skills:</h3>
            <ul class="centered-list">
                <?php foreach (explode(',', $job_details['system_skills']) as $skill): ?>
                    <li><?php echo htmlspecialchars($skill); ?></li>
                <?php endforeach; ?>
            </ul>

            <h3>Behavioural Competencies:</h3>
            <ul class="centered-list">
                <?php foreach (explode(',', $job_details['behavioural_competencies']) as $competency): ?>
                    <li><?php echo htmlspecialchars($competency); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <hr>

        <div class="apply-section">
            <?php if ($is_expired): ?>
                <p class="error-message">This job posting has expired and is no longer accepting applications.</p>
            <?php else: ?>
                <form action="apply_job.php" method="POST">
                    <input type="hidden" name="job_division" value="<?php echo htmlspecialchars($job_details['division']); ?>">
                    <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($job_id); ?>">
                    <input type="hidden" name="job_position" value="<?php echo htmlspecialchars($job_details['position']); ?>">
                    <input type="hidden" name="job_reference" value="<?php echo htmlspecialchars($job_details['reference']); ?>">
                    <input type="hidden" name="user_email" value="<?php echo htmlspecialchars($user_email); ?>">
                    <input type="submit" value="Apply Now" class="apply-btn">
                </form>
            <?php endif; ?>
        </div>
    </div>
    <?php
} else {
    echo "<div class='error-message'>No job found with this ID.</div>";
}

$stmt->close();
$conn->close();
?>
<!-- CSS Styling -->
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-image: url('images/mict-logo3.jpg'); /* Background image */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh; /* Ensure the background covers full height */
        display: flex;
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */
    }

    .container {
        width: 70%;
        background-color: white; /* Add transparency to make the text more readable */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        text-align: center; /* Center the text */
    }

    .job-header h1 {
        font-size: 2rem;
        color: #333;
    }

    .hiring-status p {
        display: inline;
        font-weight: bold;
    }

   
    .badge-danger {
    background-color: red;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
}

.badge-success {
    background-color: green;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
}


    h3 {
        color: black; /* Heading color */
        text-align: left; /* Align the headings to the left */
        margin-left: 20px; /* Optional: Add some left margin for spacing */
    }

    ul {
        list-style-type: disc;
        margin-left: 40px; /* Increased margin for left alignment */
        text-align: left; /* Align text to the left */
    }

    /* Centered List Class */
    .centered-list {
        text-align: left; /* Align the list items to the left */
        list-style-position: inside; /* Adjust position of bullets */
        margin-left: 20px; /* Optional: add additional left margin to the list itself */
    }

    /* Apply Button Styling */
    .apply-section {
        text-align: center;
        margin-top: 30px;
    }

    .apply-btn {
        background-color: #5bc0de; /* Light blue color */
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        font-size: 1.2rem;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .apply-btn:hover {
        background-color: #31b0d5;
    }

    .error-message {
        color: red;
        font-weight: bold;
    }
</style>
