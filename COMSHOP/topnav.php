<?php

	if(isset($_POST['search']))
	{
		$product = $_POST['Product'];
		
		header('Location: index.php?search='.$product.'');
	}
	
	if(isset($_POST['pricerange']))
	{
		$lessthan = $_POST['lessthan'];
		$greaterthan = $_POST['greaterthan'];
		
		header('Location: index.php?pricea='.$lessthan.'&priceb='.$greaterthan.'');
	}
	/*
	if(isset($_GET['updatecart']))
	{
		$pid = $_GET['updatecart'];
		$username = $_SESSION['username'];
		
		$quan = $_GET['quanvalue'];
		
		$addCartSql = "UPDATE cart SET quantity='".$quan."' WHERE productid='$pid' AND username='$username'";
		$addQuery = mysqli_query($conn, $addCartSql);
		
		$fileurl = $_SERVER['REQUEST_URI'];
		
		$var = '';
		
		if (strpos($fileurl, '?updatecart') !== false)
		{
			$var = '?updatecart='.$pid.'&quanvalue='.$quan;
		}
		else
			$var = '&updatecart='.$pid.'&quanvalue='.$quan;
		
		$newurl = str_replace($var, "", $fileurl);
		
		header('Location: '.$newurl.'');
	}*/

	echo'
	<div class="agileits_header">
		<div class="w3l_offers">
			<a href="index.php">Today\'s special Offers !</a>
		</div>
		<div class="w3l_search">
			<form method="post">
				<input type="text" name="Product" value="Search a product..." onfocus="this.value = \'\';" onblur="if (this.value == "") {this.value = "Search a product...";}" required="">
				<input type="submit" value=" " name="search">
			</form>
		</div>
		<!--div class="product_list_header">
			<form action="#" method="post" class="last">
                <fieldset>
                    <input type="hidden" name="cmd" value="_cart" />
                    <input type="hidden" name="display" value="1" />
                    <input type="submit" name="submit" value="View your cart" class="button" />
                </fieldset>
            </form>
		</div-->
		<div class="product_list_header">
            <input type="submit" onClick="showM1()" name="submit" value="View your cart" class="button" />
		</div>
		<div class="w3l_header_right">
			<ul>
				<li class="dropdown profile_details_drop">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i><span class="caret"></span></a>
					<div class="mega-dropdown-menu">
						<div class="w3ls_vegetables">
							<ul class="dropdown-menu drp-mnu">
							';
								if($_SESSION['logged'] == "logged")
								{
									echo
									'
										<li><a href="user.php">Account</a></li> 
										<li><a href="logout.php">Log out</a></li>
									';
								}
								else
								{
									echo
									'
										<li><a href="login.php">Login </a></li> 
										<li><a href="login.php">Sign Up</a></li>
									';
								}
							echo'
							</ul>
						</div>                  
					</div>	
				</li>
			</ul>
		</div>
		<div class="w3l_header_right1">
			<h2><a href="mail.php">Contact Us</a></h2>
		</div>
		<div class="clearfix"> </div>
	</div>
	
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
	
	<div class="logo_products">
		<div class="container">
			<div class="w3ls_logo_products_left">
				<h1><a href="index.php" style="color:#7aa874;font-weight:bold"><img class="logotop" style="width:50px;float:left;margin-right:10px" align="middle" src="images/icons/shoplogo.png"/>Com<span style="color:#fdba2d ">Shop</span></a></h1>
			</div>
			<div class="w3ls_logo_products_left1">
				<ul class="special_items">
					<li><a href="about.php">About Us</a><i>/</i></li>
					<li><a href="index.php">Best Deals</a><i>/</i></li>
					<li><a href="services.php">Services</a></li>
				</ul>
			</div>
			<div class="w3ls_logo_products_left1">
				<ul class="phone_email">
					<li><i class="fa fa-phone" aria-hidden="true"></i>+6391 7713 3139</li>
					<li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mail.php">comshop@gmail.com</a></li>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	
	<!--div id="m2" class="modal">
		<div class="modal-content">
			<div class="modal-header">
				<span class="c1" onClick="closeM1()">&times;</span>
			</div>
			<div class="modal-body">
				<div style="background-color:white;margin:2px 12px 2px 12px;border-radius: 7px; border: 2px solid #D3D3D3;">
					<table width="100%">
						<tr>
							<td>Product Name</td>
							<td>Product Name</td>
							<td>Product Name</td>
							<td>Product Name</td>
						</tr>
						<tr>
							<td>Product Name</td>
							<td>Product Name</td>
							<td>Product Name</td>
							<td>Product Name</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="modal-footer"></div>
		</div>
	</div-->
	';
	
	// //$rand = rand(1,8);
	// $rand = 1;
	// $countad = "SELECT * FROM ad WHERE shown='yes'";
	// $getcountresult = mysqli_query($conn ,$countad);
	
	// if (mysqli_num_rows($getcountresult) > 0)
	// {
	// 	$getad = "SELECT * FROM ad WHERE ID='".$rand."'";
	// 	$getadresult = mysqli_query($conn ,$getad);
		
	// 	if (mysqli_num_rows($getadresult) > 0)
	// 	{
	// 		while($adRow = mysqli_fetch_assoc($getadresult))
	// 		{
	// 			if($adRow['shown']=="yes"){
	// 				echo'
	// 				<div class="addivcont" align="center">
	// 					<a href="'.$adRow['link'].'" target="_blank">
	// 						<div class="addiv" style="background-image: url(\'images/ad/'.$adRow['picture'].'\')">
	// 						</div>
	// 					</a>
	// 				</div>';
	// 			}
	// 		}
	// 	}
	// }

include 'cart.php';

?>