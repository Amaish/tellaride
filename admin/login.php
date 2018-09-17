<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>Admin Dashboard</title>
      <meta content="Tellmzazi" name="description">
      <meta content="width=device-width,initial-scale=1,maximum-scale=1,minimal-ui" name="viewport">
      <meta content="IE=edge" http-equiv="X-UA-Compatible">
      <meta content="yes" name="">
      <meta content="black-translucent" name="">
      <meta content="Tellmzazi" name="">
      <meta content="yes" name="">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
      <link href="css/animate.css/animate.min.css" rel="stylesheet" type="text/css">
      <link href="css/glyphicons/glyphicons.css" rel="stylesheet" type="text/css">
      <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <link href="css/material-design-icons/material-design-icons.css" rel="stylesheet" type="text/css">
      <link href="css/ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css">
      <link href="css/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
      <link href="css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
      <link href="css/styles/app.min.css" rel="stylesheet">
      <link href="css/styles/font.css" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <style type="text/css">
         ::-webkit-scrollbar { 
         display: none; 
         }
         #footer{
 position:relative;
 bottom:0;
 left:0;
}
      </style>
   </head>
   <body style="width:100%">
<section class="wrapper-md animated fadeInDown"style ="width: auto; height: 100%;">
      <div class = "row text-primary text-center" style ="padding-top: 1%;background-color: #dde1e1;height: 5%;">
      <b > Tapps Ride </b>
      </div>
      <div class = "row" style =" height: 90%;">
      <div class="col-md-7 text-primary text-center">
               <a ><img class = "displayed" src="../admin/images/mainlogo4.ico" alt="logo"/></a>
      </div>
      <div class="col-md-5 text-primary text-center"style ="background-color: #c4c8c8; height: 100%;">
               <div class = "row text-center" style =" background-color: #939696; height: 10%;">
                  <header style ="padding-top: 3%;">
                     <strong >Sign in to access admin account</strong>
                  </header>
               </div>
               <div class = "row" style =" height: 90%;">
               <div class="list-group" style="background-color: #c4c8c8; padding-top: 5%; padding-left: 10%; padding-right: 10%;padding-bottom: 5%;">
                     <div class="list-group-item" style="background-color: #f3f4f4;">
                        <input  class="form-control no-border" type="text" autocomplete = "tel-national" placeholder="Phone Number (07xxxxxxxx)" id="phonenumber">
                     </div>
                     <div class="list-group-item" style="background-color: #f3f4f4;">
                        <input  class="form-control no-border" type="password" autocomplete = "current-password" placeholder="Password" id="password">
                     </div>
                     <div  style="padding-top: 5%;" >
                     <button class="btn btn-primary btn-block"id="signinadmin" >Sign in</button>
                  </div>
                  </div>

                  <div >
                     <p id="lsresp"></p>
                  </div>
                  </div>
      </div>
      </div>
      <div class = "row" style ="background-color: #dde1e1;height: 5%;">
            <footer class = "text-primary" id= "footer">
               <p><small> &copy;Tapps Ride, all rights reserved<?php
                  echo date(" Y");
                  ?>.</small></p>
            </footer>
      </div>
      </section>
      <script src="js/app.v1.js"></script>
      <script src="js/app.min.js"></script>
      <script src="js/main.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script type="text/javascript" src="css/bootstrap/dist/js/bootstrap.min.js"></script>
   </body>
</html>