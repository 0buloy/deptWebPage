<?php
	session_start();
	
	include 'db.php';
	
	if(isset($_POST['deliveritemid']))
	{
		$addCartSql = "UPDATE delivery SET action='delivered', status='delivered' WHERE ID='".$_POST['deliveritemid']."'";
		$addQuery = mysqli_query($conn, $addCartSql);
		
		$reward = 0.0;
		
		$GetCurrentReward = "SELECT * FROM rewards WHERE username='".$_POST['username']."'";
		$rQuery = mysqli_query($conn, $GetCurrentReward);
		
		if (mysqli_num_rows($rQuery) > 0)
		{
			while($rRow = mysqli_fetch_assoc($rQuery))
			{
				$reward = $rRow['rewards'];
			}
		}
		
		date_default_timezone_set("Asia/Manila");
		$pdate = date("m/d/Y");
		
		$reward = $reward + $_POST['rewards'];
		
		$addRewardsSql = "UPDATE rewards SET rewards='".$reward."',date='".$pdate."' WHERE username='".$_POST['username']."'";
		$addRewardsQuery = mysqli_query($conn, $addRewardsSql);
	}
	
	if(isset($_POST['declineitemid']))
	{
		$addCartSql = "UPDATE delivery SET action='".$_POST['action']."', status='canceled' WHERE ID='".$_POST['declineitemid']."'";
		$addQuery = mysqli_query($conn, $addCartSql);
	}
?>