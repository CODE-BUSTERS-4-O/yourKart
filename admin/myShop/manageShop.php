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

    <link rel="stylesheet" type="text/css" href="styles/myshop.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>


    <h1 class="text">Places Of Interest</h1>
    <div class= "outing">
    <main class="page-content">

    <?php
        $admin = $_SESSION['aid'];
        $sql = "SELECT * FROM product WHERE adminid = $admin";
        $result = mysqli_query($conn, $sql);
		$products = mysqli_fetch_all($result, MYSQLI_ASSOC); 

        foreach($products as $pd):
            $pid = $pd['productid'];
    ?>
        <div class="card" style='background-image: url("images/<?php echo $pd['image'];?>")'>
            <div class="content">
                <h2 class="title"><?php echo $pd['pname'];?></h2>
                <p class="copy"><?php echo $pd['description'];?></p>
                <a href='<?php echo "updateShop.php?pid=$pid";?>'>
                <button class="btn" >Update</button></a>
                <a href='<?php echo "deleteProduct.inc.php?pid=$pid";?>'>
                <button class="btn" >DELETE</button></a>
            </div>
        </div>
        
    <?php
        endforeach;
    ?>
        
        
        
    </main>
</div>
</body>
</html>