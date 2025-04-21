 <?php
include '../db_connect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

$users = $conn->query("SELECT * FROM users");

// عرض رسالة حسب الرابط
if (isset($_GET['msg'])) {
    $messages = [
        'deleted' => ['تم حذف المستخدم بنجاح ✅', 'success'],
        'error' => ['حدث خطأ أثناء حذف المستخدم ❌', 'error'],
        'notfound' => ['المستخدم غير موجود 🔍', 'error'],
        'invalid' => ['طلب حذف غير صالح ⚠️', 'error'],
        'updated' => ['تم تغيير نوع المستخدم بنجاح ✅', 'success']
    ];
    if (array_key_exists($_GET['msg'], $messages)) {
        [$text, $type] = $messages[$_GET['msg']];
        echo "<script>window.onload = function() {
            showMessage('$text', '$type');
        };</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة المستخدمين</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/manage_user.css">
    <?php include '../header.php'; ?>
</head>
<body>

<h2>جميع المستخدمين</h2>

<table>
    <tr>
        <th>المعرف</th>
        <th>الاسم</th>
        <th>البريد الإلكتروني</th>
        <th>النوع</th>
        <th>الإجراء</th>
        <th>تغيير النوع</th>
    </tr>
    <?php while ($row = $users->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td>
            <?php
            $types = [
                'admin' => 'مدير',
                'company' => 'شركة',
                'job_seeker' => 'باحث عن عمل'
            ];
            echo $types[$row['user_type']] ?? 'غير معروف';
            ?>
        </td>
        <td>
            <a href="delete_user.php?id=<?= $row['id'] ?>" onclick="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')">حذف</a>
        </td>
        <td>
            <form method="POST" action="change_user_type.php" style="display: inline-block;">
                <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                <select name="user_type">
                    <option value="admin" <?= $row['user_type'] === 'admin' ? 'selected' : '' ?>>مدير</option>
                    <option value="company" <?= $row['user_type'] === 'company' ? 'selected' : '' ?>>شركة</option>
                    <option value="job_seeker" <?= $row['user_type'] === 'job_seeker' ? 'selected' : '' ?>>باحث عن عمل</option>
                </select>
                <button type="submit">تغيير</button>
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<!-- سكربت الرسائل -->
<script src="../showMessage.js"></script>

</body>
</html>