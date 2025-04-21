<?php
include '../db_connect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$job_id = $_GET['job_id'] ?? 0;

// استعلام لجلب بيانات المتقدمين من جدول التطبيقات وجدول المستخدمين
$query = "
     SELECT u.name, u.email, r.file_path AS resume
FROM applications a
JOIN users u ON a.user_id = u.id
LEFT JOIN resumes r ON r.student_id = u.id
WHERE a.job_id =  $job_id;
";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>المتقدمون للوظيفة</title>
    <link rel="stylesheet" href="../css/header.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet">
    <?php include '../header.php'; ?>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin: 40px 0 20px;
            color: #005b96;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        th, td {
            border: 1px solid #ccc;
            padding: 14px;
            text-align: center;
            font-size: 16px;
        }

        th {
            background-color: #005b96;
            color: white;
        }

        td a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        td a:hover {
            text-decoration: underline;
        }

        .no-data {
            text-align: center;
            color: #999;
            font-size: 18px;
            padding: 30px;
        }
    </style>
</head>
<body>

<h2>المتقدمون للوظيفة رقم: <?= htmlspecialchars($job_id) ?></h2>

<?php if ($result->num_rows > 0): ?>
<table>
    <tr>
        <th>الاسم</th>
        <th>البريد الإلكتروني</th>
        <th>السيرة الذاتية</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['name'] ?? 'غير متوفر') ?></td>
        <td><?= htmlspecialchars($row['email'] ?? 'غير متوفر') ?></td>
        <td>
            <?php if (!empty($row['resume'])): ?>
                <a href="<?= htmlspecialchars($row['resume']) ?>" target="_blank">عرض السيرة الذاتية</a>
            <?php else: ?>
                لا توجد سيرة ذاتية
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<?php else: ?>
    <div class="no-data">لا يوجد متقدمون لهذه الوظيفة حتى الآن.</div>
<?php endif; ?>

</body>
</html>
