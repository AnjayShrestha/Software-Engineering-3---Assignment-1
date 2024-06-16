<?php
require('../db/database.php');
// require('../db/databaseTable.php');
session_start();
if(isset($_SESSION['a_id']))
{
 header('Refresh: 1; url =../MAIN/admins.php');
 
 }

else
{
?>
<!DOCTYPE html>
<html>
<head>
	<title>Forthby's Auction House</title>
	<!-- <link rel="stylesheet" type="text/css" href="../Styles/bootstrap.css"> -->
 	<link rel="stylesheet" type="text/css" href="../styles/Style.css">
 	<!-- bootstrap property -->
 	<link rel="stylesheet" href="../Bootstrap/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="../Bootstrap/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="../Bootstrap/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="../Bootstrap/bootstrap.min.js"></script>
</head>

<body id="users">
	<header id="index_header">
		<div id="navbar">
			<?php include('../Include/navbar.php'); ?>
		</div>
	</header>
	
	<main class="alert alert-secondary" id="applied" style="margin-left: 20%; margin-right:20%; margin-top: 2%;">
		<div class="container">
		<br>
		<h1>Create new Admin</h1>
		<form class="application" action="" method="POST">
			<label>Fullname:</label>
			<input type="text" class="form-control" name="fullname"><br>
			
			<label>Username</label>
			<input type="text" class="form-control" name="username"><br>

			<label>Gender:</label>
			<select class="form-control" name="gender">
				<option class="form-control" value="Male">Male</option>
				<option class="form-control" value="Female">Female</option>
			</select><br>

			<label>Application for:</label>
			<select class="form-control" name="type">
				<option class="form-control" value="Seller">Seller</option>
				<option class="form-control" value="Buyer">Buyer</option>
			</select><br>
			
			<label>Email_Address:</label>
			<input type="text" class="form-control" name="emailAddress"><br>
			
			<label>Password:</label>
			<input type="password" class="form-control" name="password"><br>

			<button type="submit" name="application" class="btn btn-dark">Apply</button>
			<div id="responseApplied"></div>
		</form>
	</div>
</main>

<script type="text/javascript">
	$(function(){ 
 		$(document).on("submit",".application", function(event){
 			event.preventDefault();
 			// alert("work ing");
 			$.ajax({
 				type: "POST",
 				url:"../databaseWork/createUser.php",
 				data:$(this).serialize(),
 				success: function(responseApplied){
 					// check if any input is empty
 				if(responseApplied == "empty input"){
 					$("#responseApplied").html("<p class='alert alert-danger' style='Display: none'>**Please enter all valid input.</p>");
 					$("#responseApplied .alert").slideDown("slow"); 
 					$("#responseApplied").css('color', 'red');
 				 }
 				 // check the full name
 				if(responseApplied == "invalid name"){
 					$("#responseApplied").html("<p class='alert alert-danger' style='Display: none'>**Fullname is invalid.</p>");
 					$("#responseApplied .alert").slideDown("slow"); 
 					$("#responseApplied").css('color', 'red');
 				 }
 				 // check the email address
 				if(responseApplied == "invalid email"){
 					$("#responseApplied").html("<p class='alert alert-danger' style='Display: none'>**Email Address is invalid.</p>");
 					$("#responseApplied .alert").slideDown("slow"); 
 					$("#responseApplied").css('color', 'red');
 				 }
 				 // check if username or emailAddress is taken or not.
 				 if(responseApplied == "taken"){
 					$("#responseApplied").html("<p class='alert alert-danger' style='Display: none'>**Username/ Email Address is already taken.</p>");
 					$("#responseApplied .alert").slideDown("slow"); 
 					$("#responseApplied").css('color', 'red');
 				 }
 				 //when creating new admin is successfull
 				if(responseApplied == "success"){
 					$("#responseApplied").html("<div class='alert alert-success' style='Display: none'>Application sent successfully.</div>");
 					$("#responseApplied .alert").slideDown("slow");
 					// window.location.href = "";
 				}
 				}
 			});
 		});
 	});

</script>

	<footer class="alert alert-secondary" style="margin-top: 5%; margin-bottom: 0;">
		<p style="text-align: center;">(c) 2019. Forthby's Auction House</p>
	</footer>
</body>

</html>
<?php }

// function to search category
	function get_category($pdo, $id)
	{
		$sql = "SELECT * FROM categories WHERE category_id ='$id'";
		$statement = $pdo->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach ($result as $row)
		{
		return  '<b>'.$row['category'].'</b>';
		}
	}

// function to search classification
	function get_classification($pdo, $id)
	{
		$query = "SELECT * FROM classification WHERE classification_id ='$id'";
		$statements= $pdo->prepare($query);
		$statements->execute();
		$resultClassification = $statements->fetchAll();
		foreach ($resultClassification as $raw)
		{
		return  '<b>'.$raw['classification'].'</b>';
		}
	} ?>