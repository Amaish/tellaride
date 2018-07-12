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
function riderWelcomeScreen()
{
    $response  = "CON Welcome to Tapps Ride\n";
    $response .= "Please choose an option\n";
    $response .= "1. Request a ride\n";
    $response .= "2. Exit";
    return $response;
}
function deleteDriverMenu()
{
    $response  = "CON Enter driver number\n";
    return $response;
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
?>