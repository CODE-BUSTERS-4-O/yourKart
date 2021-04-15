<?php
    include '../../config.php';

    session_start();

    error_reporting(0);

    if(!isset($_SESSION['uid'])){
        header("Location: ../loginsystemUsers/index.php");
    }
    
    $user = $_SESSION['uid'];
    $adid = $_GET['adid'];

    $tc = $_GET['tc'];
    $date = getdate();
    // print_r($date);
    $din = $date['year']."-".$date['mon']."-".$date['mday'];
    echo $din;
    $sql = "INSERT INTO payment(userid,amount,pdate,mode,status) VALUES ('$user','$tc','$din','online','payed');";
    $rs = mysqli_query($conn,$sql);

    if($rs){
        $sl = "SELECT * FROM payment WHERE userid=$user AND pdate LIKE '$din';";
        $r = mysqli_query($conn,$sl);
        $entry = mysqli_fetch_assoc($r);
        $payid = $entry['paymentid'];
        header("Location: ordertabinsert.php?amt=$tc&adid=$adid&pid=$payid");
    }else{
        echo "failed";
    }

?>