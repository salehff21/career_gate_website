<!-- الصفحة الرئيسية -->
<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منصة الوظائف</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <img src="logo.png" alt="شعار الموقع" class="logo">
        <nav>
            <ul>
                <li><a href="home.php">الرئيسية</a></li>
                <li><a href="#">الوظائف</a></li>
                <li><a href="register.php">التسجيل</a></li>
                <li><a href="login.php">تسجيل الدخول</a></li>
                <li><a href="update_account.php">تحديث الملف الشخصي</a></li>
                <li><a href="upload_cv.php">رفع السيرة الذاتية</a></li>
                <li><a href="manage_applications.php">رفع السيرة الذاتية</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <h1>مرحبًا بك في منصة الوظائف</h1>
        <p>قم بتحميل سيرتك الذاتية وابحث عن الوظائف المناسبة لك!</p>
        <a href="register.php" class="btn">ابدأ الآن</a>
    </main>
    
    <footer>
        <p>&copy; 2025 منصة الوظائف. جميع الحقوق محفوظة.</p>
    </footer>
</body>
<?php
if (isset($_SESSION['message'])) {
    echo "<script>
        window.onload = function() {
            showMessage('" . $_SESSION['message'] . "', '" . $_SESSION['message_type'] . "');
        };
    </script>";
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
?>

</html>