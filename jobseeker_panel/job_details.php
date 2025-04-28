<?php
include '../db_connect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$job_id = $_GET['id'] ?? 0;

// جلب تفاصيل الوظيفة
$result = $conn->query("SELECT * FROM job_posts WHERE id = $job_id");
$row = $result->fetch_assoc();

// التحقق مما إذا كان المستخدم قد قدّم على الوظيفة
$has_applied = false;
if (isset($_SESSION['user_id']) && $_SESSION['user_type'] === 'job_seeker') {
    $user_id = $_SESSION['user_id'];
    $check = $conn->query("SELECT * FROM applications WHERE job_id = $job_id AND user_id = $user_id");
    if ($check && $check->num_rows > 0) {
        $has_applied = true;
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تفاصيل الوظيفة - <?= htmlspecialchars($row['title'] ?? '') ?></title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/job_details.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet">
    <?php include '../header.php' ?>
    <style>
        .apply-button {
            padding: 12px 20px;
            background-color: #005b96;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        .apply-button:disabled {
            background-color: #999;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="job-container">
        <h2><?= htmlspecialchars($row['title'] ?? '') ?></h2>
        <p><strong>الموقع:</strong> <?= htmlspecialchars($row['location'] ?? '') ?></p>
        <p><strong>الراتب:</strong> <?= htmlspecialchars($row['salary'] ?? '') ?></p>
        <p><strong>الوصف:</strong><br><?= nl2br(htmlspecialchars($row['description'] ?? '')) ?></p>

        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_type'] === 'job_seeker'): ?>
            <form method="POST" action="apply_job.php">
                <input type="hidden" name="job_id" value="<?= $job_id ?>">
                <?php if ($has_applied): ?>
                    <button type="button" class="apply-button" disabled>تم التقديم</button>
                <?php else: ?>
                    <button type="submit" class="apply-button">التقدم لهذه الوظيفة</button>
                <?php endif; ?>
            </form>
        <?php else: ?>
            <p style="color: red;">يرجى تسجيل الدخول كباحث عن عمل للتقديم على الوظيفة.</p>
        <?php endif; ?>
    </div>
</body>
</html>
