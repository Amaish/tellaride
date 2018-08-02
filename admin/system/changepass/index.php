<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/tappsRide/core.php';

if (isset($_POST['oldpass']) AND isset($_POST["newpass"]) AND isset($_POST['confirmpass'])) {
	$oldpass     = mysqli_real_escape_string($conn, $_POST['oldpass']);
	$newpass     = mysqli_real_escape_string($conn, $_POST['newpass']);
	$confirmpass = mysqli_real_escape_string($conn, $_POST['confirmpass']);

	$enc_oldpass = sha1($oldpass);

	$fetch_args = array('phonenumber'=>$_SESSION['loggedadmin']);

	if (empty($oldpass)) {
		die("<font class='text-warning'>Please enter your old password</font>");
	}

	if ($enc_oldpass != getByValue('admin', 'password', $fetch_args)) {
		die("<font class='text-warning'>Current password is incorrect.</font>");
	}

	if (strlen($newpass) < 6) {
		die("<font class='text-warning'>New password must be at least 6 characters.</font>");
	}

	if ($newpass != $confirmpass) {
		die("<font class='text-warning'>New passwords do not match</font>");
	}

	$enc_newpass = sha1($newpass);

	$query = mysqli_query($conn, "UPDATE `admin` SET `password` = '$enc_newpass' WHERE `phonenumber` = '{$_SESSION['loggedadmin']}'");

	if ($query) {
		echo "<font class='text-success'>Password changed successfully</font>";
	}
}

?>