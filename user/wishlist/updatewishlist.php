<?php
    include '../../config.php';

    session_start();

    error_reporting(0);

    if(!isset($_SESSION['uid'])){
        header("Location : ../loginsystemUsers/index.php");
    }
    
    $user = $_SESSION['uid'];
    $pid = $_GET['pid'];

    if(isset($_POST['remove'])){
        $deleteItem = "DELETE FROM wishproductrelation WHERE userid = $user AND productid=$pid;";
        $deleted = mysqli_query($conn,$deleteItem);
    }
    if($deleted){
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
            header("Location: ../../wishlist.php");
        }else{
            echo '<script>alert("Oops! SOmething went wrong")</script>';
        }
    }

    if(isset($_POST['move'])){
        $checkIfPresent = "SELECT * FROM cartproductrelation WHERE userid=$user AND productid = $pid;";
        $check = mysqli_query($conn,$checkIfPresent);

        if($check->num_rows > 0){
            $cartentry = mysqli_fetch_assoc($check);
            $quantity = $cartentry['quantity'];
            $quantity++;
            $sqlupdate = "UPDATE cartproductrelation SET quantity=$quantity WHERE userid=$user AND productid = $pid;";
            $updated = mysqli_query($conn,$sqlupdate);
        }else{
            $sqlinsert = "INSERT INTO cartproductrelation (userid,productid, quantity) values ($user,$pid, 1)";
            $inserted = mysqli_query($conn,$sqlinsert);
        }
        if($updated or $inserted){
        
            $deleteItem = "DELETE FROM wishproductrelation WHERE userid = $user AND productid=$pid;";
            $deleted = mysqli_query($conn,$deleteItem);
            
            if($deleted){
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
                    header("Location: ../../wishlist.php");
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
    }

    


?>