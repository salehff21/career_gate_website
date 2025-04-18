<?php
include '../db_connect.php';
session_start(); // ✅ لازم قبل أي استخدام لـ $_SESSION
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // استعلام محضر
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email); // ربط البريد كـ string
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc(); // ✅ الطريقة الصحيحة مع mysqli


if ($user && isset($user['password']) && password_verify($password, $user['password'])) {
    if ($user['user_type'] == 'company') {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'] ?? '';
        $_SESSION['user_type'] = $user['user_type'];

        echo "<script>window.onload = function() { 
                showMessage('تم تسجيل الدخول بنجاح!', 'success'); 
                setTimeout(function(){ window.location='employer_dashboard.php'; }, 2000); 
              }</script>";
    } else {
        echo "<script>window.onload = function() { 
                showMessage('هذا الحساب ليس لحساب شركة.', 'error'); 
              }</script>";
    }
}}
 ?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول الشركات</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div id="message-box" class="hidden"></div>
    <div class="form-container">
        <h2> تسجيل الدخول الشركات </h2>
        <form action="loginCompany.php" method="POST">
            <input type="email" name="email" placeholder="البريد الإلكتروني" required>
            <input type="password" name="password" placeholder="كلمة المرور" required>
            <button type="submit">تسجيل الدخول</button>
        </form>
        <p>ليس لديك حساب؟ <a href="../register.php">سجل الآن</a></p>
    
        <button type="#" style="margin: 12px;" onclick="window.location.href='../admin_panal/login.php';">تسجيل الدخول مدير الموقع</button>
        <button type="#"style="margin: 12px;" onclick="window.location.href='../loginSeekerjob.php';">تسجيل الدخول باحث عن وظيفة</button>

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
