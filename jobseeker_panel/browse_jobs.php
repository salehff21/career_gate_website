<?php
include '../db_connect.php';
session_start();
$result = $conn->query("SELECT * FROM job_posts");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تصفح الوظائف</title>

    <!-- استدعاء خط كايرو من Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 20px;
            direction: rtl;
        }

        h2 {
            text-align: center;
            color: #005b96;
            font-size: 28px;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 16px;
            text-align: right;
            border-bottom: 1px solid #ddd;
            font-size: 16px;
        }

        th {
            background-color: #005b96;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            text-decoration: none;
            color: #005b96;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
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
