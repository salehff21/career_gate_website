<?php
include '../db_connect.php';
session_start();

$job_id = $_GET['id'];
$result = $conn->query("SELECT * FROM job_posts WHERE id = $job_id");
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تفاصيل الوظيفة - <?= htmlspecialchars($row['title'] ?? '') ?></title>
    
    <!-- استدعاء خط Cairo من Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
            direction: rtl;
        }

        .job-container {
            max-width: 700px;
            margin: 60px auto;
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h2 {
            margin-top: 0;
            font-size: 28px;
            color: #005b96;
        }

        p {
            font-size: 18px;
            line-height: 1.8;
            color: #333;
        }

        strong {
            color: #222;
        }

        .apply-button {
            display: inline-block;
            margin-top: 25px;
            background-color: #005b96;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .apply-button:hover {
            background-color: #004475;
        }
    </style>
</head>
<body>
    <div class="job-container">
        <h2><?= htmlspecialchars($row['title'] ?? '') ?></h2>
        <p><strong>الموقع:</strong> <?= htmlspecialchars($row['location'] ?? '') ?></p>
        <p><strong>الراتب:</strong> <?= htmlspecialchars($row['salary'] ?? '') ?></p>
        <p><strong>الوصف:</strong><br><?= nl2br(htmlspecialchars($row['description'] ?? '')) ?></p>

        <form method="POST" action="apply_job.php">
            <input type="hidden" name="job_id" value="<?= $job_id ?>">
            <button type="submit" class="apply-button">التقدم لهذه الوظيفة</button>
        </form>
    </div>
</body>
</html>
