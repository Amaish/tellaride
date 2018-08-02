<?php

session_start();
include_once($_SERVER["DOCUMENT_ROOT"] . '/tappsRide/core.php');

if(!isset($_SESSION['loggedadmin'])){
    header('location:login.php');
}

else{
    echo "here we are";
}

?>