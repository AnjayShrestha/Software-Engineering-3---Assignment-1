<?php 
// addNewAdmin.php

 ?>

<?php
include("../db/database.php");
session_start();
 ?>
 
 <?php 
 // if(isset($_SESSION['a_id'])){
 
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<link rel="stylesheet" type="text/css" href="../styles/styles.css">
 	<!-- bootstraps property -->
 	<link rel="stylesheet" href="../Bootstrap/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="../Bootstrap/jquery-ui.css">
	
	<!-- jQuery library -->
	<script src="../Bootstrap/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="../Bootstrap/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="../Bootstrap/bootstrap.min.js"></script>

		
	<script src="../Bootstrap/jquery-1.12.4.js"></script>

	<script src="../Bootstrap/jquery-ui.js"></script>


	<script src="../Bootstrap/jquery.form.js"></script>

 	<title>
 	</title>
 </head>
 <body>
 <header class="adminHeader">
 	<div id="navbar">
			<?php include('../Include/adminNavBar.php'); ?>
		</div>
 </header>
 		 
<main id="addNewAdmin" style="background-color: orange; padding: 2%; border-radius: 5px; margin-top: 2%; margin-left: 30%; margin-right: 30%;">
	<div class="container">
		<br>
		<h1>Create new admin</h1>
		<form class="AddNewAdmin" action="" method="POST">
			<label>Fullname:</label>
			<input type="text" class="form-control" name="fullname"><br>
			
			<label>Username</label>
			<input type="text" class="form-control" name="username"><br>
			
			<label>Email_Address:</label>
			<input type="email" class="form-control" name="emailAddress"><br>
			
			<label>Password:</label>
			<input type="password" class="form-control" name="password"><br>

			<button type="submit" name="addNewAdmin" class="btn btn-danger">Add</button>
			<div id="response"></div>
		</form>
	</div>
</main>

<script type="text/javascript">
	$(function(){ 
 		$(document).on("submit",".AddNewAdmin", function(event){
 			event.preventDefault();
 			// alert("work ing");
 			$.ajax({
 				type: "POST",
 				url:"../databaseWork/createAdmin.php",
 				data:$(this).serialize(),
 				success: function(response){
 				if(response == "empty"){
 					$("#response").html("<p class='alert alert-danger' style='Display: none'>**Please enter your email address and password.</p>");
 					$("#response .alert").slideDown("slow"); 
 					$("#response").css('color', 'red');
 				 }
 				// if(response == "success"){
 				// 	$("#response").html("<div class='alert alert-warning' style='Display: none'>Login Successful.</div>");
 				// 	$("#response .alert").slideDown("slow");
 				// 	window.location.href = "../HTML/userLayout.php";

 				// }
 				// if(response == "error"){
					// $("#response").html("<div class='alert alert-warning' style='Display: none'>**Password incorrect.</div>");
					// $("#response .alert").slideDown("slow");
					// $("#response").css('color', 'red');
 				// }
 				// if(response == "nouser"){
 				// 	$("#response").html("<div class='alert alert-warning' style='Display: none'>**Email is not registered.</div>");
 				// 	$("#response .alert").slideDown("slow");
 				// 	$("#response").css('color', 'red');
 				// }
 				}
 			});
 		});
 	});

</script>

<footer style="background-color: orange; margin-top: 1%; margin-bottom: 0;">
		<p style="text-align: center;">(c) 2019. Forthby's Auction House</p>
	</footer>
<!-- for searching -->
 </body>
 </html>
 		<?php 
 	// }
 	// else
 	// {
 	// 	header('Refresh: 1; url =../layouts/index.php');
 	// }
 	?>		
 


 <?php 
// addAdmin-Templates.php
require('../db/database.php');
 ?>
