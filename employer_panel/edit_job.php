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
    <?php include '../header.php'; ?>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/edit_job.css">
    <title>تعديل الوظيفة</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet">
    
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
