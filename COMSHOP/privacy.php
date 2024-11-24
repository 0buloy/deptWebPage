<?php
	session_start();
	
	include 'db.php';
	
	if(empty($_SESSION['logged']))
	{
		$_SESSION['logged']="";
	}
	
	if($_SESSION['logged'] != "logged")
	{
		$_SESSION['logged']="";
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
				<li>Privacy Policy & Terms of Use</li>
			</ul>
		</div>
	</div>
<!-- //products-breadcrumb -->
<!-- banner -->
	<div class="banner">
		<?php include 'sidenav.php';?>
		<div class="w3l_banner_nav_right">
<!-- privacy -->
		<div class="privacy">
			<div class="privacy1">
				<h3>Privacy Policy</h3>
				<div class="banner-bottom-grid1 privacy1-grid">
					<ul>
						<li><i class="glyphicon glyphicon-user" aria-hidden="true"></i></li>
						<li>Profile <span>Content to be added</span></li>
					</ul>
					<ul>
						<li><i class="glyphicon glyphicon-search" aria-hidden="true"></i></li>
						<li>Search <span>Content to be added</span></li>
					</ul>
					<ul>
						<li><i class="glyphicon glyphicon-paste" aria-hidden="true"></i></li>
						<li>News Feed <span>Content to be added</span></li>
					</ul>
					<ul>
						<li><i class="glyphicon glyphicon-qrcode" aria-hidden="true"></i></li>
						<li>Applications <span>Content to be added</span></li>
					</ul>
				</div>
			</div>
			<div class="privacy1">
				<h3>Terms of Use</h3>
				<div class="banner-bottom-grid1 privacy2-grid">
					<div class="privacy2-grid1">
						<h4>ComShop Terms and Conditions</h4>

						</div>
						<div class="privacy2-grid1-sub">
						 <h4>• 	Eligibility </h4> <br>
							<p style="font-size: 14px;"> You must be at least 18 years old and an official member of The PUP STB Computer Society Organization to use this website.</p>
						</div>
						<div class="privacy2-grid1-sub">
							<h4>• 	Account Registration</h4>
							<p>You may need to create an account to access certain features or make purchases. You are responsible for maintaining the confidentiality of your account information.</p>
						</div>
						<div class="privacy2-grid1-sub">
							<h4>• 	Prohibited Activities </h4>
							<p>Do not violate laws, engage in fraudulent activities, impersonate others, interfere with the website's operation, or transmit harmful code.</p>
						</div>
						<div class="privacy2-grid1-sub">
							<h4>• 	Intellectual Property</h4>
							<p>All website content, trademarks, and logos are the property of the website owner. You may not use or distribute any content without permission.</p>
						</div>
						<div class="privacy2-grid1-sub">
							<h4>• 	Product Information and Pricing</h4>
							<p>We strive for accuracy but do not guarantee it. Prices and product details are subject to change without notice.</p>
						</div>
						<div class="privacy2-grid1-sub">
							<h4>• 	Limitation of Liability:</h4>
							<p>We do not warrant the website's accuracy or availability. We are not liable for any damages arising from your use of the website</p>
						</div>
						<div class="privacy2-grid1-sub">
							<h4>• 	Indemnification</h4>
							<p>You agree to indemnify and hold us harmless from any claims or losses arising from your use of the website.</p>
						</div>	
					</div>
				</div>
			</div>
		</div>
<!-- //privacy -->
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