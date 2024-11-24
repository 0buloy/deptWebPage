<?php
	session_start();

	if($_SESSION['admin']!="admin")
	{
		header('Location: login/');
	}
	
	include 'db.php';
	
	//GET user
	$uQuery = "SELECT * FROM `adminacc`";
	$uResult = mysqli_query($conn ,$uQuery);
	
	$duname = "";
	$dpass = "";
	
	$passvar = "*";
	$hiddenpass = "";
	
	if (mysqli_num_rows($uResult) > 0)
	{
		while($uRow = mysqli_fetch_assoc($uResult))
		{
			$duname = $uRow["user"];
			$dpass = $uRow["pass"];
		}
	}
	
	$z = strlen($dpass);
	$x = 1;
	
	while($x <= $z)
	{
		$hiddenpass = $hiddenpass." ".$passvar;
		$x+=1;
	};
	
	//CHANGE
	if(isset($_POST['changeacc']))
	{
		$varu = $_POST['nuname'];
		$varp = $_POST['npass'];
		$varcp = $_POST['ncpass'];
		
		$varop = $_POST['opass'];
		
		if($varp==$varcp && $varop==$dpass)
		{
			$accSql = "UPDATE adminacc SET user='".$varu."', pass='".$varp."' WHERE id=1";
			$accQry = mysqli_query($conn, $accSql);
			
			echo'<div class="omodal">
					<!-- Modal content -->
					<div class="modal-content" style="border: none">
						<div class="modal-body" style="background-color:#77dd77">
							<h4><strong>Password Changed Successfully! </strong></h4>
							<form method="post" action="?">
								<span style="width:100%" align="right">
									<button name="reload">Ok</button>
								</span>
							</form>
						</div>
					</div>
				</div>';
		}
		else
		{
			echo'<div id="failm" class="omodal">
					<!-- Modal content -->
					<div class="modal-content" style="border: none">
						<div class="modal-body" style="background-color:#ff6961">
							<h4><strong>Password does not match! </strong></h4>
							<form method="post" action="?">
								<span style="width:100%" align="right">
									<button name="reload">Ok</button>
								</span>
							</form>
						</div>
					</div>
				</div>';
		}
		
		//header('Location: ../smwa/account.php');
	}
	
	if(isset($_POST['closem']))
	{
		header('Location: account.php');
	}
	
	if(isset($_POST['reload']))
	{
		header('Location: account.php');
	}
	/*
	//GET From Notifs
	$nQuery = "SELECT * FROM `notifications`";
	$nResult = mysqli_query($conn ,$nQuery);
	
	$count = 0;
	
	$nName = "";
	$nDate = "";
	$nTime = "";
	
	if (mysqli_num_rows($nResult) > 0)
	{
		while($nRow = mysqli_fetch_assoc($nResult))
		{
			$count=$count+1;
			$nName = $nRow['name'];
			$nDate = $nRow['date'];
			$nTime = $nRow['time'];
		}
	}
	
	//CLEAR Notifs
	if(isset($_GET['clear']))
	{
		$ndelsql = "DELETE FROM notifications";
		$ndelquery = mysqli_query($conn,$ndelsql);
		
		header('Location: messages.php');
	}*/
?>
<!DOCTYPE html>
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
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	
	<style>
	table {
		border-collapse: collapse;
		color:black;
	}

	td, th {
		text-align: left;
		padding: 8px;
	}

	h3{
		padding-top:20px;
	}
	table
	{
		margin-bottom:10px;
	}
	
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
		width: 60%;
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
				<li class="active">Account</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">ADMIN Account Settings</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row" style="padding:0px 10px 5px 10px;">
			<h3>Change Username/Password</h3>
			<table width="50%">
				<tr>
					<td>Username:</td><td><?php echo $duname ?></td>
				</tr>
				<tr>
					<td>Password:</td><td><?php echo $hiddenpass ?></td>
				</tr>
				<tr>
					<td><button onClick="showAccModal()" style="width:70%">Change</button></td><td></td>
				</tr>
				<tr>
					<td id="a"></td><td id="b"></td>
				</tr>
			</table>
		</div><!--/.row-->
		
		<div id="accountm" class="modal">
			<!-- Modal content -->
			<div class="modal-content">
				<div class="modal-header">
					<span class="closemodal" onClick="closeAccModal()" style="cursor: pointer;">&times;</span>
					<h4>Change Password<span id="added"></span></h4>
				</div>
				<div class="modal-body">
					<form method="post" action="?">
						New Username:<br><input id="nuname" name="nuname" type="text" style="width:80%" value=""><br><br>
						Old Password:<br><input id="opass" name="opass" type="password" style="width:80%" value=""><br><br>
						New Password:<br><input id="npass" name="npass" type="password" style="width:80%" value=""><br><br>
						Confirm Password:<br><input id="ncpass" name="ncpass" type="password" style="width:80%" value=""><br><br>
						<span style="width:100%" align="right">
							<button name="changeacc">Save</button>
							<button onClick="closeAccModal()">Cancel</button>
						</span>
					</form>
				</div>
				<div class="modal-footer">
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
	
	<script type="text/javascript" src="js/modal3.js"></script>
		
</body>
</html>