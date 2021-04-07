<?php


    include '../../config.php';

    session_start();

    error_reporting(0);

    if(!isset($_SESSION['uid'])){
        header("Location : ../loginsystemUsers/index.php");
    }
    
    $pid = $_GET['pid'];
    $user = $_SESSION['uid'];


    $sql = "INSERT INTO wishproductrelation (userid,productid) values ($user,$pid)";

    if(mysqli_query($conn,$sql)){
        $uid = $_SESSION['uid'];
        $pid = $_GET['pid'];
        $sql = "UPDATE wishlist SET quantity=(SELECT count(userid) FROM wishproductrelation WHERE userid=$uid);";
             
        $rs = mysqli_query($conn, $sql);
        if($rs){
            echo '<script>alert("OHHHHHHHHH yeah")</script>';
        }else{
            echo '<script>alert("OHHHHHHHHH shittt rs")</script>';
        }

    }else{
        header("Location: ../productPage/viewProduct.php?error=stmtfail&pid=$pid");
    }
   
?>