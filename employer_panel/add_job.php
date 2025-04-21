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

    $stmt = $conn->prepare("INSERT INTO job_posts (title, description, salary, location, company_id) VALUES (?, ?, ?, ?, ?)");

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
    <link rel="stylesheet" href="../css/add_job.css">
    <link rel="stylesheet" href="../css/header.css">
    <?php include '../header.php'; ?>
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
