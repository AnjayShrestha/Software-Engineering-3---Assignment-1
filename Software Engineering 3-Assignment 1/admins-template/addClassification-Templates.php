<?php 
// addclassification-Templates
require('../db/database.php');
require('../db/databaseTable.php');
 ?>

 <main id="addclassification" class="alert alert-secondary" style=" padding: 2%; border-radius: 5px; margin-top: 2%; margin-left: 30%; margin-right: 30%;">

 	<div class="container">
 		<form class="addclassification" action="" method="POST">
 			<h1>Create classification</h1>
 			<br>
 			<label>Classification:</label>
 			<input type="text" class="form-control" name="classification">
 			<br>
 			<button type="submit" name="addNewclassification" class="btn btn-dark">Add classification</button>
 			<div id="responsError"></div>
 		</form>
 	</div>

 </main>

 <script type="text/javascript">
 	$(function(){
 		$(document).on("submit", ".addclassification", function(event){
 			event.preventDefault();
 			$.ajax({
 				type: "POST",
 				url:  "../databaseWork/createclassification.php",
 				data:$(this).serialize(),
 				success: function(responsError){
	 					// check if any input is empty
	 				if(responsError == "empty input"){
	 					// alert('working');
	 					$("#responsError").html("<p class='alert alert-danger' style='Display: none'>**Please enter a valid input.</p>");
	 					$("#responsError .alert").slideDown("slow"); 
	 					$("#responsError").css('color', 'red');
	 				 }
	 				 // check the classification
	 				if(responsError == "invalid classification"){
	 					$("#responsError").html("<p class='alert alert-danger' style='Display: none'>**classification is invalid.</p>");
	 					$("#responsError .alert").slideDown("slow"); 
	 					$("#responsError").css('color', 'red');
	 				 }
	 				  // check if the written classification exit or not
	 				if(responsError == "taken"){
	 					$("#responsError").html("<p class='alert alert-danger' style='Display: none'>**This classification already exists.</p>");
	 					$("#responsError .alert").slideDown("slow"); 
	 					$("#responsError").css('color', 'red');
	 				 }

	 				   //when creating new classification is successfull
	 				if(responsError == "success"){
	 					$("#responsError").html("<div class='alert alert-success' style='Display: none'>Creating new classification is successful.</div>");
	 					$("#responsError .alert").slideDown("slow");
	 					window.location.href = "../MAIN/admins.php?admin=adminClassification";
	 				}
 				}
 			});
 		});
 	});
 </script>