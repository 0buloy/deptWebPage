<?php
	session_start();
	
	include 'db.php';
	
	$pid = 0;
	
	if(empty($_SESSION['logged']))
	{
		$_SESSION['logged']="";
	}
	
	if($_SESSION['logged'] != "logged")
	{
		$_SESSION['logged']="";
	}
	
	if(isset($_GET['productid']))
	{
		$pid = $_GET['productid'];
	}
	else if(isset($_GET['cart']))
	{
		if($_SESSION['logged'] != "logged")
		{
			header('Location: login.php');
		}
		else
		{
			$pid = $_GET['cart'];
			
			$username = $_SESSION['username'];
			$checkcart = "SELECT * FROM `cart` WHERE productid='$pid' AND username='$username'";
			$checkcartResult = mysqli_query($conn ,$checkcart);
			
			if (mysqli_num_rows($checkcartResult) > 0)
			{
				$quan = 0;
				
				while($checkCartRow = mysqli_fetch_assoc($checkcartResult))
				{
					$quan = $checkCartRow['quantity'];
				}
				
				$quan = $quan + 1;
				
				$addCartSql = "UPDATE cart SET quantity='".$quan."' WHERE productid='$pid' AND username='$username'";
				$addQuery = mysqli_query($conn, $addCartSql);
				
				header('Location: single.php?productid='.$pid.'&added=2');
			}
			else
			{
				$icQuery = "SELECT * FROM `items` WHERE ID='$pid'";
				$icResult = mysqli_query($conn ,$icQuery);
				
				if (mysqli_num_rows($icResult) > 0)
				{
					while($icRow = mysqli_fetch_assoc($icResult))
					{
						$icusern = $_SESSION['username'];
						$icname = $icRow['name'];
						$icquan = 1;
						$icprice = $icRow['price'];
						
						$icartSql = "INSERT INTO `cart`(`username`,`productname`,`quantity`,`price`,`totalprice`,`productid`) VALUES('$icusern','$icname','$icquan','$icprice','$icprice','$pid')";
						$icartQuery = mysqli_query($conn,$icartSql);
						
						header('Location: single.php?productid='.$pid.'&added=1');
					}
				}
			}
		}
	}
	else
	{
		header('Location: index.php');
	}
	
	if(isset($_GET['added']))
	{
		if($_GET['added']==1)
		{
			echo
			'
			<div class="omodal">
				<div class="modal-content">
					<div class="modal-body" align="center">
						<strong style="color:green">Succesfully added to <span style="color:#027dc3">Cart</span>!<br>Happy Shopping!</strong><br><br>
						<strong><a href="single.php?productid='.$_GET['productid'].'">Ok</a></strong>
					</div>
				</div>
			</div>
			';
		}
		else if($_GET['added']==2)
		{
			echo
			'
			<div class="omodal">
				<div class="modal-content">
					<div class="modal-body" align="center">
						<strong style="color:green">Succesfully updated <span style="color:#027dc3">Cart</span>!<br>Happy Shopping!</strong><br><br>
						<strong><a href="single.php?productid='.$_GET['productid'].'">Ok</a></strong>
					</div>
				</div>
			</div>
			';
		}
	}
	
	$itemQuery = "SELECT * FROM `items` WHERE ID='$pid'";
	$itemResult = mysqli_query($conn ,$itemQuery);
	$bcResult = mysqli_query($conn ,$itemQuery);
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
 <script src='js/okzoom.js'></script>
  <script>
    $(function(){
      $('#example').okzoom({
        width: 150,
        height: 150,
        border: "1px solid black",
        shadow: "0 0 5px #000"
      });
    });
  </script>
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
<?php
if (mysqli_num_rows($bcResult) > 0)
{
	while($bcRow = mysqli_fetch_assoc($bcResult))
	{
		echo'
		<div class="products-breadcrumb">
			<div class="container">
				<ul>
					<li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Home</a><span>|</span></li>
					<li><a href="index.php?category='.$bcRow['category'].'">'.$bcRow['category'].'</a><span>|</span></li>
					<li>'.$bcRow['name'].'<span>|</span></li>
				</ul>
			</div>
		</div>';
	}
}
?>
<!-- //products-breadcrumb -->
<!-- banner -->
<?php
	include 'sidenav.php';
	
	if(isset($_GET['productid']))
	{	
		if (mysqli_num_rows($itemResult) > 0)
		{
			while($itemRow = mysqli_fetch_assoc($itemResult))
			{
				echo'
				<div class="banner">
					<div class="w3l_banner_nav_right">
						<div class="agileinfo_single">
							<h5>'.$itemRow['name'].'</h5>
							<div class="col-md-4 agileinfo_single_left">
								<img id="example" src="images/items/'.$itemRow['picture'].'" alt=" " class="img-responsive" />
							</div>
							<div class="col-md-8 agileinfo_single_right">
								<div class="rating1">
									<span class="starRating">
										<input id="rating5" type="radio" name="rating" value="5">
										<label for="rating5">5</label>
										<input id="rating4" type="radio" name="rating" value="4" checked>
										<label for="rating4">4</label>
										<input id="rating3" type="radio" name="rating" value="3">
										<label for="rating3">3</label>
										<input id="rating2" type="radio" name="rating" value="2">
										<label for="rating2">2</label>
										<input id="rating1" type="radio" name="rating" value="1">
										<label for="rating1">1</label>
									</span>
								</div>
								<div class="w3agile_description">
									<h4>Description :</h4>
									<p>'.$itemRow['description'].'</p>
								</div>
								<div class="w3agile_description">
									<h4>Stock : '; $stock = $itemRow['stock']; if($stock>0)echo $itemRow['stock'];else echo '<span style="color:red">Out of Stock</span>'; echo' pcs</h4>
								</div>
								<div class="snipcart-item block">
									<div class="snipcart-thumb agileinfo_single_right_snipcart">
										<h4>Php'.$itemRow['price'].'.00</h4>
									</div>
									<div class="snipcart-details agileinfo_single_right_details">
										<form action="single.php?cart='.$itemRow['ID'].'" method="post">
											<fieldset>
												<input type="hidden" name="cmd" value="_cart" />
												<input type="hidden" name="add" value="1" />
												<input type="hidden" name="business" value=" " />
												<input type="hidden" name="item_name" value="'.$itemRow['name'].'" />
												<input type="hidden" name="amount" value="'.$itemRow['price'].'" />
												<input type="hidden" name="discount_amount" value="0" />
												<input type="hidden" name="currency_code" value="PHP" />
												<input type="hidden" name="return" value=" " />
												<input type="hidden" name="cancel_return" value=" " />
												<input type="submit" name="submit" value="Add to cart" class="button" />
											</fieldset>
										</form>
									</div>
								</div>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>';
			}
		}
		else
		{
			echo'
			<div class="banner">
				<div class="w3l_banner_nav_right">
					<div class="agileinfo_single">
						<h5>PRODUCT NOT FOUND</h5>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>';
		}
	}
?>
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