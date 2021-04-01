<?php 

$server = "localhost";
$user = "Prince";
$pass = "Prince@1234";
$database = "yourkart";

$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
    die("<script>alert('Connection Failed.')</script>");
}

?>