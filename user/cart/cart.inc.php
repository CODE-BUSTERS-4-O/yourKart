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
        $uid = $_SESSION['uid'];
        $pid = $_GET['pid'];
        $sql2 = "UPDATE cart SET totalcost=(SELECT sum(price) FROM product WHERE productid in (SELECT productid FROM cartproductrelation WHERE userid=$uid));";
        $sql = "UPDATE cart SET quantity=(SELECT count(userid) FROM cartproductrelation WHERE userid=$uid);";
        
        
        $rs = mysqli_query($conn, $sql);
        $result = mysqli_query($conn, $sql2);
        if($rs){
            echo '<script>alert("OHHHHHHHHH yeah rs")</script>';
        }else{
            echo '<script>alert("OHHHHHHHHH shittt rs")</script>';
        }
        if($result){
            echo '<script>alert("OHHHHHHHHH yeah  result")</script>';
        }else{
            echo '<script>alert("OHHHHHHHHH shittt result")</script>';
        }

    }else{
        header("Location: ../productPage/viewProduct.php?error=stmtfail&pid=$pid");
    }
    
    
    
?>