<?php
	session_start();
	
	include 'db.php';

	if($_SESSION['admin']!="admin")
	{
		header('Location: login/');
	}
	
	//SEARCH
	if(isset($_POST['search']))
	{
		$term = $_POST['Product'];
		$sby = $_POST['by'];
		header('Location: manage.php?search='.$term.'&sby='.$sby.'');
	}
	
	//CATEGORY for itemModal
	$catQuery = "SELECT DISTINCT category FROM `items` ORDER BY category";
	$catResult = mysqli_query($conn ,$catQuery);
	
	//GET FROM Items
	$adQuery = "SELECT * FROM `items`";
	
	if(isset($_POST['sort']))
	{
		$by = $_POST['by'];
		$asc = $_POST['asc'];
		header('Location: manage.php?sort='.$by.'&asc='.$asc.'');
	}
	
	if(isset($_GET['sort']))
	{
		$sortby = $_GET['sort'];
		$ascdesc = $_GET['asc'];
		
		if($sortby=="price"||$sortby=="stock")
			$adQuery = "SELECT * FROM `items` ORDER BY cast($sortby as unsigned) $ascdesc;";
		else if($sortby=="recent")
			$adQuery = "SELECT * FROM `items` ORDER BY ID $ascdesc";
		else
			$adQuery = "SELECT * FROM `items` ORDER BY $sortby $ascdesc;";
	}
	else if(isset($_GET['search']))
	{
		$searchterm = $_GET['search'];
		$searchin = $_GET['sby'];
		
		if($searchin=="price"||$searchin=="stock")
			$adQuery = "SELECT * FROM `items` WHERE $searchin LIKE '$searchterm%'";
		else
			$adQuery = "SELECT * FROM `items` WHERE $searchin LIKE '%$searchterm%'";
	}
	else
	{
		$adQuery = "SELECT * FROM `items`";
	}
	$adResult = mysqli_query($conn ,$adQuery);
	
	//ADD Items
	if(isset($_POST['iadd']))
	{
		$name = $_POST['iname'];
		$price = $_POST['iprice'];
		$desc = $_POST['idescription'];
		$stock = $_POST['istock'];
		$cat = $_POST['icategory'];
		
		$adfileupload = $_FILES['iupload']['name'];
		$adfileuploadTMP = $_FILES['iupload']['tmp_name'];
		
		$adfile_ext = substr($adfileupload, strripos($adfileupload, '.'));
		
		date_default_timezone_set("Asia/Manila");
		$adnewname = date("MdYHisu");
		
		$adnewfilename = $adnewname.$adfile_ext;
		
		$adfolder = "../images/items/";
		
		move_uploaded_file($adfileuploadTMP, $adfolder.$adnewfilename);
		
		$adsql = "INSERT INTO `items`(`name`,`price`,`category`,`stock`,`picture`,`description`) VALUES ('$name','$price','$cat','$stock','$adnewfilename','$desc')";
		$adqry = mysqli_query($conn, $adsql);
		
		echo
		'
		<div id="successadded" class="omodal">
			<div class="modal-content">
				<div class="modal-body">
					<strong style="color:green">Succesfully Added!</strong><br><br>
					<strong><a href="manage.php">Ok</a></strong>
				</div>
			</div>
		</div>
		';
	}
	
	//EDIT ITEMS
	if(isset($_POST['iedit']))
	{
		$iid = $_POST['iid'];
		$name = $_POST['iname'];
		$price = $_POST['iprice'];
		$desc = $_POST['idescription'];
		$stock = $_POST['istock'];
		$cat = $_POST['icategory'];
		
		$adfileupload = $_FILES['iupload']['name'];
		$adfileuploadTMP = $_FILES['iupload']['tmp_name'];
		
		$adfile_ext = substr($adfileupload, strripos($adfileupload, '.'));
		
		date_default_timezone_set("Asia/Manila");
		$adnewname = date("MdYHisu");
		
		$adnewfilename = $adnewname.$adfile_ext;
		
		$adfolder = "../images/items/";
		
		move_uploaded_file($adfileuploadTMP, $adfolder.$adnewfilename);
		
		$UISql = "UPDATE items SET name='".$name."',price='".$price."',category='".$cat."',stock='".$stock."',picture='".$adnewfilename."',description='".$desc."' WHERE ID='".$iid."'";
		$UIQuery = mysqli_query($conn, $UISql);
		
		echo
		'
		<div id="successadded" class="omodal">
			<div class="modal-content">
				<div class="modal-body">
					<strong style="color:green">Succesfully Updated!</strong><br><br>
					<strong><a href="manage.php">Ok</a></strong>
				</div>
			</div>
		</div>
		';
	}
	
	//UPDATE ADS
	
	//DELETE Items
	if(isset($_GET['confirmitemId']))
	{
		$addbid = $_GET['confirmitemId'];
		
		$addelsql = "DELETE FROM items WHERE ID = '$addbid'";
		$addbdelquery = mysqli_query($conn,$addelsql);
		
		echo
		'
		<div id="successdeleteteam" class="omodal">
			<div class="modal-content">
				<div class="modal-body">
					<strong style="color:green">Succesfully Deleted!</strong><br><br>
					<strong><a href="manage.php">Ok</a></strong>
				</div>
			</div>
		</div>
		';
	}
	
	if(isset($_GET['delitemid']))
	{	
		$confirmitemId = $_GET['delitemid'];
		
		echo
		'
		<div id="delteammodal" class="omodal">
			<!-- Modal content -->
			<div class="modal-content">
				<div class="modal-body">
					<form method="post">
						<strong>Are you sure you want to delete?</strong><br><br>
						<strong><a href="?confirmitemId='.$confirmitemId.'?">Yes</a>&nbsp;
						<a href="manage.php" name="delno">No</a></strong>
					</form>
				</div>
			</div>
		</div>
		';
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="img/logo/iconlogo.png"/>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>csecommerce Admin</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	
	<style>
	table {
		border-collapse: collapse;
		width: 100%;
		color:black;
	}

	td, th {
		font-size:12px;
		border: 1px solid #dddddd;
		text-align: left;
		padding: 8px;
	}

	tr:nth-child(even) {
		background-color: #dddddd;
	}
	h3{
		padding-top:5px;
	}
	table
	{
		margin-bottom:10px;
	}
	
	.omodal
	{
		display: block; /* Hidden by default */
		position: fixed; /* Stay in place */
		z-index: 900; /* Sit on top */
		left: 0;
		top: 0;
		width: 100%; /* Full width */
		height: 100%; /* Full height */
		overflow: auto; /* Enable scroll if needed */
		background-color: rgb(0,0,0); /* Fallback color */
		background-color: rgba(0,0,0,0.3); /* Black w/ opacity */
	}
	
	.modal
	{
		display: none; /* Hidden by default */
		position: fixed; /* Stay in place */
		z-index: 900; /* Sit on top */
		left: 0;
		top: 0;
		width: 100%; /* Full width */
		height: 100%; /* Full height */
		overflow: auto; /* Enable scroll if needed */
		background-color: rgb(0,0,0); /* Fallback color */
		background-color: rgba(0,0,0,0.3); /* Black w/ opacity */
	}

	.modal-header {
		padding: 2px 16px;
		color: black;
	}

	/* Modal Body */
	.modal-body
	{
		padding: 2px 16px;
		color: black;
	}

	/* Modal Footer */
	.modal-footer
	{
		padding: 2px 16px;
	}

	/* Modal Content */
	.modal-content
	{
		position: relative;
		margin-right: auto;
		margin-left: auto;
		margin-top: 100px;
		padding: 0;
		border: 1px solid orange;
		width: 50%;
		box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
		animation-name: animatetop;
		animation-duration: 0.4s
	}
	</style>
	
</head>
<body>
	<?php include 'topnav.php'; ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li>
					<a href="index.php"><em class="fa fa-home"></em></a>
				</li>
				<li class="active">Manage</li>
			</ol>
		</div>
		<div class="row">
			<div class="col-lg-12 ">
				<h1 class="page-header">Manage</h1>
			</div>
		</div>
		<h3>Items</h3>
		<table style="width:auto">
			<tr>
				<form action="?" method="post">
				<td>sort by:</td>
				<?php
				
				if(isset($_GET['sort']))
				{
					echo'
					<td>
						<select name="by">
							<option value="recent" ';if($_GET['sort']=="recent")echo 'selected'; echo'>recent</option>
							<option value="name" ';if($_GET['sort']=="name")echo 'selected'; echo'>name</option>
							<option value="category" ';if($_GET['sort']=="category")echo 'selected'; echo'>category</option>
							<option value="price" ';if($_GET['sort']=="price")echo 'selected'; echo'>price</option>
							<option value="stock" ';if($_GET['sort']=="stock")echo 'selected'; echo'>stock</option>
						</select>
						<select name="asc">
							<option value="asc" ';if($_GET['asc']=="asc")echo 'selected'; echo'>ascending</option>
							<option value="desc" ';if($_GET['asc']=="desc")echo 'selected'; echo'>descending</option>
						</select>
					</td>';
				}
				else
				{
					echo'
					<td>
						<select name="by">
							<option value="recent">recent</option>
							<option value="name">name</option>
							<option value="category">category</option>
							<option value="price">price</option>
							<option value="stock">stock</option>
						</select>
						<select name="asc">
							<option value="asc">ascending</option>
							<option value="desc">descending</option>
						</select>
					</td>';
				}
				?>
				<td>
					<button type="submit" name="sort">go</button>
				</td>
				</form>
			</tr>
			<tr>
				<form method="post">
				<td>search:</td>
				<td>
				<?php
				
				if(isset($_GET['search']))
				{
					echo'
					<input type="text" name="Product" value="'.$_GET['search'].'" required="">
					by:
					<select name="by">
						<option value="name" ';if($_GET['sby']=="name")echo 'selected'; echo'>name</option>
						<option value="category" ';if($_GET['sby']=="category")echo 'selected'; echo'>category</option>
						<option value="price" ';if($_GET['sby']=="price")echo 'selected'; echo'>price</option>
						<option value="stock" ';if($_GET['sby']=="stock")echo 'selected'; echo'>stock</option>
					</select>';
				}
				else
				{
					echo'
					<input type="text" name="Product" value="Search a product..." onfocus=\'this.value = "";\' onblur=\'if (this.value == "") {this.value = "Search a product...";}\' required="">
					by:
					<select name="by">
						<option value="name">name</option>
						<option value="category">category</option>
						<option value="price">price</option>
						<option value="stock">stock</option>
					</select>';
				}
				?>
					
				</td>
				<td>
					<input type="submit" value="search" name="search">
				</td>
				</form>
			</tr>
			<tr>
				<td colspan="3" align="right" >
					<a href="manage.php" style="color:red"><input type="submit" value="clear inputs" name="clear"></a>
				</td>
			</tr>
		</table>
		<table class="servtable">
			<tr>
				<td colspan="7" style="text-align:right"><button name="" onClick="showItemModal()" type="submit">Add New Item</button></td> <!--MODAL-->
			</tr>
			<tr>
				<th>Name</th>
				<th>Price</th>
				<th>Category</th>
				<th>Stock</th>
				<th>Description</th>
				<th>Picture</th>
				<th>Actions</th>
			</tr>
			<?php
				if (mysqli_num_rows($adResult) > 0)
				{
					while($adRow = mysqli_fetch_assoc($adResult))
					{
						echo
						'
							<tr>
								<td>'.$adRow['name'].'</td>
								<td>'.$adRow['price'].'</td>
								<td>'.$adRow['category'].'</td>
								<td>'.$adRow['stock'].'</td>
								<td>'.$adRow['description'].'</td>
								<td><img style="height:80px" src="../images/items/'.$adRow['picture'].'"/></td>
								<td>
									<a href="?edititemid='.$adRow['ID'].'">Edit</a>&nbsp;
									<a href="?delitemid='.$adRow['ID'].'?" style="color:red">Delete</a>
								</td>
							</tr>
						';
					}
				}
			?>
			<tr>
				<td colspan="7" style="text-align:right"><button name="" onClick="showItemModal()" type="submit">Add New Item</button></td> <!--MODAL-->
			</tr>
		</table>
	
		<!-- MODALS -->
	
		<div id="itemmodal" class="modal">
			<!-- Modal content -->
			<div class="modal-content">
				<div class="modal-header">
					<span class="closemodal" onClick="closeItemModal()" style="cursor: pointer;">&times;</span>
					<h4>Add New Item<span id="added"></span></h4>
				</div>
				<div class="modal-body">
					<form method="post" action="?" enctype="multipart/form-data">
						Name:<br><input id="iname" name="iname" type="text" style="width:100%" value="" required><br><br>
						Description:<br><input id="idescription" name="idescription" type="text" style="width:100%" value=""><br><br>
						Price: Php <input id="iprice" name="iprice" type="number" value="" required>.00<br><br>
						Stock: <input id="istock" name="istock" type="number" value="" required>pcs<br><br>
						Category:
							<input list="cat" name="icategory" required />
							<datalist id="cat">
							<?php
								if (mysqli_num_rows($catResult) > 0)
								{
									while($catRow = mysqli_fetch_assoc($catResult))
									{
										echo '<option value="'.$catRow['category'].'">';
									}
								}
							?>
							</datalist><br><br>
						Picture:
							<input type="file" name="iupload" accept="image/*"  required />
						<br>
						<div style="width:100%" align="right">
							<button name="iadd">Add</button>
							<button onClick="closeItemModal()">Cancel</button>
						</div>
					</form>
				</div>
				<div class="modal-footer">
				</div>
			</div>
		</div>
		
		<?php
		
		if(isset($_GET['edititemid']))
		{
			$adid = $_GET['edititemid'];
			$editsql = "SELECT * FROM items WHERE ID='".$adid."'";
			$editquery = mysqli_query($conn,$editsql);
			
			if (mysqli_num_rows($editquery) > 0)
			{
				while($eRow = mysqli_fetch_assoc($editquery))
				{
					echo'
					<div id="edititemmodal" class="omodal">
						<!-- Modal content -->
						<div class="modal-content">
							<div class="modal-header">
								<span class="closemodal" onClick="closeEditItemModal()" style="cursor: pointer;">&times;</span>
								<h4>Edit Item<span id="added"></span></h4>
							</div>
							<div class="modal-body">
								<form method="post" action="?" enctype="multipart/form-data">
									Name:<br><input id="iname" name="iname" type="text" style="width:100%" value="'.$eRow['name'].'" required><br><br>
									Description:<br><input id="idescription" name="idescription" type="text" style="width:100%" value="'.$eRow['description'].'"><br><br>
									Price: Php <input id="iprice" name="iprice" type="number" value="'.$eRow['price'].'" required>.00<br><br>
									Stock: <input id="istock" name="istock" type="number" value="'.$eRow['stock'].'" required>pcs<br><br>
									Category:
										<input list="cat" name="icategory" value="'.$eRow['category'].'" required />
										<datalist id="cat">';
											if (mysqli_num_rows($catResult) > 0)
											{
												while($catRow = mysqli_fetch_assoc($catResult))
												{
													echo '<option value="'.$catRow['category'].'">';
												}
											}
										echo'
										</datalist><br><br>
									Picture:
										<input type="file" name="iupload" accept="image/*"  required />
										<input name="iid" type="hidden" value="'.$adid.'">
									<br>
									<div style="width:100%" align="right">
										<button name="iedit">Save Changes</button>
										<button onClick="closeEditItemModal()">Cancel</button>
									</div>
								</form>
							</div>
							<div class="modal-footer">
							</div>
						</div>
					</div>';
				}
			}
		}
		
		?>
	
	</div>	<!--/.main-->
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	
	<script type="text/javascript" src="js/modal3.js"></script>
</body>
</html>