<?php
	session_start();
	include 'db.php';
	
	if(isset($_POST['savetodelivery']))
	{
		$deliverySql = "INSERT INTO `delivery`(`date`,`time`,`username`,`status`,`payment`,`fee`,`fullname`,`email`,`phone`,`landmark`,`course`,`yearsection`,`gender`) VALUES ('".$_POST['date']."','".$_POST['time']."','".$_POST['username']."','".$_POST['status']."','".$_POST['payment']."','".$_POST['fee']."','".$_POST['fullname']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['landmark']."','".$_POST['course']."','".$_POST['yearsection']."','".$_POST['gender']."')";
		$deliveryQuery = mysqli_query($conn, $deliverySql);
		
		$deliveryid = mysqli_insert_id($conn);
		
		$getcart = "SELECT * FROM cart WHERE username='".$_POST['username']."'";
		$getQuery = mysqli_query($conn, $getcart);
		
		if (mysqli_num_rows($getQuery) > 0)
		{
			while($cartRow = mysqli_fetch_assoc($getQuery))
			{
				$deliverySql = "INSERT INTO `deliveryitems`(`itemid`, `ItemName`, `Price`, `Quantity`, `Total`, `deliveryid`) VALUES ('".$cartRow['productid']."','".$cartRow['productname']."','".$cartRow['price']."','".$cartRow['quantity']."','".$cartRow['totalprice']."','".$deliveryid."')";
				$deliverySqlResult = mysqli_query($conn ,$deliverySql);
				
				//GET STOCK
				$getStockSql = "SELECT stock FROM items WHERE ID='".$cartRow['productid']."'";
				$getstockQuery = mysqli_query($conn, $getStockSql);
				
				$stock = 0;
				$quan = 0;
				
				if (mysqli_num_rows($getstockQuery) > 0)
				{
					while($gsRow = mysqli_fetch_assoc($getstockQuery))
					{
						$stock = $gsRow['stock'];
					}
				}
				$quan = $cartRow['quantity'];
				
				$stock = $stock - $quan;
				
				//UPDATE STOCK
				$StockSql = "UPDATE items SET stock='".$stock."' WHERE ID='".$cartRow['productid']."'";
				$stockQuery = mysqli_query($conn, $StockSql);
			}
		}
		
		$delcartquery = "DELETE FROM cart WHERE username='".$_POST['username']."'";
		$delcartResult = mysqli_query($conn ,$delcartquery);
		
		header('Location: index.php?transact=1');
	}
	
	if(isset($_POST['pid']))
	{
		$pid = $_POST['pid'];
		$username = $_SESSION['username'];
		$delcartquery = "DELETE FROM cart WHERE productid='$pid' AND username='$username'";
		$delcartResult = mysqli_query($conn ,$delcartquery);
	}
	
	if(isset($_POST['updatequantity']))
	{
		$id = $_POST['id'];
		$updatequantity = $_POST['updatequantity'];
		$username = $_SESSION['username'];
		
		$getcart = "SELECT * FROM cart WHERE productid='$id' AND username='$username'";
		$getQuery = mysqli_query($conn, $getcart);
		
		$price = 0;
		
		if (mysqli_num_rows($getQuery) > 0)
		{
			while($cartRow = mysqli_fetch_assoc($getQuery))
			{
				$price = $cartRow['price'];
			}
		}
		
		$totalprice = $updatequantity * $price;
		
		$addCartSql = "UPDATE cart SET quantity='".$updatequantity."', totalprice='".$totalprice."' WHERE productid='$id' AND username='$username'";
		$addQuery = mysqli_query($conn, $addCartSql);
		
		echo $totalprice;
	}
	
	if(isset($_POST['cartitem']))
	{
		$username = $_SESSION['username'];
		
		$gettotalcart = "SELECT * FROM cart WHERE username='$username'";
		$gettotalQuery = mysqli_query($conn, $gettotalcart);
		
		$tprice = 0;
		
		if (mysqli_num_rows($gettotalQuery) > 0)
		{
			while($totalRow = mysqli_fetch_assoc($gettotalQuery))
			{
				$tprice += $totalRow['totalprice'];
			}
		}
		
		echo $tprice;
	}
?>