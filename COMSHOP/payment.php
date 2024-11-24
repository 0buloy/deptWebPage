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
	
	if(isset($_POST['pay']))
	{
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$landmark = $_POST['landmark'];
		$course = $_POST['course'];
		$yearsection = $_POST['yearsection'];
		$gender = $_POST['gender'];
	}
	else
	{
		header('Location: index.php');
	}
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
	<?php
	include 'topnav.php';
	$paymentquery = mysqli_query($conn,$cartsql);
	?>
<!-- //header -->
<!-- products-breadcrumb -->
	<div class="products-breadcrumb">
		<div class="container">
			<ul>
				<li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Home</a><span>|</span></li>
				<li>Payment</li>
			</ul>
		</div>
	</div>
<!-- //products-breadcrumb -->
<!-- banner -->
	<div class="banner">
		<?php include 'sidenav.php';?>
		<div class="w3l_banner_nav_right">
<!-- payment -->
		<div class="privacy about">
			<h3>Pay<span>ment</span></h3>
			
	        <div class="checkout-left">	
				
				<div class="col-md-4 checkout-left-basket">
					<h4 style="background-color:#027dc3">Basket</h4>
					<ul>
					<?php
					if (mysqli_num_rows($paymentquery) > 0)
					{
						$totalprice = 0;
						$deliverycharge = 0;
						while($coRow = mysqli_fetch_assoc($paymentquery))
						{
							echo'<li>'.$coRow['quantity'].' '.$coRow['productname'].'<i>-</i> <span>Php '.$coRow['totalprice'].'.00</span></li>';
							
							$totalprice += $coRow['totalprice'];
						}
					}
					?>
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
				
				<!--Horizontal Tab-->
				<div class="col-md-8 address_form_agile">
					<div id="parentHorizontalTab" >
						<ul style="font-size:5px; margin: 10px;" class="resp-tabs-list hor_1">
							<li>Cash on delivery (COD)</li>
						</ul>
						<div class="resp-tabs-container hor_1">
							<div>
								<div class="vertical_post check_box_agile">
									<h5>Cash On Delivery</h5>
									<p style="font-size:11px">
										<?php
											echo'
											
											'.$name.'<br>
											<i>'.$phone.'</i><br><br>
											Course: '.$course.'<br>
											Year & Section: '.$yearsection.'<br>
											Gender: '.$gender.'<br>
											Landmark: '.$landmark.'<br>
											
											';
										?>
									</p><br>
									<p>Please prepare the cash as notified by the delivery person. Thank you!</p><br>
									<form action="manipulatecart.php" method="post">
									<?php
										date_default_timezone_set("Asia/Manila");
										$pdate = date("m/d/Y");
										$ptime = date("h:i A");
										
										echo'
										<input type="hidden" name="date" value="'.$pdate.'" />
										<input type="hidden" name="time" value="'.$ptime.'" />
										<input type="hidden" name="username" value="'.$_SESSION['username'].'" />
										<input type="hidden" name="status" value="onroute" />
										<input type="hidden" name="payment" value="'.$totalprice.'" />
										<input type="hidden" name="fee" value="'.$deliverycharge.'" />
										<input type="hidden" name="fullname" value="'.$name.'" />
										<input type="hidden" name="email" value="'.$email.'" />
										<input type="hidden" name="phone" value="'.$phone.'" />
										<input type="hidden" name="landmark" value="'.$landmark.'" />
										<input type="hidden" name="course" value="'.$course.'" />
										<input type="hidden" name="yearsection" value="'.$yearsection.'" />
										<input type="hidden" name="gender" value="'.$gender.'" />
										<button name="savetodelivery" class="submit check_out">Finish Transaction</button>
										';
									?>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
	
	<!--Plug-in Initialisation-->

	<!-- // Pay -->
	
			</div>

		</div>
<!-- //payment -->
		</div>
		<div class="clearfix"></div>
	</div>

<!-- footer -->
	<?php include 'footer.php';?>
<!-- //footer -->
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
<!-- easy-responsive-tabs -->    
<link rel="stylesheet" type="text/css" href="css/easy-responsive-tabs.css " />
<script src="js/easyResponsiveTabs.js"></script>
<!-- //easy-responsive-tabs --> 
	<script type="text/javascript">
    $(document).ready(function() {
        //Horizontal Tab
        $('#parentHorizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
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