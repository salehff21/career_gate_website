 
<?php
include 'db_connect.php'; // ملف الاتصال بقاعدة البيانات
session_start();

if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); exit; } $company_id = $_SESSION['user_id'];
  
 
$company_id = $_SESSION['user_id'];

// تحديث حالة الطلب
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['application_id'], $_POST['status'])) {
    $application_id = intval($_POST['application_id']);
    $status = $_POST['status'];
    if (in_array($status, ['accepted', 'rejected'])) {
        $update_query = "UPDATE applications SET status = '$status' WHERE id = '$application_id'";
        mysqli_query($conn, $update_query);
    }
}

// جلب الطلبات
$query = "SELECT applications.id, users.name AS student_name, users.email, job_posts.title, applications.applied_at, applications.status FROM applications JOIN users ON applications.student_id = users.id JOIN job_posts ON applications.job_id = job_posts.id WHERE job_posts.company_id = '$company_id' ORDER BY applications.applied_at DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الطلبات</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>إدارة طلبات التقديم</h1>
    <table>
        <tr>
            <th>اسم الطالب</th>
            <th>البريد الإلكتروني</th>
            <th>الوظيفة</th>
            <th>تاريخ التقديم</th>
            <th>الحالة</th>
            <th>الإجراء</th>
        </tr>
        <?php while ($app = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $app['student_name'] ?></td>
                <td><?= $app['email'] ?></td>
                <td><?= $app['title'] ?></td>
                <td><?= $app['applied_at'] ?></td>
                <td><?= $app['status'] ? ($app['status'] == 'accepted' ? 'مقبول' : 'مرفوض') : 'قيد الانتظار' ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="application_id" value="<?= $app['id'] ?>">
                        <button type="submit" name="status" value="accepted">قبول</button>
                        <button type="submit" name="status" value="rejected">رفض</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
