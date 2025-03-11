<?php
$con = mysqli_connect('localhost','root','root','learnHub');
if(!$con){
    die("Connected Error ".mysqli_error($con));
}
