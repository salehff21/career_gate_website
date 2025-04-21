<?php
include '../db_connect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$result = $conn->query("SELECT * FROM job_posts");
?>
 <!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تصفح الوظائف</title>

    <!-- خط كايرو -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet">
    
    <!-- تنسيقات عامة -->
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/browes_jobs.css">
    <?php include '../header.php'; ?>
</head>

<body>

    <h2>الوظائف المتاحة</h2>

    <table>
        <tr>
            <th>المسمى الوظيفي</th>
            <th>الموقع</th>
            <th>التفاصيل</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['title'] ?? '') ?></td>
            <td><?= htmlspecialchars($row['location'] ?? '') ?></td>
            <td><a href="job_details.php?id=<?= $row['id'] ?>">عرض التفاصيل</a></td>
        </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
