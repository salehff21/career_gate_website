<?php
include '../db_connect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$job_id = $_GET['id'];
$result = $conn->query("SELECT * FROM job_posts WHERE id = $job_id");
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تفاصيل الوظيفة - <?= htmlspecialchars($row['title'] ?? '') ?></title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/job_details.css">
    <!-- استدعاء خط Cairo من Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet">
    <?php include '../header.php'?>
     
</head>
<body>
    <div class="job-container">
        <h2><?= htmlspecialchars($row['title'] ?? '') ?></h2>
        <p><strong>الموقع:</strong> <?= htmlspecialchars($row['location'] ?? '') ?></p>
        <p><strong>الراتب:</strong> <?= htmlspecialchars($row['salary'] ?? '') ?></p>
        <p><strong>الوصف:</strong><br><?= nl2br(htmlspecialchars($row['description'] ?? '')) ?></p>

        <form method="POST" action="apply_job.php">
            <input type="hidden" name="job_id" value="<?= $job_id ?>">
            <button type="submit" class="apply-button">التقدم لهذه الوظيفة</button>
        </form>
    </div>
</body>
</html>
