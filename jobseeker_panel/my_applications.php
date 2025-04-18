<?php
include '../db_connect.php';
session_start();

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
          WHERE a.user_id = $user_id";
$result = $conn->query($query);

// التحقق من نجاح الاستعلام
if (!$result) {
    die("خطأ في الاستعلام: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>طلباتي الوظيفية</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin: 20px 0;
            font-size: 24px;
            color: #005b96;
        }
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: center;
            font-size: 16px;
        }
        th {
            background-color: #eaeaea;
        }
    </style>
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
        <td><?= htmlspecialchars($row['title']) ?></td>
        <td><?= htmlspecialchars($row['status'] ?? 'قيد المعالجة') ?></td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
