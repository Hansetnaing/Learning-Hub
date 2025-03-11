<?php
require 'dbConnect.php';

if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    $query = "delete from student where student_id = $student_id";
    if (mysqli_query($con, $query)) {
        header("Location: stuList.php"); 
    } else {
        echo "Error deleting teacher: " . mysqli_error($con);
    }
} 
?>