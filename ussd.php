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
    $count        = getByValue('session_levels', 'count', $dbFetch);
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
                if ($count == 0) {
                    if (empty($userResponse)) {
                        $response = AdminWelcomeScreen();
                        $sqlLev0  = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                        $conn->query($sqlLev0);
                        $sqlcount1 = "UPDATE `session_levels` SET `count` = '1' WHERE `phonenumber` = '$phoneNumber'";
                        $conn->query($sqlcount1);
                    }
                } else if ($count == 1 && !empty($userResponse)) {
                    $sqlLev1 = "UPDATE `session_levels` SET `level` = '1' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev1);
                    $sqlcount0 = "UPDATE `session_levels` SET `count` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlcount0);
                    goto lvl_1;
                } else {
                    $response = "END Did not choose an option\nPlease try again";
                    $sqlLev0  = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                    $sqlcount0 = "UPDATE `session_levels` SET `count` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlcount0);
                }
                break;
            case 1:
lvl_1:
                if ($userResponse == "1") {
                    if (empty($userResponse)) {
                        $response = AddDriverNumber();
                    } else {
                        $response = AddDriverNumber();
                        $sqlLev2  = "UPDATE `session_levels` SET `level` = '2' WHERE `phonenumber` = '$phoneNumber'";
                        $conn->query($sqlLev2);
                    }
                } else if ($userResponse == "2") {
                    if (empty($userResponse)) {
                        $response = deleteDriverMenu();
                    } else {
                        $response = deleteDriverMenu();
                        $sqlLev4  = "UPDATE `session_levels` SET `level` = '4' WHERE `phonenumber` = '$phoneNumber'";
                        $conn->query($sqlLev4);
                    }
                } else if ($userResponse == "3") {
                    if (empty($userResponse)) {
                        $response = AdminPasswordScreen();
                    } else {
                        $response = AdminPasswordScreen();
                        $sqlLev5  = "UPDATE `session_levels` SET `level` = '5' WHERE `phonenumber` = '$phoneNumber'";
                        $conn->query($sqlLev5);
                    }
                } else if ($userResponse == "4") {
                    $response = exitUssd();
                    $sqlLev0  = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                } else {
                    $response = "END Something went wrong\n Please try again";
                    $sqlLev0  = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                }
                break;
            case 2:
                $formated_phone = "+254" . substr($userResponse, -9);
                $querydrv       = array(
                    'phonenumber' => $formated_phone
                );
                if (empty($userResponse)) {
                    $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                    $response = "END Invalid entry";
                } else {
                    if (returnExists('drivers', $querydrv) > 0) {
                        $response = "END driver exisits";
                        $sqlLev0  = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                        $conn->query($sqlLev0);
                    } else {
                        $sqldrvnumber = "INSERT INTO `drivers` (`phonenumber`,`session_id`) VALUES ('$formated_phone','$sessionId')";
                        $conn->query($sqldrvnumber);
                        $response = AddDriverName();
                        $sqlLev3  = "UPDATE `session_levels` SET `level` = '3' WHERE `phonenumber` = '$phoneNumber'";
                        $conn->query($sqlLev3);
                    }
                }
                break;
            case 3:
                if (empty($userResponse)) {
                    $response = "END Invalid entry";
                    $sqlLev0  = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                } else {
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
                }
                break;
            case 4:
                $formated_phone = "+254" . substr($userResponse, -9);
                $drvdel         = array(
                    'phonenumber' => $formated_phone
                );
                $drvNum         = getByValue('drivers', 'phonenumber', $drvdel);
                $drvName        = getByValue('drivers', 'name', $drvdel);
                $adminMsg       = "You have successfully deleted a driver\n Name: $drvName\n Tel: $drvNum";
                $drvMsg         = "You have been Deleted from Tapps Ride as a driver";
                if (empty($userResponse)) {
                    $response = "END Invalid entry";
                    $sqlLev0  = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                } else {
                    $sqldeldrv = "DELETE FROM `drivers` WHERE `phonenumber` = '$formated_phone'";
                    $conn->query($sqldeldrv);
                    $response = "END Delete success";
                    sendMessage($phoneNumber, $adminMsg);
                    sendMessage($drvNum, $drvMsg);
                    $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                }
                break;
            case 5:
                if (empty($userResponse)) {
                    $response = "END Invalid entry";
                    $sqlLev0  = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                } else {
                    $password    = sha1($userResponse);
                    $sqlpassword = "UPDATE `admin` SET `password` = '$password'WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlpassword);
                    $response = AdminNameScreen();
                    $sqlLev6  = "UPDATE `session_levels` SET `level` = '6' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev6);
                }
                break;
            case 6:
                if (empty($userResponse)) {
                    $response = "END Invalid entry";
                    $sqlLev0  = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                } else {
                    $sqlname = "UPDATE `admin` SET `name` = '$userResponse'WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlname);
                    $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                    $response = "END Good-bye\n";
                }
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
                $drvName = getByValue('drivers', 'name', $dbFetch);
                if ($count == 0) {
                    if (empty($userResponse)) {
                        $response = driverWelcomeScreen($drvName, 'drivers', 'status', $dbFetch);
                        $sqlLev0  = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                        $conn->query($sqlLev0);
                        $sqlcount1 = "UPDATE `session_levels` SET `count` = '1' WHERE `phonenumber` = '$phoneNumber'";
                        $conn->query($sqlcount1);
                    }
                } else if ($count == 1 && !empty($userResponse)) {
                    $sqlLev1 = "UPDATE `session_levels` SET `level` = '1' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev1);
                    $sqlcount0 = "UPDATE `session_levels` SET `count` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlcount0);
                    goto drvlvl_1;
                } else {
                    $response = "END Did not choose an option\nPlease try again";
                    $sqlLev0  = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                    $sqlcount0 = "UPDATE `session_levels` SET `count` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlcount0);
                }
                break;
            case 1: //work on case 1 onwards to make sure it never repeats and post empty things to the DB
