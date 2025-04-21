<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة تحكم المدير</title>
    <link rel="stylesheet" href="../css/header.css">
    <?php include '../header.php'; ?>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="../css/admin_dashboard.css">
</head>
<body>

<div class="dashboard-container">
    <h1>مرحبًا بك، المدير</h1>
    <ul>
        <li><a href="manage_users.php">إدارة المستخدمين</a></li>
        <li><a href="manage_jobs.php">إدارة الوظائف</a></li>
    </ul>
</div>

</body>
</html>
