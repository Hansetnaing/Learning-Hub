<?php
require 'KPTMYK_001298(connect).php';

if(mysqli_select_db($con,'kptmyk_001298')){
$query = 'update student set gender="Male" where name="Mg Ko Ko";';
$update = mysqli_query($con,$query);
if($update){
    echo "Update Successful!";
}
}