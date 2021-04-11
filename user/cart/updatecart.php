<?php
    include '../../config.php';

    session_start();

    error_reporting(0);

    if(!isset($_SESSION['uid'])){
        header("Location : ../loginsystemUsers/index.php");
    }
    
    $user = $_SESSION['uid'];
    $pid = $_GET['pid'];

    if(isset($_POST['update'])){
        $quantity = $_POST['quantity'];
        $sqlupdate = "UPDATE cartproductrelation SET quantity=$quantity WHERE userid=$user AND productid = $pid;";
        $updated = mysqli_query($conn,$sqlupdate);  
    }

    if(isset($_POST['remove'])){
        $deleteItem = "DELETE FROM cartproductrelation WHERE userid = $user AND productid=$pid;";
        $deleted = mysqli_query($conn,$deleteItem);
    }

    if($deleted or $updated){
        $quantityupdate = "UPDATE cart SET quantity=(SELECT sum(quantity) FROM cartproductrelation WHERE userid = $user);";
        $qupdate = mysqli_query($conn,$quantityupdate);

        $sql = "SELECT * FROM cartproductrelation WHERE userid=$user;";
        $result = mysqli_query($conn,$sql);

        $cartproduct = mysqli_fetch_all($result,MYSQLI_ASSOC);
        $sum = 0;

        foreach($cartproduct as $cp):
            $prod = $cp['productid'];
            $productfetch = "SELECT * FROM product WHERE productid = $prod;";
            $proresult = mysqli_query($conn,$productfetch);
            $product = mysqli_fetch_assoc($proresult);
            $price = $product['price'];
            $quantity = $cp['quantity'];
            $sum = $sum + ($price*$quantity);
        endforeach;

        $tcupdate = "UPDATE cart SET totalcost = $sum WHERE userid = $user";
        $tcupdated = mysqli_query($conn,$tcupdate);

        if($qupdate and $tcupdated){
            header("Location: ../../cart.php");
        }else{
            echo '<script>alert("Oops! SOmething went wrong")</script>';
        }
    }

    if(isset($_POST['addtowish'])){
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
            $quantityupdate1 = "UPDATE wishlist SET quantity=(SELECT sum(quantity) FROM wishproductrelation WHERE userid = $user);";
            $qupdate1 = mysqli_query($conn,$quantityupdate1);

            $deleteItem = "DELETE FROM cartproductrelation WHERE userid = $user AND productid=$pid;";
            $deleted = mysqli_query($conn,$deleteItem);
            
            if($qupdate1 and $deleted){
                $quantityupdate = "UPDATE cart SET quantity=(SELECT sum(quantity) FROM cartproductrelation WHERE userid = $user);";
                $qupdate = mysqli_query($conn,$quantityupdate);

                $sql = "SELECT * FROM cartproductrelation WHERE userid=$user;";
                $result = mysqli_query($conn,$sql);

                $cartproduct = mysqli_fetch_all($result,MYSQLI_ASSOC);
                $sum = 0;

                foreach($cartproduct as $cp):
                    $prod = $cp['productid'];
                    $productfetch = "SELECT * FROM product WHERE productid = $prod;";
                    $proresult = mysqli_query($conn,$productfetch);
                    $product = mysqli_fetch_assoc($proresult);
                    $price = $product['price'];
                    $quantity = $cp['quantity'];
                    $sum = $sum + ($price*$quantity);
                endforeach;

                $tcupdate = "UPDATE cart SET totalcost = $sum WHERE userid = $user";
                $tcupdated = mysqli_query($conn,$tcupdate);

                if($qupdate and $tcupdated){
                    header("Location: ../../cart.php");
                }else{
                    echo '<script>alert("Oops! SOmething went wrong1")</script>';
                }
                // header("Location: cart.php");
            }else{
                echo '<script>alert("Oops! SOmething went wrong2")</script>';
            }
        }else{
            header("Location: ../productPage/viewProduct.php?error=stmtfail&pid=$pid");
        }
    }else{
        echo '<script>alert("Oops! SOmething went wrong3")</script>'; 
    }

    


?>