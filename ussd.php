<?php
if (!empty($_POST)) {
    require_once('dbConnector.php');
    require_once('functions.php');
    $sessionId   = $_POST['sessionId'];
    $serviceCode = $_POST['serviceCode'];
    $phoneNumber = $_POST['phoneNumber'];
    $text        = $_POST['text'];
    
    $textArray    = explode('*', $text);
    $userResponse = trim(END($textArray));
    $date         = date('d/m/Y');
    $dbFetch      = array(
        'phonenumber' => $phoneNumber
    );
    $drvFetch     = array(
        'session_id' => $sessionId
    );
    //check if the pnone number is registered as an admin
    if (returnExists('admin', $dbFetch) > 0) {
        //fetch admin level
        if (returnExists('session_levels', $dbFetch) > 0) {
            $level = getByValue('session_levels', 'level', $dbFetch);
        } else {
            $sqldrvLevelset = "INSERT INTO `session_levels` (`phonenumber`,`session_id`,`level`) VALUES ('$phoneNumber','$sessionId','0')";
            $conn->query($sqldrvLevelset);
            $level = 0;
        }
        switch ($level) {
            case 0:
                $response = AdminWelcomeScreen($phoneNumber);        
                break;
            case 1:
                if ($userResponse == "1" || $userResponse == "") {
                    $response = AddDriverNumber();
                    if(!empty($userResponse)){
                        $sqlLev2  = "UPDATE `session_levels` SET `level` = '2' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev2);
                    }else{
                        $response = AddDriverNumber();
                    }
                } else if ($userResponse == "2") {
                    $response = deleteDriverMenu();
                    if(!empty($userResponse)){
                        $sqlLev4  = "UPDATE `session_levels` SET `level` = '4' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev4);
                    }else{
                        $response = deleteDriverMenu();
                    }
                } else if ($userResponse == "3") {
                    $response = AdminPasswordScreen();
                    if(!empty($userResponse)){
                        $sqlLev5  = "UPDATE `session_levels` SET `level` = '5' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev5);
                    }else{
                        $response = AdminPasswordScreen();
                    }
                } else if ($userResponse == "4") {
                    $response = exitUssd();
                    $sqlLev0  = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                } else {
                    $response = "END Something went wrong\n";
                    $sqlLev0  = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                }
                break;
            case 2:
                $formated_phone = "+254" . substr($userResponse, -9);
                $querydrv       = array(
                    'phonenumber' => $formated_phone
                );
                if (returnExists('drivers', $querydrv) > 0) {
                    $response = "END driver exisits";
                    $sqlLev0  = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                } else {
                    $sqldrvnumber = "INSERT INTO `drivers` (`phonenumber`,`session_id`) VALUES ('$formated_phone','$sessionId')";
                    $conn->query($sqldrvnumber);
                    $response = AddDriverName();
                    if(!empty($userResponse)){
                        $sqlLev3  = "UPDATE `session_levels` SET `level` = '3' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev3);
                    }else{
                        $response = AddDriverName();
                    }                    
                }
                break;
            case 3:
                $sqldrvname = "UPDATE `drivers` SET `name` = '$userResponse'WHERE `session_id` = '$sessionId'";
                $conn->query($sqldrvname);
                $drvNum   = getByValue('drivers', 'phonenumber', $drvFetch);
                $drvName  = getByValue('drivers', 'name', $drvFetch);
                $drvId    = getByValue('drivers', 'id', $drvFetch);
                $adminMsg = "You have successfully added a driver\n Name: $drvName\n Tel: $drvNum\n Ref ID: $drvId";
                $drvMsg   = "You have been added to Tapps Ride as a driver Ref ID: $drvId\n Kindly dial *384*1404# to update your locarion\n";
                sendMessage($phoneNumber, $adminMsg);
                sendMessage($drvNum, $drvMsg);
                $response = "END Add success";
                $sqlLev0  = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                $conn->query($sqlLev0);
                break;
            case 4:
                $formated_phone = "+254" . substr($userResponse, -9);
                $drvdel         = array(
                    'phonenumber' => $formated_phone
                );
                $drvNum         = getByValue('drivers', 'phonenumber', $drvdel);
                $drvName        = getByValue('drivers', 'name', $drvdel);
                $sqldeldrv      = "DELETE FROM `drivers` WHERE `phonenumber` = '$formated_phone'";
                $conn->query($sqldeldrv);
                $adminMsg = "You have successfully deleted a driver\n Name: $drvName\n Tel: $drvNum";
                $drvMsg   = "You have been Deleted from Tapps Ride as a driver";
                sendMessage($phoneNumber, $adminMsg);
                sendMessage($drvNum, $drvMsg);
                $response = "END Delete success";
                $sqlLev0  = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                $conn->query($sqlLev0);
                break;
            case 5:
                $password    = sha1($userResponse);
                $sqlpassword = "UPDATE `admin` SET `password` = '$password'WHERE `phonenumber` = '$phoneNumber'";
                $conn->query($sqlpassword);
                $response = AdminNameScreen();
                if(!empty($userResponse)){
                    $sqlLev6  = "UPDATE `session_levels` SET `level` = '6' WHERE `phonenumber` = '$phoneNumber'";
                $conn->query($sqlLev6);
                }else{
                    $response = AdminNameScreen();
                }      
                break;
            case 6:
                $sqlname = "UPDATE `admin` SET `name` = '$userResponse'WHERE `phonenumber` = '$phoneNumber'";
                $conn->query($sqlname);
                $sqlLev0  = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                $conn->query($sqlLev0);
                $response = "END Good-bye\n";
                break;
            default:
                $response = "END Oops, something isn't right... \n";
                $sqlLev0  = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                $conn->query($sqlLev0);
                break;
        }
    }
    //check if it is a driver
    else if (returnExists('drivers', $dbFetch) > 0) {
        if (returnExists('session_levels', $dbFetch) > 0) {
            $level = getByValue('session_levels', 'level', $dbFetch);
        } else {
            $sqldrvLevelset = "INSERT INTO `session_levels` (`phonenumber`,`session_id`,`level`) VALUES ('$phoneNumber','$sessionId','0')";
            $conn->query($sqldrvLevelset);
            $level = 0;
        }
        switch ($level) {
            case 0:
                $sqlLev1 = "UPDATE `session_levels` SET `level` = '1' WHERE `phonenumber` = '$phoneNumber'";
                $conn->query($sqlLev1);
                $drvName  = getByValue('drivers', 'name', $dbFetch);
                $response = driverWelcomeScreen($drvName,'drivers','status',$dbFetch);
                break;
            case 1:
                if ($userResponse == "1") {
                    $sqlLev2 = "UPDATE `session_levels` SET `level` = '2' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev2);
                    $response = driverEditLocation();
                } else if ($userResponse == "2") {
                    $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                    $tripstatus = getByValue('drivers', 'status', $dbFetch);
                    if ($tripstatus == "0") {
                        $sqlstart = "UPDATE `drivers` SET `status` = '1' WHERE `phonenumber` = '$phoneNumber'";
                        $conn->query($sqlstart);
                        $response = "END trip has started";
                    } else {
                        $response = "END You are already on another trip";
                    }
                } else if ($userResponse == "3") {
                    $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                    $tripstatus = getByValue('drivers', 'status', $dbFetch);
                    if ($tripstatus == "0") {
                        $response = "END You have no active trip";
                    } else {
                        $sqlstop = "UPDATE `drivers` SET `status` = '0' WHERE `phonenumber` = '$phoneNumber'";
                        $conn->query($sqlstop);
                        $response = "END Your trip has ended";
                    }
                } else if ($userResponse == "4") {
                    $sqlLev3 = "UPDATE `session_levels` SET `level` = '3' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev3);
                    $response = driverEditStatus();
                } else if ($userResponse == "5") {
                    $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                    $location = getByValue('drivers', 'location', $dbFetch);
                    $response = "END Your current location is $location";
                } else if ($userResponse == "6") {
                    $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                    $response = exitUssd();
                } else {
                    $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                    $response = "END Invalid entry try again.";
                }
                break;
            case 2:
                $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                $conn->query($sqlLev0);
                $sqlLoc = "UPDATE `drivers` SET `location` = '$userResponse' WHERE `phonenumber` = '$phoneNumber'";
                $conn->query($sqlLoc);
                $response = "END Your location has been edited\n";
                $response .= "Your new location is $userResponse";
                break;
            case 3:
                $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                $conn->query($sqlLev0);
                if ($userResponse == "1") {
                    $sqlstatus1 = "UPDATE `drivers` SET `status` = '1' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlstatus1);
                    $response = "END You are now offline";
                } else if ($userResponse == "2") {
                    $sqlstatus0 = "UPDATE `drivers` SET `status` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlstatus0);
                    $response = "END You are now online";
                }
                break;
            default:
                $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                $conn->query($sqlLev0);
                $response = "END Oops, something isn't right try again... \n";
                break;
        }
    }
    //else it is a rider
    else {
        if (returnExists('session_levels', $dbFetch) > 0) {
            $level = getByValue('session_levels', 'level', $dbFetch);
        } else {
            $sqldrvLevelset = "INSERT INTO `session_levels` (`phonenumber`,`session_id`,`level`) VALUES ('$phoneNumber','$sessionId','0')";
            $conn->query($sqldrvLevelset);
            $level = 0;
        }
        switch ($level) {
            case 0:
                $sqlLev1 = "UPDATE `session_levels` SET `level` = '1' WHERE `phonenumber` = '$phoneNumber'";
                $conn->query($sqlLev1);
                $response = riderWelcomeScreen();
                break;
            case 1:
                if ($userResponse == "1") {
                    $sqlLev2 = "UPDATE `session_levels` SET `level` = '2' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev2);
                    $response = riderLocationScreen();
                } else if ($userResponse == "2") {
                    $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                    $response = exitUssd();
                } else {
                    $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                    $response = "END Invalid entry try again.";
                }
                break;
            case 2:
                $sqlLev3 = "UPDATE `session_levels` SET `level` = '3' WHERE `phonenumber` = '$phoneNumber'";
                $conn->query($sqlLev3);
                $args            = array(
                    'status' => '0'
                );
                $driverLocations = getManyByValue('drivers', 'location', $args);
                $driverDetails   = closestDriver($userResponse, $driverLocations);
                $distance        = $driverDetails[0];
                $location        = $driverDetails[1];
                $phone           = $driverDetails[2];
                $drvNameFetch    = array(
                    'phonenumber' => $phone
                );
                $drivername      = getByValue('drivers', 'name', $drvNameFetch);
                $drvCheck        = array(
                    'drivernumber' => $phone
                );
                if (returnExists('riders', $drvCheck) == 0) {
                    $sqldrvLevelset = "INSERT INTO `riders` (`session_id`,`drivernumber`,`drivername`,`location`,`distance`) VALUES ('$sessionId','$phone','$drivername','$location','$distance')";
                    $conn->query($sqldrvLevelset);
                } else {
                    $sqlupdate = "UPDATE `riders` SET `session_id`='$sessionId',`drivername` = '$drivername',`location`= '$location',`distance`='$distance' WHERE `drivernumber`='$phone'";
                    $conn->query($sqlupdate);
                }
                $response = closestDriverDetails($distance, $location, $phone);
                break;
            case 3;
                if ($userResponse == "1") {
                    $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                    $distance   = getByValue('riders', 'distance', $drvFetch);
                    $location   = getByValue('riders', 'location', $drvFetch);
                    $drivername = getByValue('riders', 'drivername', $drvFetch);
                    $phone      = getByValue('riders', 'drivernumber', $drvFetch);
                    $drvMessage = "You have been requested for a ride kindly contact the passenger through the number $phoneNumber";
                    sendMessage($phone, $drvMessage);
                    $drvNameFetch = array(
                        'phonenumber' => $phone
                    );
                    $trip         = getByValue('drivers', 'trips', $drvNameFetch);
                    $newtrip      = $trip + 1;
                    $sqltrip      = "UPDATE `drivers` SET `trips` = '$newtrip' WHERE `phonenumber` = '$phone'";
                    $conn->query($sqltrip);
                    $message = "Driver has been notified\n Driver name $drivername\n Location $location\n Phone Number $phone\n Distance $distance\n $drivername will contact you shortly.";
                    sendMessage($phoneNumber, $message);
                    $response = checkMessages();
                } else if ($userResponse == "2") {
                    $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                    $response = exitUssd();
                } else {
                    $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                    $response = "END Invalid entry try again.";
                }
                break;
            default:
                $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                $conn->query($sqlLev0);
                $response = "END Something isn't right try again.";
                break;
        }
    }
    
    header('Content-type: text/plain');
    echo $response;
}
?>