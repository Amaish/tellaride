<?php
//theUssdDb.php
//Connection Credentials
$servername = "127.0.0.1";
$username = "root";
$password = "Tell@ride1395";
//$password = "";
$database = "tappsRide";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
        header('Content-type: text/plain');
        //log error to file/db $e-getMessage()
        die("END An error was encountered. Please try again later");
    }
	//echo " END Connected successfully (".$conn->host_info.")";
    ?>
