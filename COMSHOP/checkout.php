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
	
	$username = $_SESSION['username'];
	$getuserdetails = "SELECT * FROM users WHERE username='$username'";
	$udresult = mysqli_query($conn, $getuserdetails);
	
	if (mysqli_num_rows($udresult) > 0)
	{
		while($udRow = mysqli_fetch_assoc($udresult))
		{
			$udEmail = $udRow['email'];
			$udPhone = $udRow['phone'];
			$udFname = $udRow['fname'];
			$udLname = $udRow['lname'];
		}
	}
	
	$stockerror = 0;
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

<link href='//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

</head>
	
<body>
<!-- header -->
	<?php include 'topnav.php';
	
	$deliverycharge = 0;
	
	$checkoutquery = mysqli_query($conn,$cartsql);
	$checkoutquery2 = mysqli_query($conn,$cartsql);
	
	?>
<!-- //header -->
<!-- products-breadcrumb -->
	<div class="products-breadcrumb">
		<div class="container">
			<ul>
				<li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Home</a><span>|</span></li>
				<li>Checkout</li>
			</ul>
		</div>
	</div>
<!-- //products-breadcrumb -->
<!-- banner -->
	<div class="banner">
		<?php include 'sidenav.php';?>
		<div class="w3l_banner_nav_right">
<!-- about -->
		<div class="privacy about">
			<h3>Chec<span>kout</span></h3>
			
	      <div class="checkout-right">
				<table class="timetable_sub">
					<thead>
						<tr>
							<th>SL No.</th>	
							<th>Product</th>
							<th>Quantity</th>
							<th>Product Name</th>
						
							<th>Price</th>
							<!--th>Remove</th-->
						</tr>
					</thead>
					<tbody>
					<?php
					if (mysqli_num_rows($checkoutquery) > 0)
					{
						$totalprice = 0;
						$count = 0;
						while($coRow = mysqli_fetch_assoc($checkoutquery))
						{
							$count = $count + 1;
							echo'
							<tr class="rem1">
								<td class="invert">'.$count.'</td>
								<td class="invert-image"><a href="single.php?productid='.$coRow['productid'].'"><img src="images/items/';
									$picsql = 'SELECT picture FROM `items` WHERE ID='.$coRow['productid'];
									$picquery = mysqli_query($conn,$picsql);
									if (mysqli_num_rows($picquery) > 0)
									{
										while($picRow = mysqli_fetch_assoc($picquery))
										{
											echo $picRow['picture'];
										}
									}
								echo'" alt=" " style="height:100px;width:auto" class="img-responsive"></a></td>
								<!--td class="invert">
									<div class="quantity"> 
										<div class="quantity-select">                           
											<div class="entry value-minus">&nbsp;</div>
											<div class="entry value"><span>'.$coRow['quantity'].'</span></div>
											<div class="entry value-plus active">&nbsp;</div>
										</div>
									</div>
								</td-->
								<td class="invert">';
								
								$stock = 0;
								$stocksql = 'SELECT stock FROM `items` WHERE ID='.$coRow['productid'];
								$stockquery = mysqli_query($conn,$stocksql);
								if (mysqli_num_rows($stockquery) > 0)
								{
									while($stockRow = mysqli_fetch_assoc($stockquery))
									{
										$stock = $stockRow['stock'];
									}
								}
								
								$quan = $coRow['quantity'];
								
								if($quan>$stock)
								{
									echo '<span style="color:red">'.$coRow['quantity'].' (Stock: '.$stock.')</span>';
									$stockerror = 1;
								}
								else
								{
									echo $coRow['quantity'].' (Stock: '.$stock.')';
								}
								
								echo '</td>
								<td class="invert">'.$coRow['productname'].'</td>
								
								<td class="invert">Php'.$coRow['totalprice'].'.00</td>
								<!--td class="invert">
									<div class="rem">
										<div class="close1"> </div>
									</div>
								</td-->
							</tr>';
							
							$totalprice += $coRow['totalprice'];
						}
					}
					?>
					</tbody>
				</table>
			</div>
			<div class="checkout-left">	
				<div class="col-md-4 checkout-left-basket">
					<h4 style="background-color:#fdba2d">Basket</h4>
					<ul>
						<li>SubTotal <i>-</i> <span><?php if($totalprice<2000){echo'<span style="color:red">Php '.$totalprice.'.00</span>';}else{echo 'Php '.$totalprice.'.00';}?></span></li>
						<li>Service Charge <i>-</i>
							<span>
								<?php
									if($totalprice > 2000)
									{
										if($totalprice<6000)
										{
											$deliverycharge = 300;
											echo 'Php '.$deliverycharge.'.00';
										}
										else
										{
											$deliverycharge = 0;
											echo 'Free';
										}
									}
									else
									{
										$deliverycharge = 0;
										echo '<span style="color:red">Not Applicable</span>';
									}
								?>
							</span></li>
						<li><b>Total <i>-</i>
						<span>
							<?php
							
							$total = $totalprice+$deliverycharge;

							if($totalprice<2000)
							{
								echo'<span style="color:red">Php '.$total.'.00</span>';
							}
							else
							{
								echo 'Php '.$total.'.00';
							}
							
							?>
						</span></b>
						</li>
					</ul>
				</div>
				<div class="col-md-8 address_form_agile">
					<h4>Delivery Details</h4>
					<form <?php if($totalprice>0 && $stockerror == 0){echo'action="payment.php"';}?> method="post" class="payment-card-form agileinfo_form">
						<section class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<div class="first-row form-group">
									<div class="controls">
										<label class="control-label">Full name: </label>
										<input class="billing-address-name form-control" type="text" name="name" placeholder="Full name" value="<?php echo $udFname.' '.$udLname?>" required>
									</div>
									<div class="controls">
										<label class="control-label">Email: </label>
									 <input class="form-control" type="email" placeholder="Email" name="email" value="<?php echo $udEmail?>" required>
									</div>
									<div class="w3_agileits_card_number_grids">
										<div class="w3_agileits_card_number_grid_left">
											<div class="controls">
												<label class="control-label">Mobile number:</label>
												<input class="form-control" type="text" placeholder="Mobile number" name="phone" value="<?php echo $udPhone?>" required>
											</div>
										</div>
										<div class="w3_agileits_card_number_grid_right">
											<div class="controls">
												<label class="control-label">Landmark: </label>
											 <input class="form-control" type="text" placeholder="Landmark" name="landmark" required>
											</div>
										</div>
										<div class="clear"> </div>
									</div>
									<div class="controls">
										<label class="control-label">Course: </label>
									 <input class="form-control" type="text" placeholder="Course" name="course" required>
									</div>
									<div class="controls">
										<label class="control-label">Year & Section: </label>
									 <input class="form-control" type="text" placeholder="Year & Section" name="yearsection" required>
									</div>
									<div class="controls">
										<label class="control-label">Gender: </label>
										<select class="form-control option-w3ls" style="height:50px" name="gender" required>
											<option>Male</option>
											<option>Female</option>
											<option>Others</option>
										</select>
									</div>
								</div>
								<button name="pay" class="submit check_out">Payment Methods</button>
							</div>
						</section>
					</form>
				</div>
				<div class="clearfix">
				</div>
			</div>
		</div>
