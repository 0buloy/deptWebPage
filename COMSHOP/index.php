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
	
	if(isset($_GET['created']))
	{
		echo
		'
		<div class="omodal">
			<div class="modal-content">
				<div class="modal-body" align="center">
					<strong style="color:green">Welcome to <span style="color:#027dc3">Com</span><span style="color:#7aa874">Shop</span>!<br>Happy Shopping!</strong><br><br>
					<strong><a href="index.php">Ok</a></strong>
				</div>
			</div>
		</div>
		';
	}
	
	if(isset($_GET['transact']))
	{
		echo
		'
		<div class="omodal">
			<div class="modal-content">
				<div class="modal-body" align="center">
					<strong style="color:green">Thank you!</strong>
					<br><br>
					<strong><a href="index.php">Ok</a></strong>
				</div>
			</div>
		</div>
		';
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>ComShop</title>
	<link rel="shortcut icon" href="images/icons/shoplogo.png"/>
	<!-- for-mobile-apps -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
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
<!--Breadcrumb-->
	<?php
	if(isset($_GET['category']))
	{
		echo'
		<div class="products-breadcrumb">
			<div class="container">
				<ul>
					<li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Home</a><span>|</span></li>
					<li>'.$_GET['category'].'</li>
				</ul>
			</div>
		</div>';
	}
	else if(isset($_GET['search']))
	{
		echo'
		<div class="products-breadcrumb">
			<div class="container">
				<ul>
					<li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Home</a><span>|</span></li>
					<li>Search for \''.$_GET['search'].'\'</li>
				</ul>
			</div>
		</div>';
	}
	else if(isset($_GET['pricea']))
	{
		echo'
		<div class="products-breadcrumb">
			<div class="container">
				<ul>
					<li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Home</a><span>|</span></li>
					<li>Product Range: '.$_GET['priceb'].' to ';if($_GET['pricea']=="")echo'anything';else echo $_GET['pricea']; echo'</li>
				</ul>
			</div>
		</div>';
	}
	?>
<!--//Breadcrumb-->
<!-- banner -->
	<?php include 'sidenav.php';?>
	
	<?php
	if(isset($_GET['category']))
	{
		$categoryname = $_GET['category'];
		$itemQuery = "SELECT * FROM `items` WHERE category='$categoryname'";
		if($_GET['category']=="All Products")
			$itemQuery = "SELECT * FROM `items` ORDER BY name";
		$itemResult = mysqli_query($conn ,$itemQuery);
		
		echo'
		<div class="banner">
			<div class="w3l_banner_nav_right">
				<!--div class="w3l_banner_nav_right_banner10">
					<h3>Best Deals For New Products<span class="blink_me"></span></h3>
				</div--><br><br>
				<div class="w3ls_w3l_banner_nav_right_grid w3ls_w3l_banner_nav_right_grid_veg">
					<h3 class="w3l_fruit">
						'.$_GET['category'].'
					</h3>
					<div class="w3ls_w3l_banner_nav_right_grid1 w3ls_w3l_banner_nav_right_grid1_veg">';
					
					if (mysqli_num_rows($itemResult) > 0)
					{
						while($itemRow = mysqli_fetch_assoc($itemResult))
						{
							echo'
							<div class="col-md-3 w3ls_w3l_banner_left w3ls_w3l_banner_left_asdfdfd"><!--DUPLICATE-->
								<div class="hover14 column">
									<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
										<div class="agile_top_brand_left_grid_pos">
											<img src="images/offer.png" alt=" " class="img-responsive" />
										</div>
										<div class="agile_top_brand_left_grid1">
											<figure>
												<div class="snipcart-item block">
													<div class="snipcart-thumb">
														<a href="single.php?productid='.$itemRow['ID'].'">
															<img src="images/items/'.$itemRow['picture'].'" style="height:195px;width:auto" alt=" " class="img-responsive" />
														</a>
														<p style="height:50px">'.$itemRow['name'].'</p>
														<h4>Php '.$itemRow['price'].'.00</h4>
													</div>
													<div class="snipcart-details">
														<form action="single.php?productid='.$itemRow['ID'].'" method="post">
															<fieldset>
																<input type="hidden" name="item_id" value="'.$itemRow['ID'].'" />
																<input type="hidden" name="cmd" value="_cart" />
																<input type="hidden" name="add" value="1" />
																<input type="hidden" name="business" value=" " />
																<input type="hidden" name="item_name" value="'.$itemRow['name'].'" />
																<input type="hidden" name="amount" value="'.$itemRow['price'].'" />
																<input type="hidden" name="discount_amount" value="0.00" />
																<input type="hidden" name="currency_code" value="PHP" />
																<input type="hidden" name="return" value=" " />
																<input type="hidden" name="cancel_return" value=" " />
																<input type="submit" name="submit" value="View Item" class="button" />
															</fieldset>
														</form>
													</div>
												</div>
											</figure>
										</div>
									</div>
								</div>
							</div><!--DUPLICATE-->';
						}
					}
					
					echo'
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>';
	}
	else if(isset($_GET['search']))
	{
		$searchterm = $_GET['search'];
		
		$searchQuery = "SELECT * FROM `items` WHERE name LIKE '%$searchterm%'";
		$searchResult = mysqli_query($conn ,$searchQuery);
		
		echo'
		<div class="banner">
			<div class="w3l_banner_nav_right">
				<!--div class="w3l_banner_nav_right_banner10">
					<h3>Best Deals For New Products<span class="blink_me"></span></h3>
				</div><br><br-->
				<div class="w3ls_w3l_banner_nav_right_grid w3ls_w3l_banner_nav_right_grid_veg">
					<h3 class="w3l_fruit">
						SEARCH RESULTS FOR \''.$searchterm.'\'
					</h3>
					<div class="w3ls_w3l_banner_nav_right_grid1 w3ls_w3l_banner_nav_right_grid1_veg">';
					
					if (mysqli_num_rows($searchResult) > 0)
					{
						while($itemRow = mysqli_fetch_assoc($searchResult))
						{
							echo'
							<div class="col-md-3 w3ls_w3l_banner_left w3ls_w3l_banner_left_asdfdfd" ><!--DUPLICATE-->
								<div class="hover14 column">
									<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
										<div class="agile_top_brand_left_grid_pos">
											<img src="images/offer.png" alt=" " class="img-responsive" />
										</div>
										<div class="agile_top_brand_left_grid1">
											<figure>
												<div class="snipcart-item block">
													<div class="snipcart-thumb">
														<a href="single.php?productid='.$itemRow['ID'].'">
															<img src="images/items/'.$itemRow['picture'].'" style="height:195px;width:auto" alt=" " class="img-responsive" />
														</a>
														<p style="height:50px">'.$itemRow['name'].'</p>
														<h4>Php '.$itemRow['price'].'.00</h4>
													</div>
													<div class="snipcart-details">
														<div class="snipcart-details">
														<form action="single.php?productid='.$itemRow['ID'].'" method="post">
															<fieldset>
																<input type="hidden" name="item_id" value="'.$itemRow['ID'].'" />
																<input type="hidden" name="cmd" value="_cart" />
																<input type="hidden" name="add" value="1" />
																<input type="hidden" name="business" value=" " />
																<input type="hidden" name="item_name" value="'.$itemRow['name'].'" />
																<input type="hidden" name="amount" value="'.$itemRow['price'].'" />
																<input type="hidden" name="discount_amount" value="0.00" />
																<input type="hidden" name="currency_code" value="PHP" />
																<input type="hidden" name="return" value=" " />
																<input type="hidden" name="cancel_return" value=" " />
																<input type="submit" name="submit" value="View Item" class="button" />
															</fieldset>
														</form>
													</div>
													</div>
												</div>
											</figure>
										</div>
									</div>
								</div>
							</div><!--DUPLICATE-->';
						}
					}
					
					echo'
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>';
	}
	else if(isset($_GET['pricea']))
	{
		$lessthan = $_GET['pricea'];
		$greaterthan = $_GET['priceb'];
		
		if($lessthan=='')
		{
			$searchQuery = "SELECT * FROM `items` WHERE price>=$greaterthan";
		}
		else
		{
			$searchQuery = "SELECT * FROM `items` WHERE price>=$greaterthan AND price<$lessthan";
		}
		$searchResult = mysqli_query($conn ,$searchQuery);
		
		echo'
		<div class="banner">
			<div class="w3l_banner_nav_right">
				<!--div class="w3l_banner_nav_right_banner10">
					<h3>Best Deals For New Products<span class="blink_me"></span></h3>
				</div><br><br-->
				<div class="w3ls_w3l_banner_nav_right_grid w3ls_w3l_banner_nav_right_grid_veg">
					<h3 class="w3l_fruit">
						Product Range: '.$_GET['priceb'].' to ';if($_GET['pricea']=="")echo'anything';else echo $_GET['pricea']; echo'
					</h3>
					<div class="w3ls_w3l_banner_nav_right_grid1 w3ls_w3l_banner_nav_right_grid1_veg">';
					
					if (mysqli_num_rows($searchResult) > 0)
					{
						while($itemRow = mysqli_fetch_assoc($searchResult))
						{
							echo'
							<div class="col-md-3 w3ls_w3l_banner_left w3ls_w3l_banner_left_asdfdfd" ><!--DUPLICATE-->
								<div class="hover14 column">
									<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
										<div class="agile_top_brand_left_grid_pos">
											<img src="images/offer.png" alt=" " class="img-responsive" />
										</div>
										<div class="agile_top_brand_left_grid1">
											<figure>
												<div class="snipcart-item block">
													<div class="snipcart-thumb">
														<a href="single.php?productid='.$itemRow['ID'].'">
															<img src="images/items/'.$itemRow['picture'].'" style="height:195px;width:auto" alt=" " class="img-responsive" />
														</a>
														<p style="height:50px">'.$itemRow['name'].'</p>
														<h4>Php '.$itemRow['price'].'.00</h4>
													</div>
													<div class="snipcart-details">
														<div class="snipcart-details">
														<form action="single.php?productid='.$itemRow['ID'].'" method="post">
															<fieldset>
																<input type="hidden" name="item_id" value="'.$itemRow['ID'].'" />
																<input type="hidden" name="cmd" value="_cart" />
																<input type="hidden" name="add" value="1" />
																<input type="hidden" name="business" value=" " />
																<input type="hidden" name="item_name" value="'.$itemRow['name'].'" />
																<input type="hidden" name="amount" value="'.$itemRow['price'].'" />
																<input type="hidden" name="discount_amount" value="0.00" />
																<input type="hidden" name="currency_code" value="PHP" />
																<input type="hidden" name="return" value=" " />
																<input type="hidden" name="cancel_return" value=" " />
																<input type="submit" name="submit" value="View Item" class="button" />
															</fieldset>
														</form>
													</div>
													</div>
												</div>
											</figure>
										</div>
									</div>
								</div>
							</div><!--DUPLICATE-->';
						}
					}
					
					echo'
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>';
	}
	else
	{
		echo'
		<div class="banner">
			<div class="w3l_banner_nav_right">
				<section class="slider">
					<div class="flexslider">
						<ul class="slides">
							<li>
								<div class="w3l_banner_nav_right_banner">
									<h3> 	</h3>
									<div class="more">
										<a href="?category=All Products" class="button--saqui button--round-l button--text-thick" data-text="Shop now">Shop now</a>
									</div>
								</div>
							</li>
							<li>
								<div class="w3l_banner_nav_right_banner1">
									<div class="more">
										<a href="?category=All Products" class="button--saqui button--round-l button--text-thick" data-text="Shop now">Shop now</a>
									</div>
								</div>
							</li>
							<li>
								<div class="w3l_banner_nav_right_banner2">
									<div class="more">
										<a href="?category=All Products" class="button--saqui button--round-l button--text-thick" data-text="Shop now">Shop now</a>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</section>
				<!-- flexSlider -->
					<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
					<script defer src="js/jquery.flexslider.js"></script>
					<script type="text/javascript">
					$(window).load(function(){
					  $(".flexslider").flexslider({
						animation: "slide",
						start: function(slider){
						  $("body").removeClass("loading");
						}
					  });
					});
				  </script>
				<!-- //flexSlider -->
			</div>
			<div class="clearfix"></div>
		</div>
	<!-- banner -->
		<div class="banner_bottom">
				<div class="wthree_banner_bottom_left_grid_sub">
				</div>
				<div class="wthree_banner_bottom_left_grid_sub1">
					<div class="col-md-4 wthree_banner_bottom_left">
						<div class="wthree_banner_bottom_left_grid">
							<img src="images/4.jpg" alt=" " class="img-responsive" />
						</div>
					</div>
					<div class="col-md-4 wthree_banner_bottom_left">
						<div class="wthree_banner_bottom_left_grid">
							<img src="images/5.jpg" alt=" " class="img-responsive" />
						</div>
					</div>
					<div class="col-md-4 wthree_banner_bottom_left">
						<div class="wthree_banner_bottom_left_grid">
							<img src="images/6.jpg" alt=" " class="img-responsive" />
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
		</div>
	
	<!-- fresh-vegetables -->
		<div class="fresh-vegetables">
			<div class="container">
				<h3>Top Products</h3>
				<div class="w3l_fresh_vegetables_grids">
					<div class="col-md-3 w3l_fresh_vegetables_grid w3l_fresh_vegetables_grid_left">
						<div class="w3l_fresh_vegetables_grid2">
							<ul>
								<li><i class="fa fa-check" aria-hidden="true"></i><a href="?category=All Products">All Products</a></li>
								<li><i class="fa fa-check" aria-hidden="true"></i><a href="?category=Limited%20Items">Limited Products</a></li>
								<li><i class="fa fa-check" aria-hidden="true"></i><a href="?category=T-Shirt">T-shirts</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-9 w3l_fresh_vegetables_grid_right">
						<div class="col-md-4 w3l_fresh_vegetables_grid">
							<div class="w3l_fresh_vegetables_grid1">
								<img src="images/8.jpg" alt=" " class="img-responsive" />
							</div>
						</div>
						<div class="col-md-4 w3l_fresh_vegetables_grid">
							<div class="w3l_fresh_vegetables_grid1">
								<div class="w3l_fresh_vegetables_grid1_rel">
									<img src="images/7.jpg" alt=" " class="img-responsive" />
									<div class="w3l_fresh_vegetables_grid1_rel_pos">
										<div class="more m1">
											<a href="index.php?category=All Products" class="button--saqui button--round-l button--text-thick" data-text="Shop now">Shop now</a>
										</div>
									</div>
								</div>
							</div>
							<div class="w3l_fresh_vegetables_grid1_bottom">
								<img src="images/10.jpg" alt=" " class="img-responsive" />
							</div>
						</div>
						<div class="col-md-4 w3l_fresh_vegetables_grid">
							<div class="w3l_fresh_vegetables_grid1">
								<img src="images/9.jpg" alt=" " class="img-responsive" />
							</div>
							<div class="w3l_fresh_vegetables_grid1_bottom">
								<img src="images/11.jpg" alt=" " class="img-responsive" />
							</div>
						</div>
						<div class="clearfix"> </div>
						<div class="agileinfo_move_text">
							<div class="agileinfo_breaking_news">
								<span> </span>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>';
	}
	?>
	<br><br>
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
</php>
