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
</head>
<body>
    
    <?php 
        $pid = $_GET['pid'];
        $admin = $_SESSION['aid'];
        

        $sql= "SELECT * FROM product WHERE productid = $pid";
        $result = mysqli_query($conn, $sql);
		$pd = mysqli_fetch_assoc($result);

        $cat = $pd['categoryid'];
        $brand = $pd['brandid'];
        $sql= "SELECT * FROM brand WHERE brandid = $brand";
        $result = mysqli_query($conn, $sql);
		$pdbrand = mysqli_fetch_assoc($result);

        $sql= "SELECT * FROM category WHERE categoryid = $cat";
        $result = mysqli_query($conn, $sql);
		$pdcat = mysqli_fetch_assoc($result);
    ?>
    <p class="login-text" style="font-size: 2rem; font-weight: 800;">Update a Product</p>
    <div class="card" style='background-image: url("images/<?php echo $pd['image'];?>")'>
            <div class="content">
                <h2 class="title"><?php echo $pd['pname'];?></h2>
                <p class="copy"><?php echo $pd['description'];?></p>
                
                <form action='<?php echo "updateShop.inc.php?pid=$pid";?>' method="POST">
        
                    <div class="input-group">
                        <input type="number" placeholder="Product Stock" name="stock" value = "<?php echo $pd['stock']?>" required>
                    </div>

                    <div class="input-group">
                        <input type="number" placeholder="Price of the Product in Rupees" name="price" value = "<?php echo $pd['price']?>" required>
                    </div>
                        
                   

                    <!-- <div class="input-group"> -->
                            <button name="submit" class="btn">Update</button>
                    <!-- </div> -->
                </form> 
                <p class="copy">Category : <?php echo $pdcat['categoryname']?></p><br>
                <p class = "copy">Brand : <?php echo $pdbrand['brandname']?></p><br>
            </div>
        </div>
    
    
</body>
</html>
<?php
    // if($_GET['error']="none"){
    //     echo "<script>alert('Successfully updated.')</script>";
    // }
    // if($_GET['error']="stmtfail"){
    //     echo "<script>alert('Oops! Something went wrong!!')</script>";
    // }
?>