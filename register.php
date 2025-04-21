<?php include 'db_connect.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $user_type = $_POST['account_type'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, user_type) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$name, $email, $password, $user_type])) {
        echo "<script>window.onload = function() { 
            showMessage('تم التسجيل بنجاح! يمكنك الآن تسجيل الدخول.', 'success'); 
            setTimeout(function(){ window.location='loginSeekerjob.php'; }, 2000); 
        }</script>";
    } else {
        echo "<script>window.onload = function() { 
            showMessage('حدث خطأ! حاول مرة أخرى.', 'error'); 
        }</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب جديد</title>
    <link rel="stylesheet"href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet">
   <style> 
   body {
            font-family: 'Cairo', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .form-container {
            background: white;
            padding: 30px;
            max-width: 400px;
            margin: 50px auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .form-container h2 {
            margin-bottom: 20px;
            color: #005b96;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            font-family: 'Cairo', sans-serif;
        }

        select {
            font-weight: 500;
            font-size: 12px;
        }

        button {
            width: 90%;
            background-color: #005b96;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #003f73;
        }

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
        .error { background-color: #dc3545; }</style>
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
        <p>لديك حساب بالفعل؟ <a href="loginSeekerjob.php">سجل الدخول</a></p>
    </div>
</body>
</html>
