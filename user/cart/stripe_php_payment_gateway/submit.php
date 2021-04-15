<?php
	session_start();
	$payId = $_GET["id"];
	$totalPay = $payId*100;
	$adid = $_GET['adid'];
	
?>

<?php
require('config.php');
if(isset($_POST['stripeToken'])){
	\Stripe\Stripe::setVerifySslCerts(false);

	$token=$_POST['stripeToken'];

	$data=\Stripe\Charge::create(array(
		"amount"=>$totalPay,
		"currency"=>"inr",
		"description"=>"Plan Booking",
		"source"=>$token,
	));

	header("Location: ../paymentin.php?adid=$adid&tc=$payId");
	// echo "payment success";
	
}
?>