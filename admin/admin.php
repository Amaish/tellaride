<?php

session_start();

if(!isset($_SESSION['loggedadmin'])){
    header('location:login.php');
}

else{
    echo "here we are";
}

?>