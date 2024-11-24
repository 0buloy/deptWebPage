<?php
	session_start();

	if($_SESSION['admin']!="admin")
	{
		header('Location: login/');
	}

	include 'db.php';
	
	if(!$conn)
	{
		die("Connection Failed. ". mysqli_connect_error());
		echo "can't connect to database";
	}
	
	//GET FROM Delivery / ROUTE
	$adeliveryQuery = "SELECT * FROM `delivery` WHERE status = 'onroute'";
	$adResult = mysqli_query($conn ,$adeliveryQuery);
	
	//GET FROM Delivery / DELIVERED
	$bdeliveryQuery = "SELECT * FROM `delivery` WHERE status = 'delivered' ORDER BY ID DESC";
	$bdResult = mysqli_query($conn ,$bdeliveryQuery);
	
	//GET FROM Delivery / CANCELLED
	$cdeliveryQuery = "SELECT * FROM `delivery` WHERE status = 'canceled' ORDER BY ID DESC";
	$cdResult = mysqli_query($conn ,$cdeliveryQuery);
	
?>
<!DOCGender html>
<html>
<head>
	<link rel="icon" href="img/shoplogo.png"/>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>csecommerce Admin</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	
	<style>
	.omodal
	{
		display: block; /* Hidden by default */
		position: fixed; /* Stay in place */
		z-index: 900; /* Sit on top */
		left: 0;
		top: 0;
		width: 100%; /* Full width */
		height: 100%; /* Full height */
		overflow: auto; /* Enable scroll if needed */
		background-color: rgb(0,0,0); /* Fallback color */
		background-color: rgba(0,0,0,0.3); /* Black w/ opacity */
	}
	
	.modal
	{
		display: none; /* Hidden by default */
		position: fixed; /* Stay in place */
		z-index: 900; /* Sit on top */
		left: 0;
		top: 0;
		width: 100%; /* Full width */
		height: 100%; /* Full height */
		overflow: auto; /* Enable scroll if needed */
		background-color: rgb(0,0,0); /* Fallback color */
		background-color: rgba(0,0,0,0.3); /* Black w/ opacity */
	}

	.modal-header {
		padding: 2px 16px;
		color: black;
	}

	/* Modal Body */
	.modal-body
	{
		padding: 2px 16px;
		color: black;
	}

	/* Modal Footer */
	.modal-footer
	{
		padding: 2px 16px;
	}

	/* Modal Content */
	.modal-content
	{
		position: relative;
		margin-right: auto;
		margin-left: auto;
		margin-top: 100px;
		padding: 0;
		border: 1px solid orange;
		width: 50%;
		box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
		animation-name: animatetop;
		animation-duration: 0.4s
	}
	</style>
	
