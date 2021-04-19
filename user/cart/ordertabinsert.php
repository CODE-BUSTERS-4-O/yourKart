<?php
    include '../../config.php';

    session_start();

    error_reporting(0);

    if(!isset($_SESSION['uid'])){
        header("Location: ../loginsystemUsers/index.php");
    }
    
    $user = $_SESSION['uid'];
    $adid = $_GET['adid'];

    $tc = $_GET['amt'];
    $pid = $_GET['pid'];
    $date = getdate();
    // print_r($date);
    $din = $date['year']."-".$date['mon']."-".$date['mday'];
    // echo $din;

    $cart = "SELECT * FROM cartproductrelation WHERE userid = $user";
    $run = mysqli_query($conn,$cart);
    $products = mysqli_fetch_all($run,MYSQLI_ASSOC);
    $count =0;

    foreach($products as $pd):
        $prodid = $pd['productid'];
        $qu = $pd['quantity'];
        
        $sql = "INSERT INTO orders(userid,productid,amount,odate,paymentid,addressid,quantity,status) VALUES ('$user','$prodid','$tc','$din','$pid','$adid','$qu',0);";
        $in = mysqli_query($conn,$sql);
        if($in){
            $count++;
        }
    endforeach;

    // if($count == $products->num_rows){
        $del = "DELETE FROM cartproductrelation WHERE userid=$user";
        $rd = mysqli_query($conn,$del);

        $update = "UPDATE cart SET quantity = 0 WHERE userid=$user";
        $up = mysqli_query($conn,$update);

        $updatetc = "UPDATE cart SET totalcost = 0 where userid=$user";
        $id = mysqli_query($conn,$updatetc);

        if($rd and $up and $id){
            header("Location: ../../index.php");
        }else {
            echo "fail";
        }
    // }

?>