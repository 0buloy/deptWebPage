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
				<li>Services</li>
			</ul>
		</div>
	</div>
<!-- //products-breadcrumb -->
<!-- banner -->
	<div class="banner">
		<?php include 'sidenav.php';?>
		<div class="w3l_banner_nav_right">
<!-- services -->
		<div class="services">
			<h3>Services</h3>
			<div class="w3ls_service_grids">
				<div class="col-md-5 w3ls_service_grid_left">
					<h4>Your merch delivered!</h4>
					<p>ComShop is glad to offer efficient and fast delivery services. Our dedicated workers put a lot of effort into ensuring that your orders are sent promptly and with the highest care.</p>
				</div>
				<div class="col-md-7 w3ls_service_grid_right">
					<div class="col-md-4 w3ls_service_grid_right_1">
						<img src="images/18.jpg" alt=" " class="img-responsive" />
					</div>
					<div class="col-md-4 w3ls_service_grid_right_1">
						<img src="images/19.jpg" alt=" " class="img-responsive" />
					</div>
					<div class="col-md-4 w3ls_service_grid_right_1">
						<img src="images/20.jpg" alt=" " class="img-responsive" />
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
<!-- //services -->
		</div>
		<div class="clearfix"></div>
	</div>
<!-- services-bottom -->
	<div class="services-bottom">
		<div class="container">
			<div class="col-md-3 about_counter_left">
				<i class="glyphicon glyphicon-user" aria-hidden="true"></i>
				<p class="counter">89,147</p> 
				<h3>Followers</h3>
			</div>
			<div class="col-md-3 about_counter_left">
				<i class="glyphicon glyphicon-piggy-bank" aria-hidden="true"></i>
				<p class="counter">54,598</p> 
				<h3>Savings</h3>
			</div>
			<div class="col-md-3 about_counter_left">
				<i class="glyphicon glyphicon-export" aria-hidden="true"></i>
				<p class="counter">83,983</p> 
				<h3>Support</h3>
			</div>
			<div class="col-md-3 about_counter_left">
				<i class="glyphicon glyphicon-bullhorn" aria-hidden="true"></i>
				<p class="counter">45,894</p> 
				<h3>Popularity</h3>
			</div>
			<div class="clearfix"> </div>
			<!-- Stats-Number-Scroller-Animation-JavaScript -->
				<script src="js/waypoints.min.js"></script> 
				<script src="js/counterup.min.js"></script> 
				<script>
					jQuery(document).ready(function( $ ) {
						$('.counter').counterUp({
							delay: 10,
							time: 1000
						});
					});
				</script>
			<!-- //Stats-Number-Scroller-Animation-JavaScript -->

		</div>
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