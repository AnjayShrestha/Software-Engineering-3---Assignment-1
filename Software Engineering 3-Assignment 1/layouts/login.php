<?php
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
	<title>
		Forthby's Auction House
	</title>
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
<body>
	<header id="index_header">
		<div id="navbar">
			<?php include('../Include/navbar.php'); ?>
		</div>
		
	</header>
	<main id="loginPage" class="alert alert-secondary" style="margin-top: 1%; margin-left: 30%;padding:2%; margin-right: 30%; border-radius: 2%">
		<!-- division for login form. -->
		<div class="container" style=";">	

		<form method="POST" action="" class="logging" style=" ">
			<h4>Forthby's Auction House Admin Login Page</h4>	<br>
			<label>Username/Email_Address:</label>
			<input type="text" class="form-control" name="username"><br>

			<label>Password:</label>
			<input type="password" class="form-control" name="password"><br>

			<button class="btn btn-secondary" id="login" type="submit" name="login" >Login</button>
			<br>
			<div id="response"></div>
		</form>
		</div>
<!-- ajax for logging into the system -->
<script type="text/javascript">
 	$(function(){ 
 		$(document).on("submit",".logging", function(event){
 			event.preventDefault();
 			// alert("work ing");
 			$.ajax({
 				type: "POST",
 				url:"../Include/loging.php",
 				data:$(this).serialize(),
 				success: function(response){
 				// alert(response);
 				if(response == "empty"){
 					$("#response").html("<p class='alert alert-warning' style='Display: none'>**Please enter your email address and password.</p>");
 					$("#response .alert").slideDown("slow"); 
 					$("#response").css('color', 'red');
 				 }
 				if(response == "success"){
 					$("#response").html("<div class='alert alert-warning' style='Display: none'>Login Successful.</div>");
 					$("#response .alert").slideDown("slow");
 					window.location.href = "../MAIN/admins.php";

 				}
 				if(response == "error"){
					$("#response").html("<div class='alert alert-warning' style='Display: none'>**Password incorrect.</div>");
					$("#response .alert").slideDown("slow");
					$("#response").css('color', 'red');
 				}
 				if(response == "no"){
 					$("#response").html("<div class='alert alert-warning' style='Display: none'>**Email/username is not registered.</div>");
 					$("#response .alert").slideDown("slow");
 					$("#response").css('color', 'red');
 				}
 				}
 			});
 		});
 	});

 </script>
	 </main>
	<footer class="alert alert-secondary" style=" margin-bottom: 0;">
		<p style="text-align: center;">(c) 2019. Forthby's Auction House</p>
	</footer>

</body>
</html>
<?php 
}
 ?>