<?php

$hostname="localhost";
$username="root";
$password="";
$dbname="certificate";

$con=mysqli_connect($hostname,$username,$password,$dbname);
if(!$con){
    die("Connection faild : ".mysqli_connect_error());
}

?>


