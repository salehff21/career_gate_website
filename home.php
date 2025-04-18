<!-- الصفحة الرئيسية -->
<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منصة الوظائف</title>
    <link rel="stylesheet" href="css/styles.css">
    <?php include 'header.php'?>
</head>
<body>
    
    
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