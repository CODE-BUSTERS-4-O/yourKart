<?php 

include '../../../config.php';

    session_start();

    error_reporting(0);

    if(!isset($_SESSION['uid'])){
        header("Location : ../loginsystemUsers/index.php");
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="shippingInfoadd.css">

    <title>Document</title>
</head>
<body>
	<div class="container">
		<form action="shippinginfo.inc.php" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Shipping Information</p>
			<div class="input-group">
				<input type="text" placeholder="Full Name" name="fullname"required>
			</div>
			<div class="input-group">
				<input type="text" placeholder="Address" name="address" required>
			</div>
			<div class="input-group">
				<input type="number" placeholder="Contact" name="contact" required>
			</div>
			<div class="input-group">
				<input type="number" placeholder="Pin Code" name="pincode" min="100000" max="999999" required>
			</div>
			
			<div class="input-group">
				<button name="submit" class="btn">ADD</button>
			</div>
		</form>
	</div>
</body>
</html>