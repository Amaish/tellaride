<?php
include_once($_SERVER["DOCUMENT_ROOT"] . '/tappsRide/core.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $adminName; ?> - Settings</title>
	<meta content="Tapps Ride" name="description">
	<meta content="width=device-width,initial-scale=1,maximum-scale=1,minimal-ui" name="viewport">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="yes" name="">
	<meta content="black-translucent" name="">
	<meta content="Tapps Ride" name="">
	<meta content="yes" name="">
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
	<style type="text/css">
	   ::-webkit-scrollbar { 
	   display: none; 
	}
	</style>
</head>
<body>
	<div class="app" id="app">
		<div class="app-content box-shadow-z2 pjax-container" id="content" role="main">
			<div class="app-body">
				<div class="app-body-inner">
					<div class="row-col">
						<?php include_once 'top.php'; ?>
						<div class="row-row">
							<div class="row-col">
								<?php include_once 'side.php'; ?>
								<div class="col-xs col-md-9" id="detail">
									<p class="text-md text-primary" style="margin-left: 5px;">Settings</p>
									<div class="row-col">
										<div class="row-row">
											<div class="row-body scrollable hover">
												<div class="row-inner">
													<div class="p-a-md white bg">
														<h5 class="text-muted">Account Password</h5><br>
														<div class="clearfix m-b-lg">
															<div class="md-form-group float-label">
																<input type="password" class="md-input" required="" id="editoldpassword">
																<label>Old Password</label>
															</div>
															<div class="md-form-group float-label">
																<input type="password" class="md-input" required="" id="editnewpassword">
																<label>New Password</label>
															</div>
															<div class="md-form-group float-label">
																<input type="password" class="md-input" required="" id="editcnewpassword">
																<label>Confirm New Password</label>
															</div>

															<p id="passresponse"></p>
																
															<button class="btn btn-info m-t" id="accountlock">Change Password<i class="ion-ios-arrow-thin-right">&nbsp;</i></button>
															
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="js/app.min.js">
	</script> 
	<script src="js/main.js">
	</script>
</body>
</html>