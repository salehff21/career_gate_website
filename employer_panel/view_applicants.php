<?php
include 'db.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$job_id = $_GET['job_id'];
$result = $conn->query("SELECT * FROM applications WHERE job_id = $job_id");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../style.css"><title>Applicants</title></head>
<body>
<h2>Applicants for Job ID: <?= $job_id ?></h2>
<table border="1">
<tr><th>Name</th><th>Email</th><th>Resume</th></tr>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['name'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><a href="<?= $row['resume'] ?>" target="_blank">View Resume</a></td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>