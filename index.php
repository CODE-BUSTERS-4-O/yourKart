<?php
    require_once 'config.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- <link rel="stylesheet" type="text/css" href="admin/myShop/styles/myshop.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <a href="admin/loginsystemAdmin/registeradmin.php">admin registration</a>
    <!-- <a href="admin/loginsystemAdmin/index.php">admin login</a> -->
    <a href="user/loginsystemUsers/register.php">user login</a>
    <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-center page-title">Product Page - Animation</h1>
          </div>
        </div>
        <div class="row">
    <?php
        
        $sql = "SELECT * FROM product";
        $result = mysqli_query($conn, $sql);
		$products = mysqli_fetch_all($result, MYSQLI_ASSOC); 

        foreach($products as $pd):
            $pid = $pd['productid'];
            $image = $pd['image'];
    ?>
    
          <div class="col-md-3">
            <div class="product-container">
              <!-- <div class="tag-sale">
              </div> -->
              <div class="product-image">
                <span class="hover-link"></span>
                <a href='<?php echo "user/productPage/viewProduct.php?pid=$pid";?>' class="product-link">view details</a>
                <img class="img-responsive" src='<?php echo "admin/myShop/images/$image"?>' alt="">
              </div>
                <div class="product-description">
                    <div class="product-label">
                        <div class="product-name">
                            <h1><?php echo $pd['pname'];?></h1>
                            <p class="price"><?php echo $pd['price'];?></p>
                            <p><?php echo $pd['description'];?></p>
                        </div>
                    </div>
                    <div class="product-option">
                        <div class="product-size">
                            <h3>Sizes</h3>
                            <p>XS,S,M,L,XL,XXL</p>
                        </div>
                        <div class="product-color">
                            <h3>Colors</h3>
                            <ul>
                            <li class="red"></li>
                            <!-- <li class="blue"></li>
                            <li class="green"></li>
                            <li class="gray"></li>
                            <li class="black"></li>
                            <li class="dark-blue"></li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        
    <?php
        endforeach;
    ?>  
    </div>
    </div>

</body>
</html>