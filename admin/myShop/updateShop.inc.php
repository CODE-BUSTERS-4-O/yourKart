<?php
    require_once '../../config.php';

    session_start();

    if(!isset($_SESSION['aid'])){
        header("Location ../loginsystemAdmin/index.php");
    }

    if(isset($_POST['submit'])){
        $name = $_POST['pname'];
        $desc = $_POST['description'];
        $stock = $_POST['stock'];
        $price = $_POST['price'];
        $pid = $_GET['pid'];
        $admin = $_SESSION['aid'];

        // $sql = "UPDATE product SET pname=$name,stock=$stock,price=$price,description=$desc WHERE productid = $pid;";
        $sql = "UPDATE product SET  stock=$stock,price=$price WHERE productid = $pid;";
        if(mysqli_query($conn, $sql)){
            header("Location: manageShop.php?error=none");
            // echo "done";
        }else{
            header("Location: updateShop.php?error=stmtfail&pid=$pid");
            // echo 'Problem';
        }
    }
?>