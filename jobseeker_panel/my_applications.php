<?php
include '../db_connect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// التحقق من وجود المستخدم
if (!isset($_SESSION['user_id'])) {
    header("Location: ../loginSeekerjob.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// تنفيذ الاستعلام
$query = "SELECT a.*, j.title 
          FROM applications a 
          JOIN job_posts j ON a.job_id = j.id 
          WHERE a.id = $user_id";
$result = $conn->query($query);

// التحقق من نجاح الاستعلام
if (!$result) {
    die("خطأ في الاستعلام: " . $conn->error);
}
?>
 <!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<?php include '../header.php'; ?> 
    <meta charset="UTF-8">
    <title>طلباتي الوظيفية</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/my_applications.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet">
    
</head>
<body>

 

<h1>طلباتي الوظيفية</h1>

<table>
    <tr>
        <th>المسمى الوظيفي</th>
        <th>الحالة</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['title'] ?? '') ?></td>
        <td><?= htmlspecialchars($row['status'] ?? 'قيد المعالجة') ?></td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
