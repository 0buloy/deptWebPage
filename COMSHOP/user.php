<?php
	session_start();
	
	include 'db.php';
	
	if(empty($_SESSION['logged']))
	{
		$_SESSION['logged']="";
	}
	
	if($_SESSION['logged'] != "logged")
	{
		header('Location: login.php');
	}
	
	if(empty($_SESSION['username']))
	{
		$_SESSION['username']="";
	}
	
	$uusername=$_SESSION['username'];
	
	//GET FROM USER
	$usql = "SELECT * FROM `users` WHERE username='$uusername'";
	$uquery = mysqli_query($conn,$usql);
	
	$uFName = "";
	$uLName = "";
	$uEmail = "";
	$uCompany = "";
	
	if (mysqli_num_rows($uquery) > 0)
	{
		while($uRow = mysqli_fetch_assoc($uquery))
		{
			$uFName = $uRow['fname'];
			$uLName = $uRow['lname'];
			$uEmail = $uRow['email'];
			$uCompany = $uRow['company'];
		}
	}
	
	//GET FROM delivery success
	$adeliverysql = "SELECT * FROM `delivery` WHERE username='$uusername' AND status='onroute' ORDER BY ID DESC";
	$adeliveryquery = mysqli_query($conn,$adeliverysql);
	
	//GET FROM delivery completed
	$bdeliverysql = "SELECT * FROM `delivery` WHERE username='$uusername' AND status='delivered' ORDER BY ID DESC";
	$bdeliveryquery = mysqli_query($conn,$bdeliverysql);
	
	//GET FROM delivery canceled
	$cdeliverysql = "SELECT * FROM `delivery` WHERE username='$uusername' AND status='canceled' ORDER BY ID DESC";
	$cdeliveryquery = mysqli_query($conn,$cdeliverysql);
	
	// //GET FROM rewards
	// $getrewards = "SELECT * FROM `rewards` WHERE username='$uusername'";
	// $getrewardsquery = mysqli_query($conn,$getrewards);
?>

<!DOCTYPE html>
<html>
<head>
<title>ComShop</title>
<link rel="shortcut icon" href="images/icons/shoplogo.png"/>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Grocery Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet" type="text/css" media="all" /> 
<!-- //font-awesome icons -->
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
</head>
	
<body>
<!-- header -->
	<?php include 'topnav.php';?>
<!-- //header -->
<!-- products-breadcrumb -->
	<div class="products-breadcrumb">
		<div class="container">
			<ul>
				<li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Home</a><span>|</span></li>
				<li>Account</li>
			</ul>
		</div>
	</div>
<!-- //products-breadcrumb -->
<!-- banner -->
	<div class="banner">
		
		<?php include 'sidenav.php';?>
		
		<div class="w3l_banner_nav_right">
			<div class="privacy about">
				<h3>Acc<span>ount</span></h3>
			</div>
			<div>
			<?php
				echo'
				<h2><strong>'.$uLName.',</strong> '.$uFName.'</h2>
				<h3>'.$uCompany.'</h3>
				<p style="margin-top:4px">'.$uusername.' &nbsp; | &nbsp; '.$uEmail.'</p>
				';
			?>
			</div>
			
			<br><br>
			<div>
				<h3>To Be Received</h3>
				<table class="table table-hover">
					<thead>
						<tr>
						  <th>Date</th>
						  <th>Time</th>
						  <th>Product(s)</th>
						  <th>Status</th>
						  <th>To Pay</th>
						  <th>Delivery Charge</th>
						</tr>
					</thead>
					<tbody>
					<?php
					if (mysqli_num_rows($adeliveryquery) > 0)
					{
						while($adeliveryRow = mysqli_fetch_assoc($adeliveryquery))
						{
							echo'
								<tr>
									<td>'.$adeliveryRow['date'].'</td>
									<td>'.$adeliveryRow['time'].'</td>
									<td>';
									
									$delitemssql = "SELECT * FROM deliveryitems WHERE deliveryid='".$adeliveryRow['ID']."'";
									$delitemsquery = mysqli_query($conn,$delitemssql);
									
									if (mysqli_num_rows($delitemsquery) > 0)
									{
										while($iRow = mysqli_fetch_assoc($delitemsquery))
										{
											echo $iRow['Quantity'].' '.$iRow['ItemName'].'<br>';
										}
									}
									
									echo'
									</td>
									<td>Product(s) On Route</td>
									<td>'.$adeliveryRow['payment'].'</td>
									<td>'.$adeliveryRow['fee'].'</td>
								</tr>
							';
						}
					}
					?>
					</tbody>
				</table>
			</div>
			<div>
				<h3>Completed transactions</h3>
				<table class="table table-hover">
					<thead>
						<tr>
						  <th>Date</th>
						  <th>Time</th>
						  <th>Product(s)</th>
						  <th>Status</th>
						  <th>To Pay</th>
						  <th>Delivery Charge</th>
						</tr>
					</thead>
					<tbody>
					<?php
					if (mysqli_num_rows($bdeliveryquery) > 0)
					{
						while($adeliveryRow = mysqli_fetch_assoc($bdeliveryquery))
						{
							echo'
								<tr>
									<td>'.$adeliveryRow['date'].'</td>
									<td>'.$adeliveryRow['time'].'</td>
									<td>';
									
									$delitemssql = "SELECT * FROM deliveryitems WHERE deliveryid='".$adeliveryRow['ID']."'";
									$delitemsquery = mysqli_query($conn,$delitemssql);
									
									if (mysqli_num_rows($delitemsquery) > 0)
									{
										while($iRow = mysqli_fetch_assoc($delitemsquery))
										{
											echo $iRow['Quantity'].' '.$iRow['ItemName'].'<br>';
										}
									}
									
									echo'
									</td>
									<td>Successfuly Delivered</td>
									<td>'.$adeliveryRow['payment'].'</td>
									<td>'.$adeliveryRow['fee'].'</td>
								</tr>
							';
						}
					}
					?>
					</tbody>
				</table>
			</div>
			<div>
				<h3>Unsuccessful Transactions</h3>
				<table class="table table-hover">
					<thead>
						<tr>
						  <th>Date</th>
						  <th>Time</th>
						  <th>Product(s)</th>
						  <th>Status</th>
						  <th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					if (mysqli_num_rows($cdeliveryquery) > 0)
					{
						while($adeliveryRow = mysqli_fetch_assoc($cdeliveryquery))
						{
							echo'
								<tr>
									<td>'.$adeliveryRow['date'].'</td>
									<td>'.$adeliveryRow['time'].'</td>
									<td>';
									
									$delitemssql = "SELECT * FROM deliveryitems WHERE deliveryid='".$adeliveryRow['ID']."'";
									$delitemsquery = mysqli_query($conn,$delitemssql);
									
									if (mysqli_num_rows($delitemsquery) > 0)
									{
										while($iRow = mysqli_fetch_assoc($delitemsquery))
										{
											echo $iRow['Quantity'].' '.$iRow['ItemName'].'<br>';
										}
									}
									
									echo'
									</td>
									<td>'.$adeliveryRow['status'].'</td>
									<td>'.$adeliveryRow['action'].'</td>
								</tr>
							';
						}
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
<!-- footer -->
	<?php include 'footer.php';?>
<!-- //footer -->
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {					
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
	<script src="js/modal.js"></script>
<!-- //here ends scrolling icon -->
</body>
</html>