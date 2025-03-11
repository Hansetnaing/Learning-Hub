<html>
    <form action="" method="post">
        <input type="radio" name="show" value="All">All
        <input type="radio" name="show" value="Male">Male
        <input type="radio" name="show" value="Female">Female
        <input type="submit" name="submit" value="show">
    </form>
    <br><br>
</html>
<?php

require 'KPTMYK_001298(connect).php';

if(mysqli_select_db($con,'kptmyk_001298')){
    
if(isset($_POST['submit'])){
    $radio = $_POST['show'];
    $query;

    if($radio == 'All') {
        $query = 'select * from student';
    } elseif($radio == 'Male') {
        $query = "select * from student where gender = 'Male'";
    } elseif($radio == 'Female') {
        $query = "select * from student where gender = 'Female'";
    }

    if($query) {
        $result = mysqli_query($con, $query);

            echo "<table border='1'><tr>";
            echo "<th>RollNo</th><th>Name</th><th>Gender</th><th>Major</th><th>Address</th></tr>";

            while($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>".$row['rollno']."</td>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['gender']."</td>";
                echo "<td>".$row['major']."</td>";
                echo "<td>".$row['address']."</td>";
                echo "</tr>";
            }
            echo "</table>";
    }

    mysqli_close($con);
}

}
?>