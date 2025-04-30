<?php
include '../db_connect.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// التحقق من أن المستخدم مسجل كمدير
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

// التحقق من أن المعرّف موجود وصالح
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $user_id = intval($_GET['id']);

    // تحقق من وجود المستخدم
    $check_stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $check_stmt->bind_param("i", $user_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows === 1) {
        // حذف المستخدم
        $delete_stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $delete_stmt->bind_param("i", $user_id);

        if ($delete_stmt->execute()) {
            header("Location: manage_users.php?msg=deleted");
            exit();
        } else {
            header("Location: manage_users.php?msg=error");
            exit();
        }
    } else {
        // المستخدم غير موجود
        header("Location: manage_users.php?msg=notfound");
        exit();
    }
} else {
    // رابط غير صالح
    header("Location: manage_users.php?msg=invalid");
    exit();
}
?>