<!-- //about -->
	</div>
	<div class="clearfix"></div>
</div>
<!-- footer -->
	<?php include 'footer.php';?>
<!-- //footer -->
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
<!--quantity-->
<script>
	$('.value-plus').on('click', function(){
		var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
		divUpd.text(newVal);
	});

	$('.value-minus').on('click', function(){
		var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
		if(newVal>=1) divUpd.text(newVal);
	});
</script>
<!--quantity-->
<script>$(document).ready(function(c) {
	$('.close1').on('click', function(c){
		$('.rem1').fadeOut('slow', function(c){
			$('.rem1').remove();
			});
		});	  
	});
</script>
<script>$(document).ready(function(c) {
	$('.close2').on('click', function(c){
		$('.rem2').fadeOut('slow', function(c){
			$('.rem2').remove();
			});
		});	  
	});
</script>
<script>$(document).ready(function(c) {
	$('.close3').on('click', function(c){
		$('.rem3').fadeOut('slow', function(c){
			$('.rem3').remove();
			});
		});	  
	});
</script>

<!-- //js -->
<!-- script-for sticky-nav -->
	<script>
	$(document).ready(function() {
		 var navoffeset=$(".agileits_header").offset().top;
		 $(window).scroll(function(){
			var scrollpos=$(window).scrollTop(); 
			if(scrollpos >=navoffeset){
				$(".agileits_header").addClass("fixed");
			}else{
				$(".agileits_header").removeClass("fixed");
			}
		 });
		 
	});
	</script>
<!-- //script-for sticky-nav -->
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
</body>
</html>