<?php 

    include '../../../config.php';

    session_start();

    error_reporting(0);

    if(!isset($_SESSION['uid'])){
        header("Location : ../loginsystemUsers/index.php");
    }


    if(isset($_POST['submit'])){
        $user = $_SESSION['uid'];
        $name = $_POST['fullname'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $pincode = $_POST['pincode'];

        $sql = "INSERT INTO shippinginfo(userid, fname, contact, pincode, saddress) VALUES ('$user','$name', '$contact', '$pincode', '$address');";

        if(mysqli_query($conn,$sql)){
            header("Location: shippingInfo.php");
        }else{
            echo "ohhh nooo";
        }
    }

    
?>