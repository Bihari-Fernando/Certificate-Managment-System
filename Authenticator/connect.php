<?php

$hostname="10.10.10.157";
$username="csc210user";
$password="CSC210!";
$dbname="certificate";

$conn=mysqli_connect($hostname,$username,$password,$dbname);
if(!$conn){
    die("Connection faild : ".mysqli_connect_error());
}

?>


