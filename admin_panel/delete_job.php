 
<?php
include '../db_connect.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// التأكد من أن المستخدم لديه صلاحية
if (!isset($_SESSION['user_type']) || ($_SESSION['user_type'] !== 'Admin' && $_SESSION['user_type'] !== 'company')) {
    header("Location: login.php");
    exit();
}

// التحقق من وجود معرف الوظيفة
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM job_posts WHERE id = $id");

    // إعادة التوجيه حسب نوع المستخدم
    if ($_SESSION['user_type'] === 'Admin') {
        header("Location: manage_jobs.php?msg=deleted");
    } else {
        header("Location: ../employer_panel/my_jobs.php?msg=deleted");
    }
    exit();
} else {
    // معرف غير صالح
    if ($_SESSION['user_type'] === 'Admin') {
        header("Location: manage_jobs.php?msg=invalid");
    } else {
        header("Location: ../employer_panel/my_jobs.php?msg=invalid");
    }
    exit();
}
