<?php


    include '../../config.php';

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
    <link rel="stylesheet" type="text/css" href="styles/product.css">
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
  <div class="nav">
    <a href="" class="logo"><img src="https://static.mailchimp.com/web/brand-assets/logo-dark.png" alt="logo"></a>
    
    <div class="nav-links">
      <a href="">Store</a>
      <a href="">Collections</a>
      <a href="">About</a>
      <a href="">Contact</a>
    </div>
      
    <a href="" class="cart-icon"><i class="fa fa-shopping-cart"></i></a>
  </div>
  
  <div class="product group">
    <div class="col-1-2 product-image">
      <div class="bg" style="background-image: url(../../admin/myShop/images/606ad4df9584a7.85066853.jpg);"></div>
    </div>
    <div class="col-1-2 product-info">
      <h1><?php echo $product['pname']?></h1>
      <h2>Rs.<?php echo $product['price']?></h2>
      
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
      
      <a href='<?php echo "../cart/cart.inc.php?pid=$pid";?>' class="add-btn">Add To Cart</a>
      <a href='<?php echo "../wishlist/wishlist.inc.php?pid=$pid";?>' class="add-btn">Add To wishlist</a>
      <a href="" class="add-btn">Buy Now</a>

      
      <p><?php echo $product['description']?></p>
      
      <!-- <ul>
        <li>Graph paper 40-page memo book.</li>
        <li>3 book per pack. Banded and shrink-wrapped</li>
        <li>Three great memo books worth fillin' up with information</li>
        <li>Red cherry wood covers</li>
      </ul> -->
      
      <a href="" class="share-link">Tweet</a>
      <a href="" class="share-link">Like</a>
      <a href="" class="share-link">Pin</a>
      <a href="" class="share-link">Email</a>
    </div>
  </div>
  
  <footer>
		<img src="C:\xampp\htdocs\xampp\yourKart\admin\myShop\images\606ad4b8297cc9.70521354.jpg">
		<h3>Built with love by Ayana Campbell - May 24, 2015</h3>
	</footer>
  
</div>
  </body>
</html>