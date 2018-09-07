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
         font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
         font-size: 14px;
         color: #000000;
         height:100%;
         width:100%;
         background:#f2f2f2;
         background: linear-gradient(to bottom right,#d8d8d8, #f2f2f2, #d8d8d8);
         }
         section{
         height:100%;
         width:100%;
         background:#f2f2f2;
         background: linear-gradient(to bottom right,#d8d8d8, #f2f2f2, #d8d8d8);
         }
         ::-webkit-scrollbar { 
         display: none; 
         }
         .center {
            background:#cccccc;
         background: linear-gradient(to bottom right,#666666, #cccccc, #666666);
         margin-bottom: 5%;
         margin-left: 0px;
         padding-left: 0.5%;
         width: 100%;
         border-bottom: 1px solid #848c91;
         padding-top: 0.5%;
         }
         .center2 {
         background:#d8d8d8;
         background: linear-gradient(to bottom right,#cccccc, #d8d8d8, #cccccc);
         margin-bottom: 13.5%;
         margin-top: 10%;
         margin-left: 33%;
         width: 30%;
         padding-bottom: 2%;
         }
         .bt-c{
         background:#7f7f7f;
         background: linear-gradient(to bottom right,#333333, #7f7f7f, #333333);
         }
         .border-top{
         border-top: 1px solid #848c91;
         height: 100%; 
         padding-left: 0.5%;
         padding-top:1%;
         }
         .header{
            background:#7f7f7f;
         background: linear-gradient(to bottom right,#333333, #7f7f7f, #333333);
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
         .footer{
         background:#ffffff;
         background: linear-gradient(to bottom right,#e5e5e5, #ffffff, #e5e5e5);
         }
      </style>
   </head>
   <body>
      <section id="backgroundBody" style="margin:0 auto;">
         <div>
            <div class = "row center">
            <a class="pull-left" ><img src="../admin/images/mainlogo4.ico" alt="logo" style = " padding-right: 10%; border-right: 1px solid #848c91; width:50px;height:50px;"/></a>
               <br> 
               <b style="padding-left: 1%;"> Tapps Ride </b>
            </div>
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
                  <div class = "padding" style = "padding-top: 5%; padding-bottom: 6%;">
                     <button id="signinadmin" class="btn btn-block bt-c" style = "color: #333;">Sign in</button>
                  </div>
               </div>
            </div>
            <footer class = "footer border-top" id="footer">
                  <p><small> &copy;Tapps Ride, all rights reserved<?php
                     echo date(" Y");
                     ?>.</small></p>
            </footer>
         </div>
      </section>
      <script src="../admin/js/main.js"></script>
   </body>
</html>