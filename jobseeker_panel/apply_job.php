<?php
include '../db_connect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $job_id = $_POST['job_id'];
    $user_id = $_SESSION['user_id'] ?? 0;

    // إعداد استعلام لإدخال فقط job_id و user_id (وستُملأ applied_at تلقائيًا إن كانت DEFAULT CURRENT_TIMESTAMP)
    $stmt = $conn->prepare("INSERT INTO applications (job_id, user_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $job_id, $user_id);
    $stmt->execute();
    $stmt->close();

    header("Location: my_applications.php");
    exit();
}
?>
