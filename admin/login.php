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
        body {
            background: #f4f9fc;
            background: linear-gradient(to right, #e0eef7, #f4f9fc, #e0eef7);
        }
        
        ::-webkit-scrollbar {
            display: none;
        }
        
        .head1 {
            background: #eff6fa;
            background: linear-gradient(to right, #e0eef6, #eff6fa, #e0eef6);
        }
        
        .head2 {
            background: #eff6fa;
            background: linear-gradient(to right, #e0eef6, #eff6fa, #e0eef6);
        }
        
        #footer {
            position: relative;
            bottom: 0;
            left: 0;
        }
    </style>
</head>

<body >
    <section id="backgroundBody" style="margin:0 auto; padding-top: 3%; height: auto;">
        <div class="row" style="height: 83%; width: 80%; margin: 0 auto; box-shadow: 0 8px 17px rgba(0, 0, 0, 0.2);">
            <div >
                  <div class="col-md-6 text-primary text-center ">
                  <div style="padding-top: 15%;">
                  <b> <h1>Tapps Ride</h1> </b>
                  </div>
                  <a><img class="displayed " src="../admin/images/mainlogo4.ico" style="padding-top: 5%; padding-bottom: 5%;" alt="logo" /></a><br>
                  <footer class="text-primary" id="footer">
                  <p><small> &copy;Tapps Ride, all rights reserved<?php
                        echo date(" Y");
                        ?>.</small></p>
                  </footer>
                  </div>
                  <div class="col-md-6 text-primary text-center" style="background-color: #c4c8c8; height: 100%;">
                  <div class="text-center ">
                        <header style="padding-top: 15%;">
                              <strong> <h2>Sign in to access admin account</h2></strong>
                        </header>
                  </div>
                  <div >
                        <div class="list-group" style="background-color: #c4c8c8; padding-top: 20%; padding-left: 10%; padding-right: 10%;padding-bottom: 5%;">
                              <div class="list-group-item" style="background-color: #f3f4f4;">
                              <input class="form-control no-border" type="text" autocomplete="tel-national" placeholder="Phone Number (07xxxxxxxx)" id="phonenumber">
                              </div>
                              <div class="list-group-item" style="background-color: #f3f4f4;">
                              <input class="form-control no-border" type="password" autocomplete="current-password" placeholder="Password" id="password">
                              </div>
                              <div style="padding-top: 5%;">
                              <button class="btn btn-primary btn-block" id="signinadmin">Sign in</button>
                              </div>
                        </div>

                        <div>
                              <p id="lsresp"></p>
                        </div>
                  </div>
                  </div>
            </div>
        </div>
    </section>
    <script src="js/app.v1.js"></script>
    <script src="js/app.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="css/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>