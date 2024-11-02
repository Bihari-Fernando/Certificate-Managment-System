<?php

$hostname="localhost";
$username="root";
$password="";
$dbname="certificate";

$conn=mysqli_connect($hostname,$username,$password,$dbname);
if(!$conn){
    die("Connection faild : ".mysqli_connect_error());
}

?>


