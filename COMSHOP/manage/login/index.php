<?php
	session_start();
	
	include '../db.php';

	$_SESSION['admin'] = " ";
	$_SESSION['adminerror'] = " ";
	
	if(isset($_POST['adminloginbtn']))
	{
		$logEmail=$_POST['ausername'];
		$logPass=$_POST['apass'];
		
		$logQuery = "SELECT * FROM `adminacc` WHERE user='".$logEmail."' AND pass='".$logPass."'";
		
		$result = mysqli_query($conn ,$logQuery);
		
		$count = mysqli_num_rows($result);
		
		if($count >= 1)
		{
			$_SESSION['admin'] = "admin";
			$_SESSION['adminerror'] = " ";
			header('Location: ../');
		}
		else
		{
			header('Location: ../login/?err=2?');
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>MS ADMIN</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="img/shoplogo.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-50 p-b-90">
				<form class="login100-form validate-form flex-sb flex-w" method="post">
					<span class="login100-form-title p-b-51">
						Login
					</span>
					
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Username is required">
						<input class="input100" type="text" name="ausername" placeholder="Username">
						<span class="focus-input100"></span>
					</div>
					
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<input class="input100" type="password" name="apass" placeholder="Password">
						<span class="focus-input100"></span>
					</div>
					
					<!--div class="flex-sb-m w-full p-t-3 p-b-24">
						<div>
							<a href="?err=1?" class="txt1">
								Forgot?
							</a>
						</div>
					</div-->
					
					<div class="container-login100-form-btn m-t-17">
						<button name="adminloginbtn" class="login100-form-btn">
							Login
						</button>
					</div>
					
					<div id="forgotmessage">
						<br>
						<?php
							if(isset($_GET['err']))
							{
								if($_GET['err']==1)
									$_SESSION['adminerror'] = "Admin credentials sent to email";
								else if($_GET['err']==2)
									$_SESSION['adminerror'] = "Credentials do not match";
							}
							echo $_SESSION['adminerror'];
						?>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>