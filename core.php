<?php

session_start();
include_once($_SERVER["DOCUMENT_ROOT"] . '/tappsRide/loader.php');

if(!isset($_SESSION['loggedadmin'])){
    header('location:login.php');
}


$fetch_array = array('phonenumber' => $_SESSION['loggedadmin']);


$adminId          = getByValue('admin', 'id', $fetch_array);
$adminName        = getByValue('admin', 'name', $fetch_array);
$adminPhone       = getByValue('admin', 'phonenumber', $fetch_array);

?>