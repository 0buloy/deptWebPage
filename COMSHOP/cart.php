<?php

$total=0;

if($_SESSION['logged']=="logged")
{
	$uusername=$_SESSION['username'];
	
	$cartsql = "SELECT * FROM `cart` WHERE username='$uusername' AND productid IN ( SELECT ID FROM `items`)";
	$cartquery = mysqli_query($conn,$cartsql);
}

echo'
<div id="m" class="modal" style="z-index:1000">
	<script type = "text/javascript">
        <!--
			var checkouturl = 0;
		';
		
		$fileurl = $_SERVER['REQUEST_URI'];

		if (strpos($fileurl, 'checkout.php') !== false)
		{
			echo 'checkouturl = 1;';
		}
			
		echo'
            var counter = 0;
			var pid = 0;
			var quanvalue = 0;
        //-->
    </script>
	<div id="PPMiniCart">';
		
		if($_SESSION['logged']=="logged")
		{
			if (mysqli_num_rows($cartquery) > 0)
			{
				$count = 0;
				echo'
				<form method="post" class="" action="checkout.php" target="">
					<button type="button" onClick="if(counter==1&&checkouturl==1){location.reload();}else{closeM1();}" class="minicart-closer">×</button>
					<ul>';
						while($cartRow = mysqli_fetch_assoc($cartquery))
						{
							$count += 1;
							echo'
							<li class="minicart-item">
								<div class="minicart-details-name">
									<a class="minicart-name" href="'.$cartRow['productid'].'">
										'.$cartRow['productname'].'
									</a>
								</div>
								<div class="minicart-details-quantity">
									<input onBlur="counter=1;updatecart('.$cartRow['productid'].',this.value,\'span#cartitem'.$count.'\');" class="minicart-quantity" data-minicart-idx="0" name="quantity_1" type="text" pattern="[0-9]*" value="'.$cartRow['quantity'].'" autocomplete="off">
								</div>
								<div class="minicart-details-remove">
									<button onClick="counter=1;deletecart('.$cartRow['productid'].')" type="button" class="minicart-remove" data-minicart-idx="0">×</button>
								</div>
								<div class="minicart-details-price">
									<span id="cartitem'.$count.'" class="minicart-price">Php'.$cartRow['totalprice'].'.00</span>
								</div>
								<input type="hidden" id="inputitemtotal" name="amount" value="'.$cartRow['totalprice'].'" />
							</li>';
							$total = $total + $cartRow['totalprice'];
						}
						echo'
					</ul>
					<div class="minicart-footer">
						<input type="hidden" id="totalamount" name="amount" value="'.$total.'" />
						<div id="totaldiv" class="minicart-subtotal">
							Total: Php'.$total.'.00
						</div>
						<button class="minicart-submit" type="submit" data-minicart-alt="undefined">
							Check Out
						</button>
					</div>
				</form>';
			}
			else
			{
				echo'
				<form method="post" class="" target="">
					<button type="button" onClick="closeM1()" class="minicart-closer">×</button>
					<ul>
						<li class="minicart-item">
							<h4>Shop Now!</h4>
						</li>
					</ul>
					<div class="minicart-footer">
						<button type="button" onClick="closeM1toShop()" class="minicart-submit">
							Shop
						</button>
					</div>
				</form>';
			}
		}
		else
		{
			echo'
			<form method="post" class="" action="login.php" target="">
				<button type="button" onClick="closeM1()" class="minicart-closer">×</button>
				<ul>
					<li class="minicart-item">
						<h4>Log In to view cart</h4>
					</li>
				</ul>
				<div class="minicart-footer">
					<button type="submit" class="minicart-submit">
						Log In
					</button>
				</div>
			</form>';
		}
		echo'
	</div>
</div>	
';
?>