<?php 

include '../config.php';

error_reporting(0);

session_start();

if (!isset($_SESSION['aid'])) {
	header("Location: index.php?log=1");
}

if (isset($_POST['submit'])) {
	$aid = $_SESSION['aid'];
	$checkbox1=$_POST['category'];  
	$count=0; 
	
	foreach($checkbox1 as $chk1)  
	{  
		$sql = "INSERT INTO admincategoryrelation(adminid, categoryid) values($aid, $chk1)";
		$result = mysqli_query($conn, $sql);
		$count++;
	}  
	if($count>0){
		echo "<script>alert('Wow! Done dona done.')</script>";
	}else{
		echo "<script>alert('Not Wow! loooooooooo.')</script>";
	}
	 
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Your Kart</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Choose the Products Category sold by you</p>
			<?php 
				$sql = "SELECT * FROM category";
				$result = mysqli_query($conn, $sql);
				$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
			?>
			<?php foreach ($categories as $category):  ?>
				<div class="category">			
					<input type="checkbox"  name="category[]" value="<?php echo $category['categoryid']; ?>" >
					<label ><?php echo $category['categoryname'];?></label>
				</div>
			<?php endforeach; ?>
			<div class="input-group">
				<button name="submit" class="btn">Submit</button>
			</div>

		</form>
	</div>
</body>
</html>