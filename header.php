<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} 
?>
<header class="site-header">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet">

    <style>
        .site-header {
            font-family: 'Cairo', sans-serif;
            direction:ltr;
            background-color: #2d3e50;
            color: white;
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .site-header .logo {
            width: 60px;
            height: 60px;
            object-fit: cover;
        }

        .site-header nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 20px;
        }

        .site-header nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 1.1em;
            padding: 8px 12px;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
            font-family: 'Cairo', sans-serif;
        }

        .site-header nav ul li a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
    </style>

    <nav><ul>
        <ul>  <li><img src="logo.png" style="margin-right:700px" alt="شعار الموقع" class="logo"></li></ul>
        <ul>
          
            <li><a href="home.php">الرئيسية</a></li>

            <?php if (!isset($_SESSION['user_id'])): ?>
                
                <li><a href="register.php">التسجيل</a></li>
                <li><a href="loginSeekerjob.php">تسجيل الدخول</a></li>
            <?php else: ?>
                <li><a href="../logout.php">تسجيل الخروج</a></li>
                <li><a href="javascript:history.back()">الرجوع</a></li>
            <?php endif; ?>
        </ul></ul>
    </nav>
</header>
