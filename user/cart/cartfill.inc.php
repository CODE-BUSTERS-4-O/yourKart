<?php 
    
    include '../../config.php';

    session_start();

    error_reporting(0);

    
    if(!isset($_SESSION['uid'])){
        header("Location : ../loginsystemUsers/index.php");
    }
    
?>