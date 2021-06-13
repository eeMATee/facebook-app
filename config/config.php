<?php 
ob_start();     // Turns on output buffering

$timezone = date_default_timezone_set("Europe/London");

$con = mysqli_connect("localhost", "root", "", "social");

if(mysqli_connect_errno()) {
    echo "Failed to connets database: " . mysqli_connect_errno();
}

?>
