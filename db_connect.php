<?php
// ملف الاتصال بقاعدة البيانات db.php
 
$host = "localhost";
$dbname = "job_portal_v2";
$username = "root";
$password1 = "";
 // الاتصال بقاعدة البيانات
 $conn = new mysqli( $host , $username,$password1,$dbname );
 // يمكنك إضافة هذا الاختبار للتحقق من الاتصال
 // التحقق من الاتصال  
if ($conn->connect_error) {  
    die("Connection failed: " . $conn->connect_error);  
}  

?>
