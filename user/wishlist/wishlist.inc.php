<?php


    include '../../config.php';

    session_start();

    error_reporting(0);

    if(!isset($_SESSION['uid'])){
        header("Location : ../loginsystemUsers/index.php");
    }
    
    
    $pid = $_GET['pid'];
    $user = $_SESSION['uid'];

    $checkIfPresent = "SELECT * FROM wishproductrelation WHERE userid=$user AND productid = $pid;";
    $check = mysqli_query($conn,$checkIfPresent);

    if($check->num_rows > 0){
        
        $cartentry = mysqli_fetch_assoc($check);
        $quantity = $cartentry['quantity'];
        $quantity++;
        $sqlupdate = "UPDATE wishproductrelation SET quantity=$quantity WHERE userid=$user AND productid = $pid;";
        $updated = mysqli_query($conn,$sqlupdate);
        
    }else{
        $sqlinsert = "INSERT INTO wishproductrelation (userid,productid, quantity) values ($user,$pid, 1)";
        $inserted = mysqli_query($conn,$sqlinsert);
    }

    if($updated or $inserted){
        
        $quantityupdate = "UPDATE wishlist SET quantity=(SELECT sum(quantity) FROM wishproductrelation WHERE userid = $user);";
        $qupdate = mysqli_query($conn,$quantityupdate);

        if($qupdate){
            header("Location: ../../wishlist.php");
        }else{
            echo '<script>alert("Oops! SOmething went wrong")</script>';
        }
    }else{
        header("Location: ../productPage/viewProduct.php?error=stmtfail&pid=$pid");
    }
    
    
    
?>