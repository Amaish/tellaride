<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/tappsRide/core.php';

if (isset($_POST['driverid']) AND isset($_POST['name']) AND isset($_POST['phone']) AND isset($_POST['regno']) AND isset($_POST['enginesize']) AND isset($_POST['location']) AND isset($_POST['status'])) {
	$driverid = mysqli_real_escape_string($conn, $_POST['driverid']);
	$name =  mysqli_real_escape_string($conn, $_POST['name']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$regno =  mysqli_real_escape_string($conn, $_POST['regno']);
	$enginesize = mysqli_real_escape_string($conn, $_POST['enginesize']);
	$location = mysqli_real_escape_string($conn, $_POST['location']);
	$status = mysqli_real_escape_string($conn, $_POST['status']);

	if (empty($name)) {
		die("Please enter driver's name");
	}

	if (!ctype_alpha($name)) {
		die("Please enter a valid name");
	}

	if (empty($phone)) {
		die("Please enter driver's phone number");
	}

	if ($phone[0] != '+') {
		die("Phone number should be in international format.");
	}

	if (empty($regno)) {
		die("Registration number cannot be empty.");
	}

	if (empty($enginesize)) {
		die("Engine size cannot be empty.");
	}
	if(!empty($location)){
		$locquery = mysqli_query($conn, "UPDATE `drivers` SET `location` = '$location' WHERE `id` = '$driverid'");

	}
	if (!empty($status)){
		$statquery = mysqli_query($conn, "UPDATE `drivers` SET `location` = '$status' WHERE `id` = '$driverid'");
	}
	$query = mysqli_query($conn, "UPDATE `drivers` SET `name` = '$name', `phonenumber` = '$phone', `regno` = '$regno', `engineSize` = '$enginesize' WHERE `id` = '$driverid'");

	if ($query) {
		echo "1";
	}
	else{
		echo "An error occurred while processing your request.";
	}
}

?>