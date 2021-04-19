<?php


    include 'config.php';
    include 'header.php';
    session_start();

    error_reporting(0);

    $pid = $_GET['pid'];

    $sql = "SELECT * FROM product WHERE productid = $pid";
    $result = mysqli_query($conn,$sql);
    $product = mysqli_fetch_assoc($result);
    $image = $product['image'];
    
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
    <link rel="stylesheet" type="text/css" href="user/productPage/styles/product.css">
    <link rel="stylesheet" type="text/css" href="user/productPage/styles/button.css">

    <!-- <script src="js.js" charset="utf-8"></script> -->
    <title>Document</title>
</head>
<body>
    <?php
      if(isset($_GET['error'])){
        if($_GET['error'] = "none"){
          echo "<script>alert('Successfully added to cart')</script>";
        }
        if($_GET['error'] = "stmtfail"){
          echo "<script>alert('Oops! Something went wrong')</script>";
        }

      }
    ?>

<div class="wrapper"> 
  
  <?php $image=$product['image'];?>
  <div class="product group">
    <div class="col-1-2 product-image">
      <div class="bg" style='background-image: url(<?php echo "admin/myShop/images/$image";?>);'></div>
    </div>
    <div class="col-1-2 product-info">
      <h1 class="name"><?php echo $product['pname']?></h1>
      <h2 class="price">Rs.<?php echo $product['price']?></h2>
      <p class="des"><?php echo $product['description']?></p>

      <!-- <div class="select-dropdown">
        <select>
          <option value="size">Size</option>
          <option value="size">Small</option>
          <option value="size">Medium</option>
          <option value="size">Large</option>
        </select>
      </div> -->
      
      <!-- <div class="select-dropdown">
        <select>
          <option value="quantity">1</option>
          <option value="quantity">2</option>
          <option value="quantity">3</option>
          <option value="quantity">4</option>
        </select>
      </div> -->
      
      <br>
      <button class="btn btn-4 btn-4b "><a href='<?php echo "user/cart/cart.inc.php?pid=$pid";?>'>Add To Cart</a></button>
      <button class="btn btn-4 btn-4b "><a href='<?php echo "user/wishlist/wishlist.inc.php?pid=$pid";?>'>Add To wishlist</a></button>
      <button class="btn btn-4 btn-4b "><a href="">Buy Now</a></button>

      <?php 
        $adid=$product['adminid'];
        $sql = "SELECT * FROM admin WHERE adminid=$adid";
        $result=mysqli_query($conn, $sql);
        $addetails=mysqli_fetch_assoc($result);
        $shopname=$addetails['shopname'];
      ?>
      <p class="des">Sold By: <?php echo $shopname?></p>
      
      <!-- <ul>
        <li>Graph paper 40-page memo book.</li>
        <li>3 book per pack. Banded and shrink-wrapped</li>
        <li>Three great memo books worth fillin' up with information</li>
        <li>Red cherry wood covers</li>
      </ul> -->
      
    
    </div>
  </div>
  
 
  
</div>
  </body>
</html>