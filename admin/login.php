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
            background:#ced3f9;
            background: linear-gradient(to bottom right,#9da7f3, #ced3f9, #9da7f3);
         }
        ::-webkit-scrollbar { 
         display: none; 
         }
         .center {
            background:#7d85c2;
        background: linear-gradient(to bottom right,#4e5379, #7d85c2, #4e5379);
        margin-bottom: 5%;
        margin-left: 0px;
        padding-left: 1%;
        width: 100%;
        border-bottom: 1px solid #848c91;
        padding-top: 2%;
        }
        .center2 {
        background:#b0b8f5;
        background: linear-gradient(to bottom right,#8d96da, #b0b8f5, #8d96da);
        margin-bottom: 11%;
        margin-top: 10%;
        margin-left: 33%;
        width: 30%;
        padding-bottom: 2%;
        }
        .bt-c{
        background:#7d85c2;
        background: linear-gradient(to bottom right,#4e5379, #7d85c2, #4e5379);
         }
         .border-top{
        margin-left: 0px;
        border-top: 1px solid #848c91;
        padding-top: 1.5%;
        padding-left: 2%;
         }
         .header{
        background:#7d85c2;
        background: linear-gradient(to bottom right,#4e5379, #7d85c2, #4e5379);
        width: 100%;
        padding-bottom: 2%;
         }
         .padding{
            padding-top: 2%;
            padding-left: 4%;
            padding-right: 4%;
         }
         .entry-group{
            border-left: 1px solid #848c91;
            border-right: 1px solid #848c91;
            border-bottom: 1px solid #848c91;
         }
         .radius{
            border-radius: 5px 5px 0px 0px;
         }
    </style>
</head>
<body>
<section id="backgroundBody" style="margin:0 auto;">
<div>
<div class = "row center">
here</div>
<div class = "row center2 radius" >
    <div class = "header padding radius">              
    <header >
        <strong style = "color: #333; padding-left: 20%;">Sign in to access admin account</strong>
    </header>
    </div>
    <div class = "padding" style = "padding-top: 10%;">   
    <form>
    <div class ="padding">
        <input  type="text" autocomplete = "tel-national" class="form-control" placeholder="Phone Number (07xxxxxxxx)" id="phonenumber">
    </div>
    <div class ="padding">
        <input  type="password" autocomplete = "current-password" class="form-control" placeholder="Password" id="password">
    </div>
    </form>
    <div >
        <p id="lsresp"></p>
    </div>
    <div class = "padding" style = "padding-top: 5%;">
    <button id="signinadmin" class="btn btn-block bt-c" style = "color: #333;">Sign in</button>
    <a href="#">
        <p style = "color: #333; padding-top: 4%; padding-bottom: 2%;"><small>Forgot your password?</small></p>
    </a>
    </div>
    </div>
</div>
<footer id="footer">
    <div class = "border-top">
        <p><small> &copy;Tapps Ride, all rights reserved<?php
echo date(" Y");
?>.</small></p>
    </div>
</footer>
</div>
</section>
<script src="../admin/js/main.js"></script>
</body>
</html>