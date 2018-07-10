<?php
if(!empty($_POST)){
    require_once('dbConnector.php');
    require_once('functions.php');
    $sessionId    =$_POST['sessionId'];
    $serviceCode  =$_POST['serviceCode'];
    $phoneNumber  =$_POST['phoneNumber'];
    $text         =$_POST['text'];

    $textArray = explode('*', $text);
    $userResponse = trim(END($textArray));
    $date           = date('d/m/Y');
    $dbFetch = array('phonenumber'=>$phoneNumber);
    // if (sizeof($textArray==2)){
    //     $drivernum=$userResponse;
    //     echo "END $drivernum\n";
    // }
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
            $sqlLev1 = "UPDATE `session_levels` SET `level` = '1' WHERE `phonenumber` = '$phoneNumber'";
            $conn->query($sqlLev1);
            if($userResponse==""){
            $response = AdminWelcomeScreen();
            }
            else{
                $response = "END Ooops Invalid entry\n";
            }
            break;
            case 1:
            $sqlLev2 = "UPDATE `session_levels` SET `level` = '2' WHERE `phonenumber` = '$phoneNumber'";
            $conn->query($sqlLev2);
            if($userResponse=="1"){
                $response = AddDriverNumber();             
            }
            break;
            case 2:
            $sqlLev3 = "UPDATE `session_levels` SET `level` = '3' WHERE `phonenumber` = '$phoneNumber'";
            $conn->query($sqlLev3);
            $sqldrvnumber = "INSERT INTO `drivers` (`phonenumber`) VALUES ('$userResponse')";
            $conn->query($sqldrvnumber);
            $response = AddDriverName();
            break;
            case 3:
            $sqlLev0 = "UPDATE `session_levels` SET `level` = '0' WHERE `phonenumber` = '$phoneNumber'";
            $conn->query($sqlLev0);
            $sqldrvname = "UPDATE `drivers` SET `name` = '$userResponse'WHERE `phonenumber` = '$drivernum'";
            $conn->query($sqldrvname);
            $response = "END success";
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