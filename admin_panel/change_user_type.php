<?php
include '../db_connect.php';
session_start();

// التحقق من أن المستخدم مدير
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

// التحقق من الطلب
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id']) && isset($_POST['user_type'])) {
    $user_id = intval($_POST['user_id']);
    $new_type = $_POST['user_type'];

    // التحقق من النوع المسموح
    $allowed_types = ['admin', 'company', 'job_seeker'];
    if (in_array($new_type, $allowed_types)) {
        // تحديث النوع في قاعدة البيانات
        $update = $conn->query("UPDATE users SET user_type = '$new_type' WHERE id = $user_id");

        if ($update) {
            header("Location: manage_users.php?msg=updated&new_type=$new_type");
            exit();
        }
    }
}

// في حال فشل التحديث
header("Location: manage_users.php?msg=error");
exit();
?>
