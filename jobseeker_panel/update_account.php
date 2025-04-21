<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../db_connect.php';
// تأكد من أن المستخدم قد سجل الدخول
if (!isset($_SESSION['user_id'])) {
    header('Location: loginSeeker.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$name = $email = $specialty = $interests = $profile_picture_path = '';

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $sql = "SELECT `id`, `name`, `email`, `password`, `user_type`, `specialty`, `interests`, `profile_picture`, `created_at` FROM `users` WHERE `id` = '$user_id'";
    $stmt = $conn->query($sql);
    $row = $stmt->fetch_assoc();

    if ($row) {
        $name = $row['name'] ?? '';
        $email = $row['email'] ?? '';
        $specialty = $row['specialty'] ?? '';
        $interests = $row['interests'] ?? '';
        $profile_picture_path = !empty($row['profile_picture']) ? $row['profile_picture'] : 'default-avatar.png';
    } else {
        echo "<script>window.onload = function() { showMessage('خطأ في استرجاع البيانات.', 'error'); }</script>";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $specialty = $_POST['specialty'] ?? '';
    $interests = $_POST['interests'] ?? '';
    $password = $_POST['password'] ?? '';
    $profile_picture = $_FILES['profile_picture'] ?? null;

    if ($profile_picture && $profile_picture['error'] === 0) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($profile_picture["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ["jpg", "jpeg", "png", "gif"];

        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($profile_picture["tmp_name"], $target_file)) {
                $profile_picture_path = $target_file;
            } else {
                echo "<script>window.onload = function() { showMessage('حدث خطأ أثناء رفع الصورة.', 'error'); }</script>";
            }
        } else {
            echo "<script>window.onload = function() { showMessage('الرجاء رفع صورة بصيغة JPG أو PNG أو GIF.', 'error'); }</script>";
        }
    }

    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET name = '$name', email = '$email', specialty = '$specialty', interests = '$interests', password = '$password', profile_picture = '$profile_picture_path' WHERE id = '$user_id'";
    } else {
        $sql = "UPDATE users SET name = '$name', email = '$email', specialty = '$specialty', interests = '$interests', profile_picture = '$profile_picture_path' WHERE id = '$user_id'";
    }

    if ($conn->query($sql)) {
        echo "<script>window.onload = function() { showMessage('تم تحديث الحساب بنجاح.', 'success'); }</script>";
    } else {
        echo "<script>window.onload = function() { showMessage('حدث خطأ أثناء تحديث الحساب.', 'error'); }</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل الملف الشخصي</title>
    <?php include '../header.php'; ?>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/header.css">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #005b96;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            color: #333;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 15px;
        }
        textarea {
            resize: vertical;
            height: 100px;
        }
        input[type="submit"], button {
            width: 100%;
            padding: 12px;
            background-color: #005b96;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #003f73;
        }
        img.profile-picture {
            display: block;
            margin: 0 auto 20px;
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        #message-box {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 15px;
            font-family: 'Cairo', sans-serif;
            color: white;
            z-index: 9999;
            display: none;
        }
        .success { background-color: #28a745; }
        .error { background-color: #dc3545; }
    </style>
    <script>
        function showMessage(message, type) {
            let messageBox = document.getElementById('message-box');
            if (!messageBox) {
                messageBox = document.createElement('div');
                messageBox.id = 'message-box';
                document.body.appendChild(messageBox);
            }
            messageBox.innerText = message;
            messageBox.className = type;
            messageBox.style.display = 'block';
            setTimeout(() => { messageBox.style.display = 'none'; }, 2500);
        }
    </script>
</head>
<body>
<div id="message-box"></div>
<div class="container">
    <h2>تعديل الملف الشخصي</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <img src="<?= htmlspecialchars($profile_picture_path ?? 'default-avatar.png') ?>" alt="صورة المستخدم" class="profile-picture">
        <div class="form-group">
            <label for="name">الاسم:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($name ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label for="email">البريد الإلكتروني:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label for="specialty">التخصص:</label>
            <input type="text" id="specialty" name="specialty" value="<?= htmlspecialchars($specialty ?? '') ?>">
        </div>
        <div class="form-group">
            <label for="interests">الاهتمامات:</label>
            <textarea id="interests" name="interests"><?= htmlspecialchars($interests ?? '') ?></textarea>
        </div>
        <div class="form-group">
            <label for="password">كلمة المرور الجديدة (إذا كنت تريد تغييرها):</label>
            <input type="password" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="profile_picture">الصورة الشخصية:</label>
            <input type="file" name="profile_picture" id="profile_picture">
        </div>
        <input type="submit" value="تحديث">
    </form>
</div>
</body>
</html>
