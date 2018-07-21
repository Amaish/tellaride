<?php
function formSearchString($arguments)
{
    $string = "";
    foreach ($arguments as $key => $value) {
        $string .= "`" . $key . "`=" . "'" . $value . "' && ";
    }
    
    $conditions = substr($string, 0, -3);
    return $conditions;
}
function returnExists($table, $arguments)
{
    global $conn;
    $appendSearch = formSearchString($arguments);
    $formedQuery  = "SELECT * FROM $table WHERE  $appendSearch";
    $getValues    = mysqli_num_rows(mysqli_query($conn, $formedQuery));
    return $getValues;
}
function getByValue($table, $column, $arguments)
{
    global $conn;
    $appendSearch = formSearchString($arguments);
    $formedQuery  = "SELECT * FROM $table WHERE $appendSearch";
    $executeQuery = mysqli_query($conn, $formedQuery);
    if (mysqli_num_rows($executeQuery) > 0) 
    {
        $getValues = mysqli_fetch_array($executeQuery);
        return $getValues[$column];
    } 
    else {
        return false;
    }
}

function getManyByValue($table, $column, $arguments)
{
    global $conn;
    $databack     = "";
    $appendSearch = formSearchString($arguments);
    $formedQuery  = "SELECT * FROM $table WHERE " . $appendSearch . " ORDER BY id DESC";
    $executeQuery = mysqli_query($conn, "$formedQuery");
    if (mysqli_num_rows($executeQuery) > 0) 
    {
        while ($getValues = mysqli_fetch_array($executeQuery)) 
        {
            $databack .= $getValues[$column] . ",";
        }
        
        $columnArray = substr($databack, 0, -1);
        return explode(",", $columnArray);
    } else {
        return "No Data Found";
    }
}

function sendMessageLive($phoneNumber,$message)
{
    require_once('AfricasTalkingGateway.php');
    $username   = "amaina";
    $apikey     = "03591223d8bb42724274df7525e35a0e486f0067e197cdde5b03761851a4bd90";
    $recipients = $phoneNumber;
    $message    = $message;
    $from = "20880";
    $gateway    = new AfricasTalkingGateway($username, $apikey);
    try 
    {
        $results = $gateway->sendMessage($recipients, $message, $from);
    }
        catch ( AfricasTalkingGatewayException $e )
    {
        echo "END Encountered an error while sending: ".$e->getMessage();
    }
}
function sendMessage($phoneNumber,$message)
{
    require_once('AfricasTalkingGateway.php');
    $username   = "sandbox";
    $apikey     = "12b82348c95eeb2e1fac5fe36d5f20c5e5f55140950bb348a19b53632a497d38";
    $recipients = $phoneNumber;
    $message    = $message;
    $from = "tappsRide";
    $gateway    = new AfricasTalkingGateway($username, $apikey);
    try 
    {
        $results = $gateway->sendMessage($recipients, $message, $from);
    }
        catch ( AfricasTalkingGatewayException $e )
    {
        echo "END Encountered an error while sending: ".$e->getMessage();
    }
}
function AdminWelcomeScreen()
{
    $response  = "CON Welcome to Tapps Ride\n";
    $response .= "Please choose an option\n";
    $response .= "1. Add driver\n";
    $response .= "2. Delete driver";
    return $response;
}
function AddDriverName()
{
    $response  = "CON Enter Driver name\n";
    return $response;
}
function AddDriverNumber()
{
    $response  = "CON Enter Driver number\n";
    return $response;
}
function deleteDriverMenu()
{
    $response  = "CON Enter driver number\n";
    return $response;
}
function driverWelcomeScreen($name)//edit for current location
{
    $response  = "CON Welcome $name\n";
    $response .= "Please choose an option\n";
    $response .= "1. Edit location\n";
    $response .= "2. Start trip\n";
    $response .= "3. End trip\n";
    $response .= "4. Edit status\n";
    $response .= "5. Check location\n";
    $response .= "6. Exit";
    return $response;
}
function driverEditLocation()
{
    $response  = "CON Enter location\n";
    return $response;
}
function driverEditStatus()
{
    $response  = "CON 1. Offline\n";
    $response .= "2. Online";
    return $response;
}
function riderWelcomeScreen()
{
    $response  = "CON Welcome to Tapps Ride\n";
    $response .= "Please choose an option\n";
    $response .= "1. Request a ride\n";
    $response .= "2. Exit";
    return $response;
}
function riderLocationScreen()
{
    $response  = "CON Enter location\n";
    return $response;
}
function closestDriver($currentLocation, $driverLocation)
{
    //Our starting point/current location.
    $rawstart = $currentLocation;
    $start = "$rawstart,Nairobi, Kenya";
    $distance = array();
    $locName = array();
    foreach($driverLocation as $location){
        $destination = "$location, Nairobi, Kenya";
        //The Google Directions API URL. Do not change this.
        //key = AIzaSyBsz4l9f7T4QOP6atqN8_eYJKhVcmWn4l8
        $apiUrl = 'https://maps.googleapis.com/maps/api/directions/json?key=AIzaSyBsz4l9f7T4QOP6atqN8_eYJKhVcmWn4l8';
        //Construct the URL that we will visit with cURL.
        $url = $apiUrl . '&' . 'origin=' . urlencode($start) . '&destination=' . urlencode($destination);
        //Initiate cURL.
        $curl = curl_init($url);
        //Tell cURL that we want to return the data.
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //Execute the request.
        $res = curl_exec($curl);
        //If something went wrong with the request.
        if(curl_errno($curl)){
            throw new Exception(curl_error($curl));
        }
        //Close the cURL handle.
        curl_close($curl);
        //Decode the JSON data we received.
        $json = json_decode(trim($res), true);
        //Automatically select the first route that Google gave us.
        $route = $json['routes'][0];
        //Loop through the "legs" in our route and add up the distances.
        $totalDistance = 0;
        foreach($route['legs'] as $leg){
            $totalDistance = $totalDistance + $leg['distance']['value'];
            array_push($distance, $totalDistance);
            $locName[$totalDistance] = $location;
        }
        $closestDrvraw = min ($distance);
        //Divide by 1000 to get the distance in KM.
        $closestDriver = round($closestDrvraw / 1000);
        }
        $response = array();
        $result = "$closestDriver KM";
        $locationName = $locName[$closestDrvraw];
        $argsloc = array('location'=>$locationName);
        $driverNum = getByValue('drivers','phonenumber',$argsloc);
        array_push($response,$result,$locationName,$driverNum);
        return $response;
}
?>