/* job_details.php - تفاصيل الوظيفة */
<?php
require 'db_connect.php'; // ملف الاتصال بقاعدة البيانات
if (!isset($_GET['id'])) {
    die("لم يتم تحديد الوظيفة.");
}
$job_id = intval($_GET['id']);
$query = "SELECT job_posts.*, users.name AS company FROM job_posts JOIN users ON job_posts.company_id = users.id WHERE job_posts.id = $job_id";
$result = mysqli_query($conn, $query);
$job = mysqli_fetch_assoc(result: $result);
if (!$job) {
    die("لم يتم العثور على الوظيفة.");
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل الوظيفة</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1><?= $job['title'] ?></h1>
    <p><strong>الشركة:</strong> <?= $job['company'] ?></p>
    <p><strong>التخصص المطلوب:</strong> <?= $job['required_specialty'] ?></p>
    <p><strong>الوصف:</strong> <?= nl2br($job['description']) ?></p>
    <a href="apply.php?job_id=<?= $job_id ?>" class="apply-button">تقديم الطلب</a>
</body>
</html>
