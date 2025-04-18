<?php
session_start();
include 'db_connect.php';

// تأكد من أن المستخدم قد سجل الدخول
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id']; // استرجاع معرف المستخدم من الجلسة

// تعيين القيم الافتراضية
$name = $email = $specialty = $interests = $profile_picture_path = '';

// استرجاع بيانات المستخدم
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sql = "SELECT `id`, `name`, `email`, `password`, `user_type`, `specialty`, `interests`, `profile_picture`, `created_at` FROM `users` WHERE `id` = '$user_id'";
    $stmt = $conn->query($sql);
    
   
     
        
        if ($row) {
            $name = $row['name'];
            $email = $row['email'];
            $specialty = $row['specialty'];
            $interests = $row['interests'];
            $profile_picture_path = $row['profile_picture'] ? $row['profile_picture'] : 'default-avatar.png';  // تعيين صورة افتراضية إذا لم توجد صورة
        
       
    } else {
        echo "خطأ في استرجاع البيانات.";
        exit();
    }
}

// معالجة البيانات عند إرسال النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $specialty = $_POST['specialty'];
    $interests = $_POST['interests'];
    $password = $_POST['password'];
    $profile_picture = $_FILES['profile_picture'];

    // معالجة الصورة الشخصية
    $profile_picture_path = null;
    if ($profile_picture && $profile_picture['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($profile_picture["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // التحقق من نوع الصورة
        $allowed_types = ["jpg", "jpeg", "png", "gif"];
        if (in_array($imageFileType, $allowed_types)) {
            // تحريك الصورة إلى المجلد المحدد
            if (move_uploaded_file($profile_picture["tmp_name"], $target_file)) {
                $profile_picture_path = $target_file; // حفظ مسار الصورة
            } else {
                echo "حدث خطأ أثناء رفع الصورة.";
            }
        } else {
            echo "الرجاء رفع صورة بصيغة JPG، JPEG، PNG أو GIF.";
        }
    }

    // تحديث البيانات بما في ذلك الصورة
    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        // استعلام تحديث البيانات مع كلمة المرور
        $sql = "UPDATE users SET name = '$name', email = '$email', specialty = '$specialty', interests = '$interests', password = '$password', profile_picture = '$profile_picture_path' WHERE id = '$user_id'";
    } else {
        // استعلام تحديث البيانات بدون كلمة مرور
        $sql = "UPDATE users SET name = '$name', email = '$email', specialty = '$specialty', interests = '$interests', profile_picture = '$profile_picture_path' WHERE id = '$user_id'";
    }

    // تنفيذ الاستعلام
    if ($conn->exec($sql)) {
        echo "تم تحديث الحساب بنجاح.";
    } else {
        echo "حدث خطأ أثناء تحديث الحساب.";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/updateAccountStyle.css">
    <title>تعديل الملف الشخصي</title>
</head>
<body>
    <div class="container">
        <h2>تعديل الملف الشخصي</h2>

        <form action="" method="POST" enctype="multipart/form-data">
            <img src="<?php echo $profile_picture_path; ?>" alt="صورة المستخدم" style="width: 100px; height: 100px; border-radius: 50%; margin-bottom: 20px;">
            
            <div class="form-group">
                <label for="name">الاسم:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">البريد الإلكتروني:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>

            <div class="form-group">
                <label for="specialty">التخصص:</label>
                <input type="text" id="specialty" name="specialty" value="<?php echo htmlspecialchars($specialty); ?>">
            </div>

            <div class="form-group">
                <label for="interests">الاهتمامات:</label>
                <textarea id="interests" name="interests"><?php echo htmlspecialchars($interests); ?></textarea>
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
