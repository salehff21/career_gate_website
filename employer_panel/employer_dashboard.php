<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'company') {
    header("Location: loginCompany.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة تحكم الشركة</title>
    <!-- استدعاء خط Cairo Medium -->
    <?php include '../header.php'; ?>
    <link rel="stylesheet" href="../css/header.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/employer_dashboard.css">
</head>
<body>

<div class="dashboard-container">
    <h1>مرحبًا بك، صاحب العمل</h1>
    <ul>
        <li><a href="add_job.php">إضافة وظيفة جديدة</a></li>
        <li><a href="my_jobs.php">وظائفي</a></li>
    </ul>
</div>

</body>
</html>
