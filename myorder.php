<?php
    include 'config.php';
    include_once 'header.php';

    session_start();

    error_reporting(0);

    if(!isset($_SESSION['uid'])){
        header("Location: user/loginsystemUsers/index.php");
    }
    
    $user = $_SESSION['uid'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="user/cart/stylecart/cart.css">
    <link rel="stylesheet" type="text/css" href="src/header.css">

    <script src="stylecart/cart.js" charset="utf-8"></script>
    <title>Document</title>
</head>
<body >
    <div class="container">
    <h1>MY ORDERS</h1>

<div class="shopping-cart">

  <div class="column-labels">
    <label class="product-image">Image</label>
    <label class="product-details">Product</label>
    <label class="product-price">Price</label>
    <label class="product-quantity">Quantity</label>
    <label class="product-removal">Remove</label>
    <label class="product-line-price">Total</label>
  </div>

  <?php 
      $sql = "SELECT *  FROM orders WHERE userid=$user order by orderid desc";
      $result = mysqli_query($conn, $sql);
      $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);


  ?>

  <?php  foreach($orders as $order): 
        $productid= $order['productid'];
        // echo $productid;
        $sql = "SELECT * FROM product where productid=$productid;";
        $result = mysqli_query($conn, $sql);
        $product = mysqli_fetch_assoc($result);
// print_r($product);
        $image=$product['image'];   
        // $prodid = $product['productid'];
        // $cartproduct = "SELECT * FROM orders WHERE userid = $user AND productid = $prodid;";
        // $resultprod = mysqli_query($conn,$cartproduct);
        // $prodcuctincart = mysqli_fetch_assoc($resultprod);
        $totalprice = $order['quantity']*$product['price']; 
  ?>

    <div class="product">
        <div class="product-image">
        <img src= '<?php echo "admin/myShop/images/$image"; ?>'>
        </div>
        <div class="product-details">
        <div class="product-title"><?php echo $product['pname']; ?></div>
        <p class="product-description"><?php echo $product['description'];?></p>
        <p class="product-description"><?php echo $order['odate'];?></p>
        </div>
        <div class="product-price"><?php echo $product['price']; ?></div>
        <div class="product-quantity">
        <p class="product-description"><?php echo $order['quantity'];?></p>
        </div>
        <div class="product-line-price"><?php echo $totalprice?></div>
    </div>

  <?php endforeach;?>

  

</div>

    </div>
  
  </body>
</html>