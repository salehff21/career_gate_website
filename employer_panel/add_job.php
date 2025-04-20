<?php
include '../db_connect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $salary = $_POST['salary'];
    $location = $_POST['location'];
    $employer_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO job_posts (title, description, salary, location, employer_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $title, $description, $salary, $location, $employer_id);
    $stmt->execute();
    $stmt->close();

    header("Location: my_jobs.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة وظيفة جديدة</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            direction: rtl;
        }

        .form-container {
            max-width: 600px;
            margin: 80px auto;
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #005b96;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-size: 16px;
            color: #333;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            font-family: 'Cairo', sans-serif;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        button {
            margin-top: 25px;
            background-color: #005b96;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #004475;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>إضافة وظيفة جديدة</h2>
    <form method="POST">
        <label for="title">المسمى الوظيفي:</label>
        <input type="text" id="title" name="title" required>

        <label for="description">الوصف:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="salary">الراتب:</label>
        <input type="text" id="salary" name="salary" required>

        <label for="location">الموقع:</label>
        <input type="text" id="location" name="location" required>

        <button type="submit">نشر الوظيفة</button>
    </form>
</div>

</body>
</html>
