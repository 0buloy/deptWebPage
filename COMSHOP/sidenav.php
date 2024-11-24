<?php

include 'db.php';

$Query = "SELECT DISTINCT category FROM `items` ORDER BY category";
$result = mysqli_query($conn ,$Query);

echo
'
		<div class="w3l_banner_nav_left">
			<nav class="navbar nav_bottom">
			 <!-- Brand and toggle get grouped for better mobile display -->
			  <div class="navbar-header nav_2">
				  <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
			   </div> 
			   <!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
					<ul class="nav navbar-nav nav_1">';
						if(isset($_GET['category']))
						{
							if($_GET['category']=="All Products")
							{
								echo '<li><a style="background-color: #fdba2d;color: #fff;" href="index.php?category=All Products">All Products</a></li>';
							}
							else
								echo '<li><a href="index.php?category=All Products">All Products</a></li>';
						}
						else
							echo '<li><a href="index.php?category=All Products">All Products</a></li>';
						
						if (mysqli_num_rows($result) > 0)
						{
							while($Row = mysqli_fetch_assoc($result))
							{
								if(isset($_GET['category']))
								{
									if($_GET['category']==$Row['category'])
									{
										echo'<li><a style="background-color: #fdba2d;color: #fff;" href="index.php?category='.$Row["category"].'">'.$Row["category"].'</a></li>';
									}
									else
										echo'<li><a href="index.php?category='.$Row["category"].'">'.$Row["category"].'</a></li>';
								}
								else
									echo'<li><a href="index.php?category='.$Row["category"].'">'.$Row["category"].'</a></li>';
							}
						}
					echo'
					</ul>
						<div style="padding:10px 10px 10px 10px">
							<form method="post" action="?">
								Price sort:<br><br>
								Less than: &nbsp; <input style="width:50px; margin-left: 24px;" type="number" name="lessthan" value=""><br><br>
								Greater than: &nbsp; <input style="width:50px" type="number" name="greaterthan" value="0"><br><br>
								<button type="submit" name="pricerange">Go</button>
							</form>
						</div>
				 </div><!-- /.navbar-collapse -->
			</nav>
		</div>
';
?>