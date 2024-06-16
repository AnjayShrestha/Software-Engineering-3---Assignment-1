<?php 
// editclassification-Templates
require('../db/database.php');
require('../db/databaseTable.php');
$id = $_GET['id'];
$classification = $pdo->query("SELECT * FROM classification WHERE classification_id = '$id'")->fetch();
 ?>

 <main id="editClassification" class="alert alert-secondary" style=" padding: 2%; border-radius: 5px; margin-top: 2%; margin-left: 30%; margin-right: 30%;">

 	<div class="container">
		<a href="admins.php?admin=adminClassification" class="btn btn-secondary">Get Back to Classification</a>
		<br><br>
 		<form class="editClassification" action="" method="POST">
			<input type="hidden" name="ClaId" value="<?php echo $classification['classification_id'] ?>">
 			<h1>Update classification</h1>
 			<br>
 			<label>Classification:</label>
 			<input type="text" class="form-control" name="classification" value="<?php echo $classification['classification']?>">
 			<br>
 			<button type="submit" name="editClassification" class="btn btn-dark">Add classification</button>
 			<div id="responseClassification"></div>
 		</form>
 	</div>

 </main>

 <script type="text/javascript">
 	$(function(){
 		$(document).on("submit", ".editClassification", function(event){
 			event.preventDefault();
 			$.ajax({
 				type: "POST",
 				url:  "../databaseWork/updateClassification.php",
 				data:$(this).serialize(),
 				success: function(responseClassification){
	 					// check if any input is empty
	 				if(responseClassification == "empty"){
	 					// alert('working');
	 					$("#responseClassification").html("<p class='alert alert-danger' style='Display: none'>**Empty classification, Please enter a valid input.</p>");
	 					$("#responseClassification .alert").slideDown("slow"); 
	 					$("#responseClassification").css('color', 'red');
	 				 }
	 				 // check the classification
	 				if(responseClassification == "invalid"){
	 					$("#responseClassification").html("<p class='alert alert-danger' style='Display: none'>**Classification is invalid.</p>");
	 					$("#responseClassification .alert").slideDown("slow"); 
	 					$("#responseClassification").css('color', 'red');
	 				 }
	 				  // check if the written classification exit or not
	 				if(responseClassification == "taken"){
	 					$("#responseClassification").html("<p class='alert alert-danger' style='Display: none'>**This classification already exists.</p>");
	 					$("#responseClassification .alert").slideDown("slow"); 
	 					$("#responseClassification").css('color', 'red');
	 				 }

	 				   //when creating new classification is successfull
	 				if(responseClassification == "success"){
	 					$("#responseClassification").html("<div class='alert alert-success' style='Display: none'>Updating classification is successful.</div>");
	 					$("#responseClassification .alert").slideDown("slow");
	 				}
 				}
 			});
 		});
 	});
 </script>