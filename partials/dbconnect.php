<?php 
$server = "localhost";
$username = "root";
$password = "";
$database = "cms";

$conn = mysqli_connect($server, $username, $password, $database);

if (mysqli_connect_errno()) {
    printf("", mysqli_connect_error());
}
?>