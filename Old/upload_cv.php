 
<?php
require  'db_connect.php';
 // ملف الاتصال بقاعدة البيانات
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'student') {
    die("يجب تسجيل الدخول كطالب لرفع السيرة الذاتية.");
}
$student_id = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['resume'])) {
    $file_name = $_FILES['resume']['name'];
    $file_tmp = $_FILES['resume']['tmp_name'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $allowed_ext = ['pdf', 'doc', 'docx'];
    if (!in_array($file_ext, $allowed_ext)) {
        die("صيغة الملف غير مدعومة. يرجى رفع ملف بصيغة PDF أو DOC أو DOCX.");
    }
    $upload_dir = 'uploads/resumes/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $new_file_name = $upload_dir . $student_id . '_' . time() . '.' . $file_ext;
    if (move_uploaded_file($file_tmp, $new_file_name)) {
        $query = "INSERT INTO resumes (student_id, file_path) VALUES ('$student_id', '$new_file_name')";
        if (mysqli_query($conn, $query)) {
            echo "تم رفع السيرة الذاتية بنجاح.";
        } else {
            echo "حدث خطأ أثناء حفظ الملف في قاعدة البيانات.";
        }
    } else {
        echo "فشل رفع الملف.";
    }
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رفع السيرة الذاتية</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>رفع السيرة الذاتية</h1>
    <form action="upload_resume.php" method="POST" enctype="multipart/form-data">
        <label for="resume">اختر ملف السيرة الذاتية:</label>
        <input type="file" name="resume" id="resume" required>
        <button type="submit">رفع الملف</button>
    </form>
</body>
</html>