</head>
<body>
	<?php include 'topnav.php'; ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Orders</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Orders</h1>
			</div>
		</div><!--/.row-->
		
		
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default articles">
					<div class="panel-heading">
						To Process
					<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
						
					<div class="panel-body articles-container">
					<?php
						if (mysqli_num_rows($adResult) > 0)
						{
							while($adRow = mysqli_fetch_assoc($adResult))
							{
								echo
								'
								<div class="article border-bottom">
									<div class="col-xs-12">
										<div class="row">
											<div style="text-align:left" class="col-xs-5 col-md-5 date">
												<div class="large">'.$adRow['date'].'</div>
												<!--div class="text-muted">'.$adRow['date'].'</div-->
												<div style="margin-top:5px;color:#565c5c;font-size:12px"><b>'.$adRow['time'].'</b></div>
											</div>
											<div style="text-align:right" class="col-xs-7 col-md-7">
												<button style="color:green" onClick="username = \''.$adRow['username'].'\';showDeliverModal('.$adRow['ID'].')">Delivered</button>
												<button style="color:red" onClick="showdDeliverModal('.$adRow['ID'].')">Decline</button>
											</div>
											<div class="col-xs-10 col-md-10">
												<h4 style="color:#ffb53e">'.$adRow['fullname'].'</h4>
												<p style="font-size:12px">@'.$adRow['username'].'</p>
												<p style="font-size:11px">'.$adRow['email'].'<br>'.$adRow['phone'].'</p>
												<p style="font-size:12px">
												'.$adRow['course'].' '.$adRow['yearsection'].'<br><br>
												Landmark: '.$adRow['landmark'].'<br>
												Gender: '.$adRow['gender'].'<br>
												</p>
												<p style="color:black;font-size:12px">ITEMS:
												</p>
											</div>
											<div class="col-xs-12 col-md-12">
												<table style="width:100%;color:black;font-size:12px">
													<tr>
														<th>Item Name</td>
														<th>Price</td>
														<th style="text-align:center">Quantity</td>
														<th>Total</td>
													</tr>
												';
												
												//GET FROM Delivery Items
												$deliveryitemsQuery = "SELECT * FROM `deliveryitems` WHERE deliveryid='".$adRow['ID']."'";
												$diResult = mysqli_query($conn ,$deliveryitemsQuery);
												
												if (mysqli_num_rows($diResult) > 0)
												{
													while($diRow = mysqli_fetch_assoc($diResult))
													{
														echo'
														<tr>
															<td>'.$diRow['ItemName'].'</td>
															<td>'.$diRow['Price'].'.00</td>
															<td style="text-align:center"><b>'.$diRow['Quantity'].'</b></td>
															<td>Php '.$diRow['Total'].'.00</td>
														</tr>';
													}
												}
												
												echo'
													<tr>
														<th colspan="3"></td>
														<th>Php '.$adRow['payment'].'.00</td>
													</tr>
													<tr>
														<td colspan="3">Delivery Fee:</td>
														<td>Php '.$adRow['fee'].'.00</td>
													</tr>
												</table>
											</div>
										</div>
									</div>
									<div class="clear"></div>
								</div>
								';
							}
						}
						
					?>
					</div>
				</div><!--End .articles-->
			</div><!--/.col-->
			
			<div class="col-md-6">
				<div class="panel panel-default articles">
					<div class="panel-heading">
						Successful Transactions
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
					</div>
					<div class="panel-body articles-container">
					<?php
						if (mysqli_num_rows($bdResult) > 0)
						{
							while($adRow = mysqli_fetch_assoc($bdResult))
							{
								echo
								'
								<div class="article border-bottom">
									<div class="col-xs-12">
										<div class="row">
											<div style="text-align:left" class="col-xs-5 col-md-5 date">
												<div class="large">'.$adRow['date'].'</div>
												<!--div class="text-muted">'.$adRow['date'].'</div-->
												<div style="margin-top:5px;color:#565c5c;font-size:12px"><b>'.$adRow['time'].'</b></div>
											</div>
											
											<div class="col-xs-10 col-md-10">
												<h4 style="color:#ffb53e">'.$adRow['fullname'].'</h4>
												<p style="font-size:12px">@'.$adRow['username'].'</p>
												<p style="font-size:11px">'.$adRow['email'].'<br>'.$adRow['phone'].'</p>
												<p style="font-size:12px">
												'.$adRow['course'].' '.$adRow['yearsection'].'<br><br>
												Landmark: '.$adRow['landmark'].'<br>
												Gender: '.$adRow['gender'].'<br>
												</p>
												<p style="color:black;font-size:12px">ITEMS:
												</p>
											</div>
											<div class="col-xs-12 col-md-12">
												<table style="width:100%;color:black;font-size:12px">
													<tr>
														<th>Item Name</td>
														<th>Price</td>
														<th style="text-align:center">Quantity</td>
														<th>Total</td>
													</tr>
												';
												
												//GET FROM Delivery Items
												$deliveryitemsQuery = "SELECT * FROM `deliveryitems` WHERE deliveryid='".$adRow['ID']."'";
												$diResult = mysqli_query($conn ,$deliveryitemsQuery);
												
												if (mysqli_num_rows($diResult) > 0)
												{
													while($diRow = mysqli_fetch_assoc($diResult))
													{
														echo'
														<tr>
															<td>'.$diRow['ItemName'].'</td>
															<td>'.$diRow['Price'].'.00</td>
															<td style="text-align:center"><b>'.$diRow['Quantity'].'</b></td>
															<td>Php '.$diRow['Total'].'.00</td>
														</tr>';
													}
												}
												
												echo'
													<tr>
														<th colspan="3"></td>
														<th>Php '.$adRow['payment'].'.00</td>
													</tr>
													<tr>
														<td colspan="3">Delivery Fee:</td>
														<td>Php '.$adRow['fee'].'.00</td>
													</tr>
												</table>
											</div>
										</div>
									</div>
									<div class="clear"></div>
								</div>
								';
							}
						}
						
					?>
						<!--div class="article border-bottom">
							<div class="col-xs-12">
								<div class="row">
									<div class="col-xs-2 col-md-2 date">
										<div class="large">20</div>
										<div class="text-muted">Jan</div>
									</div>
									<div class="col-xs-10 col-md-10">
										<h4><a href="">Sender Name</a></h4>
										<p>Bundle: Photo/Video Coverage<br>Hi! I want to avail the bundle.</p>
									</div>
								</div>
							</div>
							<div class="clear"></div>
						</div><!--End .article-->
					</div>
				</div><!--End .articles-->
			</div><!--/.col-->
			
			<div class="col-md-6">
				<div class="panel panel-default articles">
					<div class="panel-heading">
						<span style="color:red">Unsuccessful Transactions</span>
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
					</div>
					<div class="panel-body articles-container">
					<?php
						if (mysqli_num_rows($cdResult) > 0)
						{
							while($adRow = mysqli_fetch_assoc($cdResult))
							{
								echo
								'
								<div class="article border-bottom">
									<div class="col-xs-12">
										<div class="row">
											<div style="text-align:left" class="col-xs-5 col-md-5 date">
												<div class="large">'.$adRow['date'].'</div>
												<!--div class="text-muted">'.$adRow['date'].'</div-->
												<div style="margin-top:5px;color:#565c5c;font-size:12px"><b>'.$adRow['time'].'</b></div>
											</div>
											<div style="text-align:right" class="col-xs-7 col-md-7">
												<span style="color:black">Action: </span><b><span style="color:red">'.$adRow['action'].'</span></b>
											</div>
											<div class="col-xs-10 col-md-10">
												<h4 style="color:#ffb53e">'.$adRow['fullname'].'</h4>
												<p style="font-size:12px">@'.$adRow['username'].'</p>
												<p style="font-size:11px">'.$adRow['email'].'<br>'.$adRow['phone'].'</p>
												<p style="font-size:12px">
												'.$adRow['course'].' '.$adRow['yearsection'].' '.$adRow['brgy'].', '.$adRow['city'].', '.$adRow['province'].'<br><br>
												Landmark: '.$adRow['landmark'].'<br>
												Gender: '.$adRow['Gender'].'<br>
												</p>
												<p style="color:black;font-size:12px">ITEMS:
												</p>
											</div>
											<div class="col-xs-12 col-md-12">
												<table style="width:100%;color:black;font-size:12px">
													<tr>
														<th>Item Name</td>
														<th>Price</td>
														<th style="text-align:center">Quantity</td>
														<th>Total</td>
													</tr>
												';
												
												//GET FROM Delivery Items
												$deliveryitemsQuery = "SELECT * FROM `deliveryitems` WHERE deliveryid='".$adRow['ID']."'";
												$diResult = mysqli_query($conn ,$deliveryitemsQuery);
												
												if (mysqli_num_rows($diResult) > 0)
												{
													while($diRow = mysqli_fetch_assoc($diResult))
													{
														echo'
														<tr>
															<td>'.$diRow['ItemName'].'</td>
															<td>'.$diRow['Price'].'.00</td>
															<td style="text-align:center"><b>'.$diRow['Quantity'].'</b></td>
															<td>Php '.$diRow['Total'].'.00</td>
														</tr>';
													}
												}
												
												echo'
													<tr>
														<th colspan="3"></td>
														<th>Php '.$adRow['payment'].'.00</td>
													</tr>
													<tr>
														<td colspan="3">Delivery Fee:</td>
														<td>Php '.$adRow['fee'].'.00</td>
													</tr>
												</table>
											</div>
										</div>
									</div>
									<div class="clear"></div>
								</div>
								';
							}
						}
						
					?>
						<!--div class="article border-bottom">
							<div class="col-xs-12">
								<div class="row">
									<div class="col-xs-2 col-md-2 date">
										<div class="large">20</div>
										<div class="text-muted">Jan</div>
									</div>
									<div class="col-xs-10 col-md-10">
										<h4><a href="">Sender Name</a></h4>
										<p>Bundle: Photo/Video Coverage<br>Hi! I want to avail the bundle.</p>
									</div>
								</div>
							</div>
							<div class="clear"></div>
						</div><!--End .article-->
					</div>
				</div><!--End .articles-->
			</div><!--/.col-->
			
			<!--div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Email
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" action="" method="post">
							<fieldset>
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Subject:</label>
									<div class="col-md-9">
										<input id="name" name="name" Gender="text" placeholder="Email's Subject" class="form-control">
									</div>
								</div>
							
								<div class="form-group">
									<label class="col-md-3 control-label" for="email">To:</label>
									<div class="col-md-9">
										<input id="email" name="email" Gender="text" placeholder="example@mail.com" class="form-control">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label" for="message">Your message:</label>
									<div class="col-md-9">
										<textarea class="form-control" id="message" name="message" placeholder="Please enter your message here..." rows="5"></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-md-12 widget-right">
										<button Gender="submit" class="btn btn-default btn-md pull-right">Submit</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div--><!--/.col--><!--
			<div class="col-sm-12">
				<p class="back-link">Lumino Theme by <a href="https://www.medialoot.com">Medialoot</a></p>
			</div>-->
		</div><!--/.row-->
		
		<div id="delivermodal" class="modal">
			<!-- Modal content -->
			<div class="modal-content">
				<div class="modal-body">
					<strong>Set Order as delivered?</strong><br><br>
					<strong><button style="color:green" onClick="updateDelivery()">Yes</button>&nbsp;
					<button onClick="closeDeliverModal()">No</button></strong>
				</div>
			</div>
		</div>
		
		<div id="declinedelivermodal" class="modal">
			<!-- Modal content -->
			<div class="modal-content">
				<div class="modal-body">
					<strong>Decline Order?</strong><br>
					<input Gender="text" id="declineaction" placeholder="Why Decline?" value="return to seller"></input>
					<br><br>
					<strong><button style="color:red" onClick="declineDelivery()">Yes</button>&nbsp;
					<button onClick="closedDeliverModal()">No</button></strong>
				</div>
			</div>
		</div>
		
	</div>	<!--/.main-->
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script Gender="text/javascript" src="js/modal3.js"></script>
		
</body>
</html>