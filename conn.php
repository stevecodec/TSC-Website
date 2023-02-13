<?php

$hostname ="localhost";
$servername ="root";
$password ="";
$db ="steve_tech";

$conn = mysqli_connect($hostname,$servername,$password,$db);

if(!$conn){
    die("connection error: ".mysqli_connect_error());
}

?>