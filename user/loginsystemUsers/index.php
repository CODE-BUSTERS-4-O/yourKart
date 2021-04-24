<?php


include '../../config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['uid'])) {
    header("Location: ../home/index.php");
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['uid'] = $row["userid"];
		$_SESSION['fullname'] = $row['fullname'];
		$uid = $row['userid'];
		$sqlcheck = "SELECT * FROM cart WHERE userid = '$uid'";
		$check = mysqli_query($conn,$sqlcheck);

		if($check->num_rows <= 0){
			// $Sql1 = "SELECT * FROM users WHERE email=$email";
			// $result = mysqli_query($conn, $sql1);
			// $user = mysqli_fetch_assoc($result);
			// $uid = $user['userid'];
			$sql2 = "INSERT INTO cart(userid, quantity, totalcost) VALUES($uid, 0,0)";
			$result = mysqli_query($conn, $sql2);
			if($result){
				echo "<script>alert('done')</script>";
			}else{
				echo "<script>alert('not ')</script>";
			}

			
		}

		$sqlcheck = "SELECT * FROM wishlist WHERE userid = '$uid'";
		$check = mysqli_query($conn,$sqlcheck);

		if($check->num_rows <= 0){
			// $Sql1 = "SELECT * FROM users WHERE email=$email";
			// $result = mysqli_query($conn, $sql1);
			// $user = mysqli_fetch_assoc($result);
			// $uid = $user['userid'];
			$sql2 = "INSERT INTO wishlist(userid, quantity) VALUES($uid, 0)";
			$result = mysqli_query($conn, $sql2);
			if($result){
				echo "<script>alert('done')</script>";
			}else{
				echo "<script>alert('not ')</script>";
			}

			
		}
		
		
		header("Location: ../../");
	} else {
		echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
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

	<title>Login</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Login</button>
			</div>
			<p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
		</form>
	</div>
</body>
</html>