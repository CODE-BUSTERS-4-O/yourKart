<?php 

    include '../../../config.php';

    session_start();

    error_reporting(0);

    if(!isset($_SESSION['uid'])){
        header("Location : ../loginsystemUsers/index.php");
    }


    if(isset($_POST["submit"])){
        $user = $_SESSION['uid'];
        $name = $_POST['fullname'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $pincode = $_POST['pincode'];

        $sql = "INSERT INTO shippinginfo (userid, fname, contact, pincode, saddress) VALUES (41, 'lisa', 7485, 859674, 'fvbgfdbver');";

        if(mysqli_query($conn,$sql)){
            echo "ewdc";
        }else{
            echo "ohhh nooo";
        }
    }

    
?>