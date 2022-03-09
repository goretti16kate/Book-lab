<?php

$host = "localhost";
$user = "root";
$pass = "";
$db_name = "Safari_final_project";

// initiate connection
$connection = mysqli_connect($host,$user,$pass,$db_name);

//check if the connection failed
if (!isset($connection)){
    die ("DB connection failed");
}