<?php
if(!empty($_POST)){
    require_once('dbConnector.php');
    require_once('functions.php');
    $sessionId     =$_POST['sessionId'];
    $serviceCode   =$_POST['serviceCode'];
    $phoneNumber   =$_POST['phoneNumber'];
    $text          =$_POST['text'];

    $textArray     = explode('*', $text);
    $userResponse  = trim(END($textArray));
    $date          = date('d/m/Y');
    $dbFetch       = array('phonenumber'=>$phoneNumber);
    //check if the pnone number is registered as an admin
    if(returnExists('admin', $dbFetch) > 0){
        //fetch admin level
        if(returnExists('session_levels', $dbFetch) > 0){
            $level      = getByValue('session_levels','level',$dbFetch);
        }
        else{
            $level      = 0;
        }
        switch ($level) {
            case 0:
            if($userResponse==""){
                $sqlLev1 = "UPDATE `session_levels` SET `level` = '1' WHERE `phonenumber` = '$phoneNumber'";
                $conn->query($sqlLev1);
                $response = AdminWelcomeScreen();
            }
            else{
                $response = "END Ooops Invalid entry\n";
            }
            break;
            case 1:
            if($userResponse=="1" || $userResponse==""){
                $sqlLev2 = "UPDATE `session_levels` SET `level` = '2' WHERE `phonenumber` = '$phoneNumber'";
                $conn->query($sqlLev2);
                $response = AddDriverNumber();             
            }
            else if ($userResponse=="2"){
                $sqlLev4 = "UPDATE `session_levels` SET `level` = '4' WHERE `phonenumber` = '$phoneNumber'";
                $conn->query($sqlLev4);
                $response = deleteDriverMenu();
            }
            else{
                $response = "END Something went wrong\n";
            }
            break;
            case 2:
            $querydrv = array('phonenumber'=>$userResponse);
            if(returnExists('drivers', $querydrv) > 0){
                $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
                $conn->query($sqlLev0);
                $response = "END driver exisits";
            }
            else{
                $sqlLev3 = "UPDATE `session_levels` SET `level` = '3' WHERE `phonenumber` = '$phoneNumber'";
                $conn->query($sqlLev3);
                $sqldrvnumber = "INSERT INTO `drivers` (`phonenumber`,`session_id`) VALUES ('$userResponse','$sessionId')";
                $conn->query($sqldrvnumber);
                $response = AddDriverName();
            }
            break;
            case 3:
            $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
            $conn->query($sqlLev0);
            $sqldrvname = "UPDATE `drivers` SET `name` = '$userResponse'WHERE `session_id` = '$sessionId'";
            $conn->query($sqldrvname);
            $response = "END Add success";
            break;
            case 4:
            $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
            $conn->query($sqlLev0);
            $sqldeldrv = "DELETE FROM `drivers` WHERE `phonenumber` = '$userResponse'";
            $conn->query($sqldeldrv);
            $response = "END Delete success";
            break;
            default:
            $response = "END Oops, something isn't right... \n";
            break;
        }
    }
    else if (returnExists('drivers', $dbFetch) > 0){
        if(returnExists('session_levels', $dbFetch) > 0){
            $level      = getByValue('session_levels','level',$dbFetch);
        }
        else{
            $level      = 0;
        }
        switch ($level) {
            case 0:
            $response;
            break;
            default:
            $response = "END Oops, something isn't right... \n";
            break;
        }
    }
    
    else{
        $response = riderWelcomeScreen();
    }

    header('Content-type: text/plain');
    echo $response;
}
?>