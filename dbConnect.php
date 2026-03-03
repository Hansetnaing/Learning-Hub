<?php
$con = mysqli_connect('localhost','root','root','learnhub');
if(!$con){
    die("Connected Error ".mysqli_error($con));
}
