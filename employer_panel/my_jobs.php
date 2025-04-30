<?php 
include '../db_connect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$company_id = $_SESSION['user_id'] ?? 0;
$result = $conn->query("SELECT * FROM job_posts WHERE company_id = $company_id");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>وظائفي المنشورة</title>
    <link rel="stylesheet" href="../css/header.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet">
    <?php include '../header.php'; ?>

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin: 40px 0 20px;
            color: #005b96;
            font-size: 26px;
        }

        .job-table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            overflow: hidden;
        }

        .job-table th, .job-table td {
            padding: 14px;
            text-align: center;
            font-size: 16px;
            border-bottom: 1px solid #ddd;
        }

        .job-table th {
            background-color: #005b96;
            color: white;
        }

        .job-table tr:hover {
            background-color: #f1f1f1;
        }

        .edit-button {
            color: white;
            background-color: #5bc0de;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            margin: 0 4px;
        }

        .edit-button:hover {
            background-color: #31b0d5;
        }

        .applicants-button {
            color: white;
            background-color: #5cb85c;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            margin: 0 4px;
        }

        .applicants-button:hover {
            background-color: #449d44;
        }

        .delete-button {
            color: white;
            background-color: #d9534f;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            margin: 0 4px;
        }

        .delete-button:hover {
            background-color: #c9302c;
        }

        .no-jobs {
            text-align: center;
            color: #999;
            font-size: 18px;
            margin-top: 40px;
        }
    </style>
</head>

<body>

<h2>وظائفي المنشورة</h2>

<?php if ($result->num_rows > 0): ?>
    <table class="job-table">
        <tr>
            <th>المسمى الوظيفي</th>
            <th>الموقع</th>
            <th>الإجراءات</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['location']) ?></td>
            <td>
                <a href="edit_job.php?id=<?= $row['id'] ?>" class="edit-button">تعديل</a>
                <a href="view_applicants.php?job_id=<?= $row['id'] ?>" class="applicants-button">المتقدمون</a>
                <a href="../admin_panel/delete_job.php?id=<?= $row['id'] ?>" 
                   onclick="return confirm('هل أنت متأكد من حذف هذه الوظيفة؟')" 
                   class="delete-button">حذف</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p class="no-jobs">لا توجد وظائف منشورة حاليًا.</p>
<?php endif; ?>

</body>
</html>
