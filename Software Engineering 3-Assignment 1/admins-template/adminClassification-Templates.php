<?php
// adminCategory-Templates.php
require('../db/database.php');
require('../db/databaseTable.php');
if(isset($_POST['deleteCategory'])) {
 	$id = $_POST['id'];
 	$sql = "DELETE FROM classification WHERE classification_id = '$id'";
 	$statement = $pdo->prepare($sql);
 	$statement->execute();
 	echo 'Category deleted';
	header("Refresh: 0.5; url=admins.php?admin=adminClassification");
 }
 else{

 ?>

<main id="adminCategory">
	<div class="container">
		<br>
		<a href="admins.php?admin=addClassification" class="btn btn-secondary">Create New Category</a>
		<br><br>

		<?php
			echo '<table class="alert alert-secondary">';
			echo '<thead>';
			echo '<tr>';
			echo '<th>Classification</th>';
			echo '<th style="width:20%">Created Date</th>';
			echo '<th style="width: 5%">&nbsp;</th>';
			echo '<th style="width: 5%">&nbsp;</th>';
			echo '</tr>';


			$sql = "SELECT * FROM classification ORDER BY classification";
			$statement = $pdo->prepare($sql);
			$statement->execute();
			$classifications = $statement->fetchAll();
			
			//display admins information.
			foreach ($classifications as $classification) {
				echo '<tr class="dropdown-divider">';
				echo '<td>' . $classification['classification'] . '</td>';
				echo '<td>' . $classification['timestamp']. '</td>';
				echo '<td><a class="btn btn-dark" style="float: right" href="admins.php?admin=editClassification&id=' . $classification['classification_id'] . '">Edit</a></td>';//this will take you to edit classification
				echo '<td><form method="post" action="">
				<input type="hidden" name="id" value="' . $classification['classification_id'] . '" />
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
