<?php
session_start();

if (!isset($_SESSION['name']) || !isset($_SESSION['password'])) {
    header("Location: login.php");
    exit;
}

require 'dbConnect.php';

$name = $_SESSION['name'];
$pw = $_SESSION['password'];

$select = "SELECT * FROM teacher WHERE name='$name' AND password='$pw'";
$query = mysqli_query($con, $select);
$user = mysqli_fetch_assoc($query);

if ($user) {
    $_SESSION['t_id'] = $user['teacher_id'];
    header("Location: teacher.php");
    exit;
} else {
    header("Location: login.php");
    exit;
}
?>