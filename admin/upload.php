<?php

/**
 * 2017 Ionsolve Limited
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 *  @author    Ionsolve Limited.
 *  @copyright 2017 Ionsolve Limited.
 *  @license   http://www.apache.org/licenses/LICENSE-2.0
 */

include_once($_SERVER["DOCUMENT_ROOT"] . '/tappsRide/core.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php
echo $adminName;
?> - Contacts</title>
    <meta content="Tappsride" name="description">
    <meta content="width=device-width,initial-scale=1,maximum-scale=1,minimal-ui" name="viewport">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="yes" name="">
    <meta content="black-translucent" name="">
    <meta content="Tappsride" name="">
    <meta content="yes" name="">
    <link href="css/animate.css/animate.min.css" rel="stylesheet" type="text/css">
    <link href="css/glyphicons/glyphicons.css" rel="stylesheet" type="text/css">
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/material-design-icons/material-design-icons.css" rel="stylesheet" type="text/css">
    <link href="css/ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css">
    <link href="css/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
    <link href="css/nice.css" rel="stylesheet" type="text/css">
    <link href="css/taggle.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/styles/app.min.css" rel="stylesheet">
    <link href="css/styles/font.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <style type="text/css">
        ::-webkit-scrollbar { 
        display: none; 
    }
    menu, ol, ul {
        padding: 0px 0px 0px 4px;
    }
    </style>
    
    
</head>
<body>

<div class="app" id="app">
        <div class="app-content box-shadow-z2 pjax-container" id="content" role="main">
            <div class="app-body">
                <div class="app-body-inner">
                    <div class="row-col">
                        <?php
include_once 'top.php';
?>
                       <div class="row-row">
                            <div class="row-col">
                                <?php
include_once 'side.php';
?>
                               <div class="col-xs col-md-9" id="detail">
                                    <p class="text-md text-primary" style="margin-left: 5px;">
                                        Drivers Upload Report
                                        <a class="btn btn-sm rounded white text-primary" style="width:170px;" href="admin.php">
                                            <i class="ion-arrow-left-c"></i> Back To Dashboard
                                        </a>
                                        
                                    </p>
<div class="list-group m-b">
<?php

if (isset($_POST["submit"])) {
    $filename = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($filename, "r");
        while (($emapData = fgetcsv($file, 100000, ",")) !== FALSE) {
            if (!empty($emapData[0]) AND !empty($emapData[1]) AND !empty($emapData[2]) AND !empty($emapData[3])) {
                if (strpos($emapData[1], '0') == 0) {
                    $phone     = "+254" . substr($emapData[1], -9);
                    $arguments = array(
                        'phonenumber' => $phone
                    );
                    if (returnExists('drivers', $arguments) == 0) {
                        $name         = trim($emapData[0]);
                        $phonenumbers = $phone;
                        $regno        = trim($emapData[2]);
                        $engineSize   = trim($emapData[3]);
                        $sql          = "INSERT INTO `drivers` (`name`, `phonenumber`,`regno`,`engineSize`) 
                        VALUES('$name','$phonenumbers','$regno','$engineSize')";
                        
                        $result = mysqli_query($conn, $sql);
                        
                        if ($result) {
                            echo '<a class="list-group-item text-success" href="#">
                                <span class="pull-right text-success">
                                    <i class="ion-checkmark-circled text-xs"></i>
                                </span> Driver <b>' . $emapData[0] . ', ' . $emapData[1] . '</b> added successfully
                            </a>';
                        } else {
                            echo '<a class="list-group-item text-danger" href="#">
                                <span class="pull-right text-danger">
                                    <i class="ion-close-circled text-xs"></i>
                                </span> Something went wrong adding driver <b>' . $emapData[0] . ', ' . $emapData[1] . '</b> 
                            </a>';
                        }
                    } else {
                        echo '<a class="list-group-item text-danger" href="#">
                                <span class="pull-right text-danger">
                                    <i class="ion-close-circled text-xs"></i>
                                </span> The driver <b>' . $emapData[0] . ', ' . $emapData[1] . '</b> already exists
                        </a>';
                    }
                    
                } else if (strpos($emapData[1], '7') == 0) {
                    $phone     = "+254" . $emapData[1];
                    $arguments = array(
                        'phonenumber' => $phone
                    );
                    if (returnExists('drivers', $arguments) == 0) {
                        $name         = trim($emapData[0]);
                        $phonenumbers = $phone;
                        $regno        = trim($emapData[2]);
                        $engineSize   = trim($emapData[3]);
                        $sql          = "INSERT INTO `drivers` (`name`, `phonenumber`,`regno`,`engineSize`) 
                        VALUES('$name','$phonenumbers','$regno','$engineSize')";
                        
                        $result = mysqli_query($conn, $sql);
                        
                        if ($result) {
                            echo '<a class="list-group-item text-success" href="#">
                                <span class="pull-right text-success">
                                    <i class="ion-checkmark-circled text-xs"></i>
                                </span> Driver <b>' . $emapData[0] . ', ' . $emapData[1] . '</b> added successfully
                            </a>';
                        } else {
                            echo '<a class="list-group-item text-danger" href="#">
                                <span class="pull-right text-danger">
                                    <i class="ion-close-circled text-xs"></i>
                                </span> Something went wrong adding driver <b>' . $emapData[0] . ', ' . $emapData[1] . '</b> 
                            </a>';
                        }
                    } else {
                        echo '<a class="list-group-item text-danger" href="#">
                                    <span class="pull-right text-danger">
                                        <i class="ion-close-circled text-xs"></i>
                                    </span> The driver <b>' . $emapData[0] . ', ' . $emapData[1] . '</b> already exists
                            </a>';
                    }
                } else if (strpos($emapData[1], '+') == 0) {
                    
                    $arguments = array(
                        'phonenumber' => $emapData[1]
                    );
                    if (returnExists('drivers', $arguments) == 0) {
                        $name         = trim($emapData[0]);
                        $phonenumbers = trim(str_replace(' ', '', $emapData[1]));
                        $regno        = trim($emapData[2]);
                        $engineSize   = trim($emapData[3]);
                        $sql          = "INSERT INTO `drivers` (`name`, `phonenumber`,`regno`,`engineSize`) 
                        VALUES('$name','$phonenumbers','$regno','$engineSize')";
                        
                        $result = mysqli_query($conn, $sql);
                        
                        if ($result) {
                            echo '<a class="list-group-item text-success" href="#">
                                <span class="pull-right text-success">
                                    <i class="ion-checkmark-circled text-xs"></i>
                                </span> Driver <b>' . $emapData[0] . ', ' . $emapData[1] . '</b> added successfully
                            </a>';
                        } else {
                            echo '<a class="list-group-item text-danger" href="#">
                                <span class="pull-right text-danger">
                                    <i class="ion-close-circled text-xs"></i>
                                </span> Something went wrong adding driver <b>' . $emapData[0] . ', ' . $emapData[1] . '</b> 
                            </a>';
                        }
                        
                    } else {
                        echo '<a class="list-group-item text-danger" href="#">
                                <span class="pull-right text-danger">
                                    <i class="ion-close-circled text-xs"></i>
                                </span> The driver <b>' . $emapData[0] . ', ' . $emapData[1] . '</b> already exists
                        </a>';
                    }
                    
                } else {
                    echo '<a class="list-group-item text-danger" href="#">
                                        <span class="pull-right text-danger">
                                            <i class="ion-close-circled text-xs"></i>
                                        </span> The phone number <b>' . $emapData[0] . ', ' . $emapData[1] . '</b> Is invalid
                    </a>';
                }
            } else {
                echo '<a class="list-group-item text-danger" href="#">
                                        <span class="pull-right text-danger">
                                            <i class="ion-close-circled text-xs"></i>
                                        </span>Please provide a name, phone number, car registration number and engine size
                </a>';
            }
        }
        fclose($file);
        
        //close of connection
        mysqli_close($conn);
    } else {
        echo '<a class="list-group-item text-danger" href="#">
            <span class="pull-right text-danger">
                <i class="ion-close-circled text-xs"></i>
            </span> Please upload a CSV file
        </a>';
    }
}

?>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<script src="js/app.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>