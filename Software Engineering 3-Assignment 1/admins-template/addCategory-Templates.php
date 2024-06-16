<?php 
// addCategory-Templates
require('../db/database.php');
require('../db/databaseTable.php');
 ?>

 <main id="addCategory" class="alert alert-secondary" style="padding: 2%; border-radius: 5px; margin-top: 2%; margin-left: 30%; margin-right: 30%;">

 	<div class="container">
 		<form class="addCategory" action="" method="POST">
 			<h1>Create Category</h1>
 			<br>
 			<label>Category:</label>
 			<input type="text" class="form-control" name="category">
 			<br>
 			<button type="submit" name="addNewCategory" class="btn btn-dark">Add Category</button>
 			<div id="response"></div>
 		</form>
 	</div>

 </main>

 <script type="text/javascript">
 	$(function(){
 		$(document).on("submit", ".addCategory", function(event){
 			event.preventDefault();
 			$.ajax({
 				type: "POST",
 				url:  "../databaseWork/createCategory.php",
 				data:$(this).serialize(),
 				success: function(response){
	 					// check if any input is empty
	 				if(response == "empty input"){
	 					// alert('working');
	 					$("#response").html("<p class='alert alert-danger' style='Display: none'>**Please enter a valid input.</p>");
	 					$("#response .alert").slideDown("slow"); 
	 					$("#response").css('color', 'red');
	 				 }
	 				 // check the category
	 				if(response == "invalid category"){
	 					$("#response").html("<p class='alert alert-danger' style='Display: none'>**Category is invalid.</p>");
	 					$("#response .alert").slideDown("slow"); 
	 					$("#response").css('color', 'red');
	 				 }
	 				  // check if the written category exit or not
	 				if(response == "taken"){
	 					$("#response").html("<p class='alert alert-danger' style='Display: none'>**This Category already exists.</p>");
	 					$("#response .alert").slideDown("slow"); 
	 					$("#response").css('color', 'red');
	 				 }

	 				   //when creating new category is successfull
	 				if(response == "success"){
	 					$("#response").html("<div class='alert alert-success' style='Display: none'>Creating new category is successful.</div>");
	 					$("#response .alert").slideDown("slow");
	 					window.location.href = "../MAIN/admins.php?admin=adminCategory";
	 				}
 				}
 			});
 		});
 	});
 </script>