<?php
    require_once 'config.php';
    include_once 'header.php';
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
    <?php 
    if(isset($_SESSION['aid'])){
        header("Location: admin/myShop/manageShop.php?error=none");
    }
    if(isset($_SESSION['uid'])){
    ?>
        <button class="btn btn-success" style="float:right; margin-right:10px ; text-color:white"><a href='user/loginsystemUsers/logout.php'>Log Out</a></button>
    <?php 
    }
    
    else{
    ?>

    <button class="btn btn-success" style="float:right; margin-right:10px ; text-color:white"><a href='user/loginsystemUsers/register.php'>Log In as User   </a></button><br><br><br>
    <button class="btn btn-success" style="float:right; margin-right:10px ; text-color:white"><a href='admin/loginsystemAdmin/registeradmin.php'>Log In as Admin</a></button>

    <?php 
    }
    ?>


    <?php 
    $lower=0;
    $upper=100000;
    if(isset($_GET['lower'])){
        $lower=$_GET['lower'];
    }
    if(isset($_GET['upper'])){
        $upper=$_GET['upper'];
    }
    ?>


    <form action="" METHOD='GET'>
    <label for="category">Filter By Category:</label>
      <?php 
        if(isset($_GET['category'])){
            $cat = $_GET['category'];
        }else{
            $cat=0;
        }
        if($cat==0){
            $pcat="FILTER";
        }else{
            $sql= " SELECT categoryname FROM category WHERE categoryid=$cat"; 
            $result = mysqli_query($conn, $sql);
            $rcat = mysqli_fetch_assoc($result); 
            $pcat=$rcat['categoryname'];
        } 
        ?>

        <select class="buton" name ="category">
            <option class="buton" value= disabled required><?php echo $pcat; ?></option>
            <?php 
                $sql = "SELECT * FROM category";
                $result = mysqli_query($conn, $sql);
				$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
            ?>
            <?php 
                foreach($categories as $cat): ?>
                    <option class="buton" value= "<?php echo $cat['categoryid'];?>"> <?php echo $cat['categoryname'];?></option>
                <?php endforeach; ?> 
               
        </select>
        <br>
        <label for="price">Filter By Price:</label>
        <input type="int" placeholder="Minimum Price" value="<?php echo $lower; ?>" id="lower" name="lower" > 
        to       
        <input type="int" placeholder="Maximum Price" id="upper" value="<?php echo $upper;?>" name="upper" > <br>
        <br>
        <input type="submit" class="btn btn-success">
    </form>

    <!-- <form action="index.php?category=<?php echo $cat?>" METHOD='GET'>
    
        <input type="submit" value="Submit" class="btn btn-success">   
    </form> -->

    <!-- <a href="admin/loginsystemAdmin/registeradmin.php">admin registration</a>
    <a href="admin/loginsystemAdmin/index.php">admin login</a>
    <a href="user/loginsystemUsers/register.php">user login</a> -->
    <div class="container">
        <!-- <div class="row">
          <div class="col-md-12">
            <h1 class="text-center page-title">Product Page - Animation</h1>
          </div>
        </div>
        <div class="row"> -->
    <?php
        
    
        
        
        if(isset($_GET['category'])){
            $cat=$_GET['category'];
            if($cat==0){
                    $sql = "SELECT * FROM product WHERE price BETWEEN $lower and $upper";
            }else{
                
                $sql="SELECT * FROM product where categoryid=$cat and  price BETWEEN $lower and $upper";
            }
        }else{
            $sql = "SELECT * FROM product";
        }
         
       

        
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
                <a href='<?php echo "viewProduct.php?pid=$pid";?>' class="product-link">view details</a>
                <img class="img-responsive" src='<?php echo "admin/myShop/images/$image"?>' alt="">
              </div>
                <div class="product-description">
                    <div class="product-label">
                        <div class="product-name">
                            <h1><?php echo $pd['pname'];?></h1>
                            <p class="price">Rs.<?php echo $pd['price'];?></p>
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