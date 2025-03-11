<?php
require 'dbConnect.php';

if (isset($_GET['id'])) {
    $teacher_id = $_GET['id'];

    $query = "DELETE FROM teacher WHERE teacher_id = $teacher_id";
    if (mysqli_query($con, $query)) {
        header("Location: tList.php"); 
    } else {
        echo "Error deleting teacher: " . mysqli_error($con);
    }
} 
?>