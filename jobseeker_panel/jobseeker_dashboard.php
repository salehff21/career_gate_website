<?php
session_start();
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'job_seeker') {
    header("Location: ../loginSeekerjob");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة تحكم الباحث عن عمل</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
            direction: rtl;
        }

        .dashboard-container {
            max-width: 500px;
            margin: 100px auto;
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            text-align: center;
        }

        h1 {
            color: #005b96;
            font-size: 26px;
            margin-bottom: 30px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin: 20px 0;
        }

        a {
            text-decoration: none;
            color: #005b96;
            font-size: 18px;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <h1>مرحبًا بك، باحث عن عمل</h1>
    <ul>
        <li><a href="browse_jobs.php">تصفح الوظائف</a></li>
        <li><a href="my_applications.php">طلباتي</a></li>
    </ul>
</div>

</body>
</html>