drvlvl_1:
                if ($userResponse == "1") {
                    if (empty($userResponse)) {
                        $response = driverEditLocation();
                    } else {
                        $response = driverEditLocation();
                        $sqlLev2  = "UPDATE `session_levels` SET `level` = '2' WHERE `phonenumber` = '$phoneNumber'";
                        $conn->query($sqlLev2);
                    }
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
                    if (empty($userResponse)) {
                        $response = driverEditStatus();
                    } else {
                        $sqlLev3 = "UPDATE `session_levels` SET `level` = '3' WHERE `phonenumber` = '$phoneNumber'";
                        $conn->query($sqlLev3);
                        $response = driverEditStatus();
                    }
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
                if (empty($userResponse)) {
                    $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                    $response = "END Invalid entry";
                } else {
                    $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                    $sqlLoc = "UPDATE `drivers` SET `location` = '$userResponse' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLoc);
                    $response = "END Your location has been edited\n";
                    $response .= "Your new location is $userResponse";
                }
                break;
            case 3:
                if (empty($userResponse)) {
                    $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                    $response = "END Invalid entry";
                } else {
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
                if ($count == 0) {
                    if (empty($userResponse)) {
                        $response = riderWelcomeScreen();
                        $sqlLev0  = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                        $conn->query($sqlLev0);
                        $sqlcount1 = "UPDATE `session_levels` SET `count` = '1' WHERE `phonenumber` = '$phoneNumber'";
                        $conn->query($sqlcount1);
                    }
                } else if ($count == 1 && !empty($userResponse)) {
                    $sqlLev1 = "UPDATE `session_levels` SET `level` = '1' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev1);
                    $sqlcount0 = "UPDATE `session_levels` SET `count` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlcount0);
                    goto riderlvl_1;
                } else {
                    $response = "END Did not choose an option\nPlease try again";
                    $sqlLev0  = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                    $sqlcount0 = "UPDATE `session_levels` SET `count` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlcount0);
                }
                break;
            case 1:
riderlvl_1:
                if ($userResponse == "1") {
                    if (empty($userResponse)) {
                        $response = riderLocationScreen();
                    } else {
                        $sqlLev2 = "UPDATE `session_levels` SET `level` = '2' WHERE `phonenumber` = '$phoneNumber'";
                        $conn->query($sqlLev2);
                        $response = riderLocationScreen();
                    }
                } else if ($userResponse == "2") {
                    if (empty($userResponse)) {
                        $response = exitUssd();
                    } else {
                        $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                        $conn->query($sqlLev0);
                        $response = exitUssd();
                    }
                } else {
                    $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                    $response = "END Error occured try again.";
                }
                break;
            case 2:
                if (empty($userResponse)) {
                    $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                    $response = "END Error occured try again";
                } else {
                    $sqlLev3 = "UPDATE `session_levels` SET `level` = '3' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev3);
                    $sqlstartsession = "INSERT INTO `riders` (`session_id`,`start`) VALUES ('$sessionId','$userResponse')";
                    $conn->query($sqlstartsession);
                    $response = riderDestinationScreen();
                }
                break;
            case 3:
                if (empty($userResponse)) {
                    $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                    $response = "END Error occured try again";
                } else {
                    $sqlLev4 = "UPDATE `session_levels` SET `level` = '4' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev4);
                    $sqlstop = "UPDATE `riders` SET `destination` = '$userResponse' WHERE `session_id`='$sessionId'";
                    $conn->query($sqlstop);
                    $args            = array(
                        'status' => '0'
                    );
                    $dbargs            = array(
                        'session_id' => $sessionId
                    );
                    $start           = getByValue('riders', 'start', $dbargs);
                    $destination     = getByValue('riders', 'destination', $dbargs);
                if(getManyByValue('drivers','location',$args)==0){
                        $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                        $conn->query($sqlLev0);
                        $response = "END No registered drivers";
                        }
                    $driverLocations = getManyByValue('drivers', 'location', $args);
                    $driverDetails   = closestDriver($start, $driverLocations);
                    $driveDistance   = Drivedistance($start, $destination);
                    $distance        = $driverDetails[0];
                    $location        = $driverDetails[1];
                    $phone           = $driverDetails[2];
                    $duration        = duration($start, $destination);
                    $drivedistance   = $driveDistance;
                    $drvNameFetch    = array(
                        'phonenumber' => $phone
                    );
                    $drivername      = getByValue('drivers', 'name', $drvNameFetch);
                    $drvCheck        = array(
                        'drivernumber' => $phone
                    );
                    $sqlupdate = "UPDATE `riders` SET `drivername` = '$drivername',`location`= '$location',`distance`='$distance',`drivernumber`='$phone',`drivelength`='$drivedistance',`duration`='$duration' WHERE `session_id`='$sessionId'";
                    $conn->query($sqlupdate);
                    $response = closestDriverDetails($distance, $location, $phone, $duration, $drivedistance);
                 }
                break;
            case 4;
                if (empty($userResponse)) {
                    $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                    $conn->query($sqlLev0);
                    $response = "END Invalid entry";
                } else {
                    if ($userResponse == "1") {
                        $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                        $conn->query($sqlLev0);
                        $distance   = getByValue('riders', 'distance', $drvFetch);
                        $location   = getByValue('riders', 'location', $drvFetch);
                        $drivername = getByValue('riders', 'drivername', $drvFetch);
                        $phone      = getByValue('riders', 'drivernumber', $drvFetch);
                        $travelDistance = getByValue('riders', 'drivelength', $drvFetch);
                        $driveDuration = getByValue('riders', 'duration', $drvFetch);
                        $sqlrequest = "UPDATE `drivers` SET `status` = '3' WHERE `phonenumber` = '$phone'";
                        $conn->query($sqlrequest);
                        $drvMessage = "You have been requested for a ride kindly contact the passenger through the number $phoneNumber";
                        sendMessage($phone, $drvMessage);
                        $drvNameFetch = array(
                            'phonenumber' => $phone
                        );
                        $trip         = getByValue('drivers', 'trips', $drvNameFetch);
                        $newtrip      = $trip + 1;
                        $sqltrip      = "UPDATE `drivers` SET `trips` = '$newtrip' WHERE `phonenumber` = '$phone'";
                        $conn->query($sqltrip);
                        $message = "Driver has been notified\nDriver name: $drivername\nLocation: $location\nPhone Number: $phone\nTrip length: $travelDistance\nTrip duration: $driveDuration\n$drivername will contact you shortly.";
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
