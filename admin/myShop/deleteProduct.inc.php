<?php
    require_once '../../config.php';

    session_start();

    if(!isset($_SESSION['aid'])){
        header("Location ../loginsystemAdmin/index.php");
    }

    $pid =  $_GET['pid'];   
    $sql = "DELETE FROM product WHERE productid = $pid";

    if(mysqli_query($conn,$sql)){
        header("Location: manageShop.php?error=none");
    }else{
        header("Location: manageShop.php?error=stmtfail");
    }
?>