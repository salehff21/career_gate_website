<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();} ?>
<header class="site-header">
   
    <nav>
        <ul>
            <li> <img src="logo.png" alt="شعار الموقع" class="logo"></li>
            <li><a href="home.php">الرئيسية</a></li>

            <?php if (!isset($_SESSION['user_id'])): ?>
                <li><a href="register.php">التسجيل</a></li>
                <li><a href="loginSeekerjob.php">تسجيل الدخول</a></li>
            <?php else: ?>
                <li><a href="../logout.php">تسجيل الخروج</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
