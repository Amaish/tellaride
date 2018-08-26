<?php
include_once($_SERVER["DOCUMENT_ROOT"] . '/tappsRide/core.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $adminName;?> - Admin Dashboard</title>
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
	<link href="css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/styles/app.min.css" rel="stylesheet">
	<link href="css/styles/font.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
	
	<!-- <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css"> -->
    <style type="text/css">
	     ::-webkit-scrollbar { 
	       display: none; 
	   }
	</style>
</head>
<body class="pace-done">
	<div class="app" id="app">
		<div class="app-content box-shadow-z2 pjax-container" id="content" role="main">
			<div class="app-body">
				<div class="app-body-inner">
					<?php include_once 'top.php'; ?>
					<div class="row-col">
						
						<div class="row-row">
							<div class="row-col">
                				<?php include_once 'side.php'; ?>
								<div class="col-xs col-md-9" id="detail"><br>
									<p class="text-md text-primary" style="margin-left: 5px;">
									Admin Dashboard

									<a style="border-color: gray;" class="btn btn-sm rounded " data-toggle="modal" data-target="#uploaddrivers" data-ui-toggle-class="fade-left-big" data-ui-target="#animate">Upload Drivers</a>

									<!-- upload drivers csv modal -->

									<div id="uploaddrivers" class="modal fade animate" data-backdrop="true">
										<div class="modal-dialog" id="animate">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title text-primary">Upload Drivers List</h5>
												</div>
												<div class="modal-body text-center p-lg pull-left">
													<p>Select the CSV file (should be in CSV format)</p><br>

													<form action="upload.php" method="post" enctype="multipart/form-data">
													<input type="file" name="file">
												</div><br><br>
												<div style="margin-top: 50px;" class="modal-footer">
													<button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Cancel</button>
													<input value="Upload" type="submit" name="submit" class="btn primary p-x-md">
												</div>
											</div>
										</div>
									</div>
								</p>
									<div class="row-col">
										<div class="row-row">
											<div class="row-body scrollable hover">
												<div class="row-inner"><br>
                                                    <table class="table table-hover b-t">
													   <thead>
													      <tr>
													         <th>Name</th>
													         <th>Phone Number</th>
													         <th>Reg Number</th>
													         <th>Engine Size</th>
													         <th>No. of Trips</th>
															 <th>Status</th>
															 <th>Location</th>
													         <th>Action</th>
													      </tr>
													   </thead>
													   <tbody>

													   	<?php
													   	$driverids = returnArrayOfAllTable('drivers','id', 'name');

													   	$drivers_array = explode(',', $driverids);

													   	foreach ($drivers_array as $each_driver) {
													   		$args = array('id'=>$each_driver);
													   	?>
													   	<tr>
													        <td><?php echo getByValue('drivers', 'name', $args); ?></td>
													        <td><?php echo getByValue('drivers', 'phonenumber', $args); ?></td>
													        <td><?php echo getByValue('drivers', 'regno', $args); ?></td>
													        <td><?php echo getByValue('drivers', 'engineSize', $args); ?></td>
													        <td><?php echo getByValue('drivers', 'trips', $args); ?></td>
															<td><?php echo getByValue('drivers', 'status', $args); ?></td>
															<td><?php echo getByValue('drivers', 'location', $args); ?></td>
													        <td>
												                <div class="btn-group dropdown">
												                   
												                    <button aria-expanded="false" class="btn btn-sm white dropdown-toggle" data-toggle="dropdown"></button>
												                    <div class="dropdown-menu">
												                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editdriver<?php echo $each_driver; ?>" data-ui-toggle-class="fade-left-big" data-ui-target="#animate">Edit Driver</a> 
												                        <a class="dropdown-item text-danger" data-toggle="modal" data-target="#delete<?php echo $each_driver; ?>" data-ui-toggle-class="fade-left-big" data-ui-target="#animate">Delete Driver</a>
												                    </div>
												                </div>
												            </td>
													     </tr>

													     <!-- start of modal for edit driver detals -->
													     <div aria-hidden="true" class="modal fade animate" data-backdrop="true" id="editdriver<?php echo $each_driver; ?>" style="display: none;">
															<div class="modal-dialog fade-left-big" data-ui-class="fade-left-big" id="animate">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title text-primary">Edit <?php echo getByValue('drivers', 'name', $args); ?></h5>			
																	</div>
																	<div class="modal-body p-lg">
																		<div class="md-form-group">
																			<input class="md-input" value="<?php echo getByValue('drivers', 'name', $args); ?>" id="e_name_<?php echo $each_driver; ?>" placeholder="Name"><label></label>
																		</div>
																		<div class="md-form-group">
																			<input class="md-input" value="<?php echo getByValue('drivers', 'phonenumber', $args); ?>" id="e_phone_<?php echo $each_driver; ?>" placeholder ="Phone Number"><label></label>
																		</div>
																		<div class="md-form-group">
																			<input class="md-input" value="<?php echo getByValue('drivers', 'regno', $args); ?>" id="e_regno_<?php echo $each_driver; ?>" placeholder="Registration Number"><label></label>
																		</div>
																		<div class="md-form-group">
																			<input class="md-input" value="<?php echo getByValue('drivers', 'engineSize', $args); ?>" id="e_engineSize_<?php echo $each_driver; ?>" placeholder="Engine Size"><label></label>
																		</div>
																		<div class="md-form-group">
																			<input class="md-input" value="<?php echo getByValue('drivers', 'location', $args); ?>" id="e_location_<?php echo $each_driver; ?>" placeholder="location"><label></label>
																		</div>
																		<div class="md-form-group">
																			<input class="md-input" value="<?php echo getByValue('drivers', 'status', $args); ?>" id="e_status_<?php echo $each_driver; ?>" placeholder="status"><label></label>
																		</div>
																		<p id="editresponse<?php echo $each_driver; ?>"></p>
																	</div>
																	<div class="modal-footer" id="editdriverpwrap">
																		<button class="btn dark-white p-x-md" id="forcecloseedit" data-dismiss="modal" type="button">Cancel</button> 
																		<button class="btn primary p-x-md" id="editbtn" value="<?php echo $each_driver; ?>" type="button">Update <i class="ion-ios-arrow-thin-right">&nbsp;</i></button>
																	</div>
																</div>
															</div>
														</div>

														<!-- end of modal for edit driver details -->

														<!-- start of modal to delete a driver -->

														<div aria-hidden="true" class="modal fade animate" data-backdrop="true" id="delete<?php echo $each_driver; ?>" style="display: none;">
															<div class="modal-dialog fade-left-big" data-ui-class="fade-left-big" id="animate">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title text-primary">Delete <?php echo getByValue('drivers', 'name', $args); ?></h5>			
																	</div>
																	<div class="modal-body p-lg">
												                    <div class="p-a padding">
												                        <p class="text-md m-t block text-muted">Do you want to proceed?</p><br>
												                        <p class="text-muted"><small>Once triggered, you cannot undo this process.</small></p><br>
												                        
												                    </div>
												    					<p id="deleteresponse<?php echo $each_driver; ?>"></p>
																	</div>

																	<div class="modal-footer" id="deletewrapper">
																		<button class="btn dark-white p-x-md" id="forceclosedelete" data-dismiss="modal" type="button">Cancel</button> 
																		<button class="btn danger p-x-md" value="<?php echo $each_driver; ?>" id="deletedrivertbtn" type="button">Yes, Delete <i class="ion-ios-arrow-thin-right">&nbsp;</i></button>
																	</div>
																</div>
															</div>
														</div>

														<!-- end of modal to delete a driver -->

													   	<?php
													   	}
													   	?>
													   </tbody>
													</table>
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
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript" src="css/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="js/app.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>