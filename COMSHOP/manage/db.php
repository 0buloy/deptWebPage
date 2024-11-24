<?php
	$dbhost = "localhost"; /*"qundaqa.com.mysql";*/
	$dbuser = "root";/*"qundaqa_com";*/
	$dbpass = "";/*"mwzk5pNV";*/
	$db = "comshop";/*"qundaqa_com";*/
	
	$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
	
	if(!$conn)
	{
		die("Connection Failed. ". mysqli_connect_error());
		echo "can't connect to database";
	}
?>