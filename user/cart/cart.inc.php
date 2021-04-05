<?php


    include '../../config.php';

    session_start();

    error_reporting(0);

    if(!isset($_SESSION['uid'])){
        header("Location : ../loginsystemUsers/index.php");
    }
    
    $pid = $_GET['pid'];
    $user = $_SESSION['uid'];


    $sql = "INSERT INTO cartproductrelation (userid,productid) values ($user,$pid)";

    if(mysqli_query($conn,$sql)){
        header("Location: ../productPage/viewProduct.php?error=none&pid=$pid");
    }else{
        header("Location: ../productPage/viewProduct.php?error=stmtfail&pid=$pid");
    }
    
    
    
?>