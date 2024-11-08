<?php

$hostname="10.10.10.157";
$username="csc210user";
$password="CSC!2qwasZX";
$dbname="group3";

$con=mysqli_connect($hostname,$username,$password,$dbname);
if(!$con){
    die("Connection faild : ".mysqli_connect_error());
}

?>


