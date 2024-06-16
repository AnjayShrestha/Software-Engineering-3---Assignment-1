<?php 
// auctions-Templates.php
require('../db/database.php');
require('../db/databaseTable.php');
if (isset($_POST['deleteAuction'])) {
	$id = $_POST['id'];
 	$sql = "DELETE FROM auctions WHERE auction_id = '$id'";
 	$statement = $pdo->prepare($sql);
 	$statement->execute();
 	echo 'Auction deleted';
	header("Refresh: 0.5; url=admins.php?admin=auctions");
}
if (isset($_POST['dearchive'])) {
	$query = "UPDATE auctions
				SET archive = 0
				WHERE auction_id = :a_id";
		$result = [
			'a_id' => $_POST['id']
		];
		$stmt = $pdo->prepare($query);
		if($stmt->execute($result)){
				echo 'Auction DeArchived Successfully';
				echo '<a href="admins.php?admin=auctions" class="btn btn-secondary">Show all Auction Details</a>';
			}
}
else{
 ?>
<main id="formDetails">
	<div class="container">
		<br>

		<?php
			echo '<table class="alert alert-secondary">';
			echo '<thead>';
			echo '<tr>';
			echo '<th style="width: 12%">Lot_number</th>';
			echo '<th style="width: 15%">Image</th>';
			echo '<th style="width: 20%">Category</th>';
			echo '<th style="width: 10%">Year</th>';
			echo '<th style="width: 10%">classification</th>';
			echo '<th style="width: 10%">Auction</th>';
			echo '<th style="width: 10%">Price</th>';
			echo '<th style="width: 10%">&nbsp;</th>';
			echo '<th style="width: 5%">&nbsp;</th>';
			echo '</tr>';

			$sql = "SELECT * FROM auctions WHERE archive = 1
			 ORDER BY timestamp DESC";
			$statement = $pdo->prepare($sql);
			$statement->execute();
			$forms = $statement->fetchAll();
			
			//display forms information.
			foreach ($forms as $form) {
				echo '<tr class="dropdown-divider">';
				echo '<td>' . $form['lot_number'] . '</td>';
				echo '<td><img src="../images/' . $form['auction_image'] . '" width="40%"></img></td>';
				echo '<td>' .get_category($pdo, $form['category_id']). '</td>';
				echo '<td>' . $form['work_produced_year']. '</td>';
				echo '<td>' . get_classification($pdo, $form['category_id']). '</td>';
				echo '<td>' . $form['auction_date'] . '</td>';
				echo '<td> £' . $form['estimated_price'] . '</td>';
				echo '<td><form method="post" action="">
				<input type="hidden" name="id" value="' .$form['auction_id'].'" />
				<input type="submit" class="btn btn-dark" name="dearchive" value="Dearchive" />
					</td>';
				echo '<td>
				
				<input type="submit" class="btn btn-danger" name="deleteAuction" value="Delete" />
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
	}
?>