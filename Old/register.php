<?php include 'db_connect.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    if ($stmt->execute([$name, $email, $password])) {
        echo "<script>window.onload = function() { showMessage('تم التسجيل بنجاح! يمكنك الآن تسجيل الدخول.', 'success'); setTimeout(function(){ window.location='login.php'; }, 2000); }</script>";
    } else {
        echo "<script>window.onload = function() { showMessage('حدث خطأ! حاول مرة أخرى.', 'error'); }</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>التسجيل</title>
    <link rel="stylesheet" href="css/styles.css">
    <script>
        function showMessage(message, type) {
            let messageBox = document.getElementById('message-box');
            messageBox.innerText = message;
            messageBox.className = type;
            messageBox.classList.remove('hidden');
            messageBox.style.display = 'block'; 
            setTimeout(() => {
                messageBox.style.display = 'none'; 
            }, 2000);
        }
    </script>
</head>
<body>
    <div id="message-box" class="hidden"></div>
    <div class="form-container">
        <h2>إنشاء حساب جديد</h2>
        <form action="register.php" method="POST">
            <input type="text" name="name" placeholder="الاسم الكامل" required>
            <input type="email" name="email" placeholder="البريد الإلكتروني" required>
            <input type="password" name="password" placeholder="كلمة المرور" required>
            <select name="account_type" required>
    <option value="">-- اختر نوع الحساب --</option>
    <option value="job_seeker">باحث عن وظيفة</option>
    <option value="company">شركة</option>
</select>
 

            <button type="submit">تسجيل</button>
        </form>
        
        <p>لديك حساب بالفعل؟ <a href="login.php">سجل الدخول</a></p>
    </div>
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
            display: none;
        }
        .hidden { display: none; }
        .success { background-color: #28a745; }
        .error { background-color: #dc3545; }
    </style>
</body>
</html>
 