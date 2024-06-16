<?php 
// addAdmin-Template.php
require('../db/database.php');
require('../db/databaseTable.php');
 ?>

<main id="addNewAdmin" class="alert alert-secondary" style="padding: 2%;margin-top: 2%; border-radius: 5px; margin-left: 30%; margin-right: 30%; margin-bottom: 5%;">
	<div class="container">
		<br>
		<h1>Create new Admin</h1>
		<form class="AddNewAdmin" action="" method="POST">
			<label>Fullname:</label>
			<input type="text" class="form-control" name="fullname"><br>
			
			<label>Username:</label>
			<input type="text" class="form-control" name="username"><br>

			<label>Gender:</label>
			<select class="form-control" name="gender">
				<option class="form-control" value="Male">Male</option>
				<option class="form-control" value="Female">Female</option>
			</select><br>

			<label>Email_Address:</label>
			<input type="text" class="form-control" name="emailAddress"><br>
			
			<label>Password:</label>
			<input type="password" class="form-control" name="password"><br>

			<button type="submit" name="addNewAdmin" class="btn btn-dark">Add Admin</button>
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
 					// check if any input is empty
 				if(response == "empty input"){
 					$("#response").html("<p class='alert alert-danger' style='Display: none'>**Please enter all valid input.</p>");
 					$("#response .alert").slideDown("slow"); 
 					$("#response").css('color', 'red');
 				 }
 				 // check the full name
 				if(response == "invalid name"){
 					$("#response").html("<p class='alert alert-danger' style='Display: none'>**Fullname is invalid.</p>");
 					$("#response .alert").slideDown("slow"); 
 					$("#response").css('color', 'red');
 				 }
 				 // check the email address
 				if(response == "invalid email"){
 					$("#response").html("<p class='alert alert-danger' style='Display: none'>**Email Address is invalid.</p>");
 					$("#response .alert").slideDown("slow"); 
 					$("#response").css('color', 'red');
 				 }
 				 // check if username or emailAddress is taken or not.
 				 if(response == "taken"){
 					$("#response").html("<p class='alert alert-danger' style='Display: none'>**Username/ Email Address is already taken.</p>");
 					$("#response .alert").slideDown("slow"); 
 					$("#response").css('color', 'red');
 				 }
 				 //when creating new admin is successfull
 				if(response == "success"){
 					$("#response").html("<div class='alert alert-success' style='Display: none'>Creating new admin is successful.</div>");
 					$("#response .alert").slideDown("slow");
 					window.location.href = "../MAIN/admins.php?admin=adminDetails";
 				}
 				}
 			});
 		});
 	});

</script>