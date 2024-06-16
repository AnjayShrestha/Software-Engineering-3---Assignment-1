<?php
// adminCategory-Templates.php
require('../db/database.php');
require('../db/databaseTable.php');
if(isset($_POST['deleteCategory'])) {
 	$id = $_POST['id'];
 	$sql = "DELETE FROM categories WHERE category_id = '$id'";
 	$statement = $pdo->prepare($sql);
 	$statement->execute();
 	echo 'Category deleted';
	header("Refresh: 0.5; url=admins.php?admin=adminCategory");
 }
 else{

 ?>

<main id="adminCategory">
	<div class="container">
		<br>
		<a href="admins.php?admin=addCategory" class="btn btn-secondary">Create New Category</a>
		<br><br>

		<?php
			echo '<table class="alert alert-secondary">';
			echo '<thead>';
			echo '<tr>';
			echo '<th>Category</th>';
			echo '<th style="width: 20%">Created Date</th>';
			echo '<th style="width: 5%">&nbsp;</th>';
			echo '<th style="width: 5%">&nbsp;</th>';
			echo '</tr>';


			$sql = "SELECT * FROM categories ORDER BY category";
			$statement = $pdo->prepare($sql);
			$statement->execute();
			$admins = $statement->fetchAll();
			
			//display admins information.
			foreach ($admins as $admin) {
				echo '<tr class="dropdown-divider">';
				echo '<td>' . $admin['category'] . '</td>';
				echo '<td>' . $admin['timestamp']. '</td>';
				echo '<td><a class="btn btn-dark" style="float: right" href="admins.php?admin=editCategory&id=' . $admin['category_id'] . '">Edit</a></td>';//this will take you to edit category
				echo '<td><form method="post" action="">
				<input type="hidden" name="id" value="' . $admin['category_id'] . '" />
				<input type="submit" class="btn btn-danger" name="deleteCategory" value="Delete" />
				</form></td>';
				echo '</tr>';
			}

			echo '</thead>';
			echo '</table>';
			?>
	</div>
</main>


<?php 
}
 ?>
