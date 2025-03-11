<?php
session_start();

if (!isset($_SESSION['name']) || !isset($_SESSION['password'])) {
    header("Location: login.php");
    exit;
}

require 'dbConnect.php';

$name = $_SESSION['name'];
$pw = $_SESSION['password'];

$select = "SELECT * FROM student WHERE name='$name' AND password='$pw'";
$query = mysqli_query($con, $select);
$user = mysqli_fetch_assoc($query);

if ($user) {
    $_SESSION['s_id'] = $user['student_id'];
    header("Location: student.php");
    exit;
} else {
    header("Location: login.php");
    exit;
}
?>