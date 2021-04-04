<?php 

include '../../config.php';

error_reporting(0);

session_start();
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
    <form action="addproduct.inc.php" method="POST" enctype="multipart/form-data">
        <p class="login-text" style="font-size: 2rem; font-weight: 800;">Add a Product</p>
        <div class="input-group">
            <input type="text" placeholder="Product name" name="pname" required>
        </div>
        <div class="input-group">
            <input type="text" placeholder="Product Description" name="description" required>
        </div>
        <div class="input-group">
            <input type="number" placeholder="Product Stock" name="stock" required>
        </div>
        <div class="input-group">
            <input type="number" placeholder="Price of the Product in Rupees" name="price" required>
        </div>
        <select class="buton" name ="category">
            <option class="buton" value= disabled required>CHOOSE PRODUCT CATEGORY</option>
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

        <select class="buton" name ="brand">
            <option class="buton" value= disabled required>CHOOSE BRAND OF PRODUCT </option>
            <?php 
                $sql = "SELECT * FROM brand";
                $result = mysqli_query($conn, $sql);
				$brands = mysqli_fetch_all($result, MYSQLI_ASSOC);
            ?>
            <?php 
                foreach($brands as $brand): ?>
                    <option class="buton" value= "<?php echo $brand['brandid'];?>"> <?php echo $brand['brandname'];?></option>
                <?php endforeach; ?> 
               
        </select>

        <label class="buton" for="file2">Upload Product Image</label>
        <input class="buton" id = "file2" type="file" name="file"><br>

        <!-- <div class="input-group"> -->
				<button name="submit" class="btn">Add</button>
		<!-- </div> -->
    </form> 
</body>
</html>