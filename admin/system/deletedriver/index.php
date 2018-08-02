<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/tappsRide/core.php';

if (isset($_POST['driverid'])) {
	$driverid = mysqli_real_escape_string($conn, $_POST['driverid']);

	$query = mysqli_query($conn, "DELETE FROM `drivers` WHERE `id` = '$driverid'");

	if ($query) {
		die("1");
	}
	else{
		die("Oopps! An error occurred while processing your request.");
	}
}


?>