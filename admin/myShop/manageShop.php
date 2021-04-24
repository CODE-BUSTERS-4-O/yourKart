<?php
    require_once '../../config.php';

    session_start();

    if(!isset($_SESSION['aid'])){
        header("Location ../loginsystemAdmin/index.php");
    }
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

    <link rel="stylesheet" type="text/css" href="styles/styleshop.css">\

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="styles/js.js" charset="utf-8"></script>
</head>
<body>

<button class="btn btn-success"><a href='addproduct.php'>Add a product</a></button>
<button class="btn btn-success" style="float:right; margin-right:10px"><a href='../loginsystemAdmin/logout.php'>Log Out</a></button>


    <!-- <h1 class="text">Products</h1>
    <div class= "outing">
    <main class="page-content"> -->
    <div class="container">
        <div class="well well-sm">
        <div id="products" class="row list-group">
    <?php
        $admin = $_SESSION['aid'];
        $sql = "SELECT * FROM product WHERE adminid = $admin";
        $result = mysqli_query($conn, $sql);
		$products = mysqli_fetch_all($result, MYSQLI_ASSOC); 

        foreach($products as $pd):
            $pid = $pd['productid'];
            $image = $pd['image'];
            $c = $pd['categoryid'];
            $sql1 = "SELECT * FROM category WHERE categoryid = $c;";
            $result1 = mysqli_query($conn, $sql1);
		    $cat = mysqli_fetch_assoc($result1); 

    ?>
        <div class="item  col-xs-4 col-md-3">
            <div class="thumbnail">
                <img class="group list-group-image" src='<?php echo "images/$image";?>' alt="" />
                <div class="category">
                    <h5 class="category-name"><?php echo $cat['categoryname'];?></h5>
                </div>
                <div class="caption">
                    <h4 class="group inner list-group-item-heading"><?php echo $pd['pname'];?></h4>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <p class="lead">Rs.<?php echo $pd['price'];?></p>
                        </div>
                        <div class="btn-group">
                            <a class="btn btn-details" href='<?php echo "updateShop.php?pid=$pid";?>'>Update</a>
                                <a class="btn btn-success" href='<?php echo "deleteProduct.inc.php?pid=$pid";?>'>Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="card" style='background-image: url("images/<?php echo $pd['image'];?>")'>
            <div class="content">
                <h2 class="title"><?php echo $pd['pname'];?></h2>
                <p class="copy"><?php echo $pd['description'];?></p>
                <a href='<?php echo "updateShop.php?pid=$pid";?>'>
                <button class="btn" >Update</button></a>
                <a href='<?php echo "deleteProduct.inc.php?pid=$pid";?>'>
                <button class="btn" >DELETE</button></a>
            </div>
        </div> -->
        
    <?php
        endforeach;
    ?>
        </div>
    </div>    
        
    </main>
</div>
</body>
</html>