<?php
include '../db_connect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $salary = $_POST['salary'];
    $location = $_POST['location'];

    $stmt = $conn->prepare("UPDATE job_posts SET title=?, description=?, salary=?, location=? WHERE id=?");
    $stmt->bind_param("ssssi", $title, $description, $salary, $location, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: my_jobs.php");
    exit();
}

$result = $conn->query("SELECT * FROM job_posts WHERE id = $id");
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل الوظيفة</title>
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
    <h2>تعديل الوظيفة</h2>
    <form method="POST">
        <label for="title">المسمى الوظيفي:</label>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($row['title']) ?>" required>

        <label for="description">الوصف:</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($row['description']) ?></textarea>

        <label for="salary">الراتب:</label>
        <input type="text" id="salary" name="salary" value="<?= htmlspecialchars($row['salary']) ?>" required>

        <label for="location">الموقع:</label>
        <input type="text" id="location" name="location" value="<?= htmlspecialchars($row['location']) ?>" required>

        <button type="submit">تحديث الوظيفة</button>
    </form>
</div>

</body>
</html>
