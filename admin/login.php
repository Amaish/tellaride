<!DOCTYPE html>
<html class="" lang="en">

<head>
    <title>Tapps Ride admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=NTR' rel='stylesheet'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        html{
            height:100%;
            width:100%;
        }
        body{
            height:100%;
            width:100%;
            background:#C9E1F0;
            background: linear-gradient(to bottom right,#8798a3, #C9E1F0, #8798a3);
         }
        ::-webkit-scrollbar { 
         display: none; 
         }
         .center {
        margin-bottom: 5%;
        margin-left: 1px;
        width: 100%;
        border-bottom: 1px solid #748a98;
        }
        .center2 {
        margin-bottom: 20%;
        margin-left: 35%;
        width: 30%;
        border: 1px solid #748a98;
        padding-left: 2%;
        padding-top: 2%;
        padding-bottom: 2%;
        padding-right: 2%;
        }
        .bt-c{
         background-color: #748a98;
         }
         .bt-b-r{
         border-radius: 40px;
         }
         .border-top{
             margin-left: 1px;
             border-top: 1px solid #748a98;
             padding-top: 0.5%;
         }
    </style>
</head>
<body>
<section id="backgroundBody" style="margin:0 auto; padding-top: 3%;">
<div>
<div class = "row center">
here</div>
<div class = "row center2" >              
    <header >
        <strong>Sign in to access admin account</strong>
    </header>        
    <div >
        <input  type="text" class="form-control" placeholder="Phone Number (07xxxxxxxx)" id="phonenumber">
    </div>
    <br>
    <div >
        <input  type="password" class="form-control" placeholder="Password" id="password">
    </div>                
    <div >
        <p id="lsresp"></p>
    </div>
    <button id="signinadmin" class="btn btn-block bt-c" style = "color: black;" >Sign in</button>
    <a href="#">
        <p class="text-muted" style = "color: black; padding-top: 2%;"><small>Forgot your password?</small></p>
    </a>
</div>
<footer id="footer">
    <div class = "border-top">
        <p><small> &copy;Tapps Ride, all rights reserved<?php echo date(" Y"); ?>.</small></p>
    </div>
</footer>
</div>
</section>
<script src="../admin/js/main.js"></script>
</body>
</html>