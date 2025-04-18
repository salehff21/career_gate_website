<?php
include 'db_connect.php'; // الاتصال بقاعدة البيانات
session_start(); // بدء الجلسة

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // التحقق من وجود المستخدم في قاعدة البيانات
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user && password_hash($password, $user['password'])) {
        // تخزين معلومات الجلسة
        $_SESSION['user_id'] = $user['id']; // تخزين معرف المستخدم
        $_SESSION['user_name'] = $user['name']; // تخزين اسم المستخدم (اختياري)
        
        // إعادة التوجيه إلى الصفحة الرئيسية بعد تسجيل الدخول
        echo "<script>window.onload = function() { 
                showMessage('تم تسجيل الدخول بنجاح!', 'success'); 
                setTimeout(function(){ window.location='home.php'; }, 2000); 
              }</script>";
    } else {
        // في حال كانت البيانات غير صحيحة
        echo "<script>window.onload = function() { 
                showMessage('بيانات غير صحيحة، حاول مرة أخرى.', 'error'); 
              }</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div id="message-box" class="hidden"></div>
    <div class="form-container">
        <h2>تسجيل الدخول</h2>
        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="البريد الإلكتروني" required>
            <input type="password" name="password" placeholder="كلمة المرور" required>
            <button type="submit">تسجيل الدخول</button>
        </form>
        <p>ليس لديك حساب؟ <a href="register.php">سجل الآن</a></p>
    </div>
    <script>
        function showMessage(message, type) {
            let messageBox = document.getElementById('message-box');
            messageBox.innerText = message;
            messageBox.className = type;
            messageBox.classList.remove('hidden');
            messageBox.style.display = 'block'; // تأكد من عرض الـ div
            setTimeout(() => {
                messageBox.style.display = 'none'; // إخفاء الـ div بعد فترة
            }, 2000);
        }
    </script>
    <style>
        #message-box {
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            color: white;
            display: none; /* تأكد من أن الرسالة مخفية في البداية */
        }
        .hidden { display: none; }
        .success { background-color: #28a745; }
        .error { background-color: #dc3545; }
    </style>
</body>
</html>
