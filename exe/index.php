<?php


class SignInAdmin
{

    private $phonenumber, $password;

    function __construct(){

        session_start();
        
        global $conn;
        

        include_once($_SERVER["DOCUMENT_ROOT"] . '/tappsRide/loader.php');
        
        if(isset($_REQUEST['phonenumber']) AND isset($_REQUEST['password'])){
            
            // sanitize variables

            $this->phonenumber = mysqli_real_escape_string($conn, $_REQUEST['phonenumber']);
            $this->password    = mysqli_real_escape_string($conn, $_REQUEST['password']);

            
            
            if(empty($this->phonenumber) OR empty($this->password)){
                die('Please fill all fields');
            }
            

            // check phonenumber length
            if(!ctype_digit($this->phonenumber)){
                die('Invalid phone number format');
            }

            if(strlen($this->phonenumber) !== 10){
                die('Invalid phone number');
            }

            // format phone
            $formated_phone = "+254".substr($this->phonenumber, -9);
            
            if(strlen($this->password) < 6){
                die('The password should be at least 6 characters');
            }

            //encrypt password
            $encpassword   = sha1($this->password);
            
            // validate information to avoid duplicates
            $adminNumber = array('phonenumber' => $formated_phone, 'password' => $encpassword);
        
            if(returnExists('admin', $adminNumber) == 0){
                die('Invalid Phone Number and password');
            }

            $_SESSION['loggedagent'] = $formated_phone;
            echo "1";
            
        }
    }
}

$SignInAdmin = new SignInAdmin();

?>