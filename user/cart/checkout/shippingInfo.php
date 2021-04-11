<?php 

    include '../../../config.php';

    session_start();

    error_reporting(0);

    if(!isset($_SESSION['uid'])){
        header("Location : ../loginsystemUsers/index.php");
    }

    $user = $_SESSION['uid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="shipping.css">
    <title>Document</title>
</head>
<body>

    <ul class="cards">
        
      <?php
      
          $sql = "SELECT * FROM shippinginfo WHERE userid=$user";
          $result = mysqli_query($conn,$sql);
          $address = mysqli_fetch_all($result,MYSQLI_ASSOC);

          foreach($address as $ad):
            $adid = $ad['adressid'];
      ?>
        <li class="cards__item">
          <div class="card">
            <div class="card__content">
              <!-- <div class="card__title">Flex</div> -->
              <p class="card__text">
                <?php echo $ad['fname'];?>
                <?php echo $ad['contact'];?>
                <?php echo $ad['address'];?>
                <?php echo $ad['pincode'];?>
              </p>
              <!-- <button class="btn btn--block card__btn"><a href='<?php echo "updateshipping.php?adid=$adid";?>'>Update</a></button>
              <button class="btn btn--block card__btn"><a href='<?php echo "updateshipping.php?adid=$adid";?>'>Remove</a></button> -->
            </div>
          </div>
        </li>
      
      
        <?php endforeach;?>
        
        <li class="cards__item">
          <div class="card">
            <!-- <div class="card__image card__image--flowers"></div> -->
            <div class="card__content">
              <div class="card__title">Flex Basis</div>
              <p class="card__text"></p>
              <button class="btn btn--block card__btn"><a href='<?php echo "shippingInfoadd.php";?>'>Add new address</a></button>
            </div>
          </div>
        </li>

    </ul>
    
    
</body>
</html>