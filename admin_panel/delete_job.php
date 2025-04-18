<?php
include '../db_connect.php';
session_start();
if ($_SESSION['user_type'] !== 'admin') {
    header("Location: login.php");
    exit();
}
$id = $_GET['id'];
$conn->query("DELETE FROM jobs WHERE id = $id");
header("Location: manage_jobs.php");
?>