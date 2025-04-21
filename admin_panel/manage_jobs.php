<?php
include '../db_connect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

$jobs = $conn->query("SELECT * FROM job_posts");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة الوظائف</title>
    <link rel="stylesheet" href="../css/header.css">
    <?php include '../header.php'; ?>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="../css/manage_job.css">
</head>
<body>

<h2>جميع الوظائف المنشورة</h2>

<table>
    <tr>
        <th>المعرف</th>
        <th>المسمى الوظيفي</th>
        <th>الموقع</th>
        <th>الوصف</th>
        <th>تاريخ النشر</th>
        <th>الإجراء</th>
    </tr>
    <?php while ($row = $jobs->fetch_assoc()): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= htmlspecialchars($row['title'] ?? '') ?></td>
    <td><?= htmlspecialchars($row['location'] ?? '') ?></td>
    <td><?= htmlspecialchars($row['description'] ?? '') ?></td>
    <td><?= htmlspecialchars($row['created_at'] ?? '') ?></td>
    <td>
        <a href="delete_job.php?id=<?= $row['id'] ?>" onclick="return confirm('هل أنت متأكد من حذف هذه الوظيفة؟')">حذف</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

</body>
</html>
