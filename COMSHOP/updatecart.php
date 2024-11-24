<?php
	include 'db.php';
	
	$_POST['']
	
	$updateCartSQL = "UPDATE cart SET sTitle='".$_POST['eservtitle']."' WHERE ID='$editservid'";
	$ucartQuery = mysqli_query($conn, $updateCartSQL);
?>