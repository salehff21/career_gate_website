<?php
include '../db_connect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

$users = $conn->query("SELECT * FROM users");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة المستخدمين</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f9f9f9;
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
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: center;
            font-size: 16px;
        }

        th {
            background-color: #005b96;
            color: white;
        }

        a {
            color: #d9534f;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h2>جميع المستخدمين</h2>

<table>
    <tr>
        <th>المعرف</th>
        <th>الاسم</th>
        <th>البريد الإلكتروني</th>
        <th>النوع</th>
        <th>الإجراء</th>
    </tr>
    <?php while ($row = $users->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        
        <td>
            <a href="delete_user.php?id=<?= $row['id'] ?>" onclick="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')">حذف</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
git config --global user.name "salehff21"
git config --global user.email "salehff21@gmail.com"

