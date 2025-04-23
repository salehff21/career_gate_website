<?php
require '../db_connect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'job_seeker') {
    echo "<script>window.onload = function() {
        showMessage('يجب تسجيل الدخول كطالب لرفع السيرة الذاتية.', 'error');
    }</script>";
    exit();
}

$student_id = $_SESSION['user_id'];
$message = "";
$messageType = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['resume'])) {
    $file_name = $_FILES['resume']['name'];
    $file_tmp = $_FILES['resume']['tmp_name'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $allowed_ext = ['pdf', 'doc', 'docx'];

    if (!in_array($file_ext, $allowed_ext)) {
        $message = "صيغة الملف غير مدعومة. يرجى رفع ملف بصيغة PDF أو DOC أو DOCX.";
        $messageType = "error";
    } else {
        $upload_dir = '../uploads/resumes/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $new_file_name = $upload_dir . $student_id . '_' . time() . '.' . $file_ext;
        if (move_uploaded_file($file_tmp, $new_file_name)) {
            $query = "INSERT INTO resumes (student_id, file_path) VALUES ('$student_id', '$new_file_name')";
            if (mysqli_query($conn, $query)) {
                $message = "تم رفع السيرة الذاتية بنجاح.";
                $messageType = "success";
            } else {
                $message = "حدث خطأ أثناء حفظ الملف في قاعدة البيانات.";
                $messageType = "error";
            }
        } else {
            $message = "فشل رفع الملف.";
            $messageType = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رفع السيرة الذاتية</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/header.css">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 80px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        h1 {
            color: #005b96;
            margin-bottom: 20px;
        }
        input[type="file"] {
            margin-bottom: 20px;
        }
        button {
            background-color: #005b96;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background-color: #004471;
        }
        #message-box {
            display: none;
            padding: 12px;
            margin: 20px auto;
            width: 80%;
            border-radius: 6px;
            font-size: 16px;
            text-align: center;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <?php include '../header.php'; ?>
    <div class="container">
        <h1>رفع السيرة الذاتية</h1>
        <div id="message-box" class="<?= $messageType ?>"><?= $message ?></div>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="resume">اختر ملف السيرة الذاتية:</label><br>
            <input type="file" name="resume" id="resume" required><br>
            <button type="submit">رفع الملف</button>
        </form>
    </div>

    <script>
        function showMessage(message, type) {
            let box = document.getElementById('message-box');
            box.innerText = message;
            box.className = type;
            box.style.display = 'block';
            setTimeout(() => {
                box.style.display = 'none';
            }, 3000);
        }

        <?php if (!empty($message)): ?>
        window.onload = function() {
            showMessage("<?= $message ?>", "<?= $messageType ?>");
        };
        <?php endif; ?>
    </script>
</body>
</html>
