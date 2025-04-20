<?php
include '../db_connect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $job_id = $_POST['job_id'];
    $user_id = $_SESSION['user_id'];
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $resume = 'resumes/default.pdf'; // Replace with actual file path if resumes are uploaded

    $stmt = $conn->prepare("INSERT INTO applications (job_id, user_id, name, email, resume) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $job_id, $user_id, $name, $email, $resume);
    $stmt->execute();
    $stmt->close();
    header("Location: my_applications.php");
}
?>