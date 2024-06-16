<?php 
// editCategory-Templates

require('../db/database.php');
require('../db/databaseTable.php');
$id = $_GET['id'];
$category = $pdo->query("SELECT * FROM categories WHERE category_id = '$id'")->fetch();
 
 ?>
<!-- main section foe edit category -->
 <main id="editCategory" class="alert alert-secondary" style="padding: 2%; border-radius: 5px; margin-top: 2%; margin-left: 30%; margin-right: 30%;">

 	<div class="container">
		<a href="admins.php?admin=adminCategory" class="btn btn-secondary">Get Back to Category</a>
		<br><br>
 		<form class="editCategory" action="" method="POST">
			<input type="hidden" name="Cid" value="<?php echo $category['category_id'] ?>">

 			<h1>Edit Category</h1>
 			<br>
 			<label>Category:</label>
 			<input type="text" class="form-control" name="category" value="<?php echo $category['category'] ?>">
 			<br>
 			<button type="submit" name="editCategory" class="btn btn-dark">Edit Category</button>
 			
 		</form>
 		<div id="responseCategory"></div>
 		<!-- this responseCategory div will alert -->
 	</div>

 </main>
 <script type="text/javascript">
 	$(function(){
 		$(document).on("submit", ".editCategory", function(event){
 			event.preventDefault();
 			$.ajax({
 				type: "POST",
 				url:  "../databaseWork/updateCategory.php",
 				data:$(this).serialize(),
 				success: function(responseCategory){
	 					// check if any input is empty
	 				if(responseCategory == "empty"){
	 					// alert('working');
	 					$("#responseCategory").html("<p class='alert alert-danger' style='Display: none'>**Empty input, Please enter a valid input.</p>");
	 					$("#responseCategory .alert").slideDown("slow"); 
	 					$("#responseCategory").css('color', 'red');
	 				 }
	 				 // check the category
	 				if(responseCategory == "invalid"){
	 					$("#responseCategory").html("<p class='alert alert-danger' style='Display: none'>**Category is invalid.</p>");
	 					$("#responseCategory .alert").slideDown("slow"); 
	 					$("#responseCategory").css('color', 'red');
	 				 }
	 				  // check if the written category exit or not
	 				if(responseCategory == "taken"){
	 					$("#responseCategory").html("<p class='alert alert-danger' style='Display: none'>**This Category already exists.</p>");
	 					$("#responseCategory .alert").slideDown("slow"); 
	 					$("#responseCategory").css('color', 'red');
	 				 }

	 				   //when creating new category is successfull
	 				if(responseCategory == "success"){
	 					$("#responseCategory").html("<div class='alert alert-success' style='Display: none'>Updating category is successful.</div>");
	 					$("#responseCategory .alert").slideDown("slow");
	 				}
 				}
 			});
 		});
 	});
 </script>


