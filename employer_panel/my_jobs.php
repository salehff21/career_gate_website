<?php
include '../db_connect.php';
session_start();
$employer_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM job_posts WHERE user_id = $employer_id");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../style.css"><title>My Jobs</title></head>
<body>
<h2>My Posted Jobs</h2>
<table border="1">
<tr><th>Title</th><th>Location</th><th>Actions</th></tr>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['title'] ?></td>
    <td><?= $row['location'] ?></td>
    <td>
        <a href="edit_job.php?id=<?= $row['id'] ?>">Edit</a> | 
        <a href="view_applicants.php?job_id=<?= $row['id'] ?>">Applicants</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>