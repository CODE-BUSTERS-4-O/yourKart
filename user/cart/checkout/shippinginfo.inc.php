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

        $sql = "INSERT INTO shippinginfo (userid,name,contact,pincode,address) values ($user,$name,$contact,$pincode,$address);";
        $rs = mysqli_query($conn,$sql);
        if($rs){
            header("Location: shippingInfo.php");
        }else{
            echo "error";
        }
    }

    
?>