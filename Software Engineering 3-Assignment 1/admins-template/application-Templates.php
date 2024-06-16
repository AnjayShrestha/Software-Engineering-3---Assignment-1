<?php 
// clientDetails-Templates.php
require('../db/database.php');
require('../db/databaseTable.php');


 ?>

<main id="clientDetails">
	<div class="container">
		<br>
		<h1 class="alert alert-secondary" style="margin-right: 25%;">Applications</h1>
		<br>

		<?php
			echo '<table class="alert alert-secondary">';
			echo '<thead>';
			echo '<tr>';
			echo '<th>Fullname</th>';
			echo '<th style="width: 10%">Username</th>';
			echo '<th style="width: 10%">Gender</th>';
			echo '<th style="width: 10%">Type</th>';
			echo '<th style="width: 15%">Email_Address</th>';
			echo '<th style="width: 15%">Registered Date</th>';
			// echo '<th style="width: 5%">&nbsp;</th>';
			echo '<th style="width: 15%">&nbsp;</th>';
			echo '</tr>';


			$sql = "SELECT * FROM clients WHERE adminApprove = 0 ORDER BY applied DESC";
			$statement = $pdo->prepare($sql);
			$statement->execute();
			$clients = $statement->fetchAll();
			
			//display clients information.
			foreach ($clients as $client) {
				echo '<tr class="dropdown-divider">';
				echo '<td>' . $client['fullname'] . '</td>';
				echo '<td>' . $client['username'] . '</td>';
				echo '<td>' . $client['gender'] . '</td>';
				echo '<td>' . $client['type'] . '</td>';
				echo '<td>' . $client['email']. '</td>';
				echo '<td>' . $client['applied'] . '</td>';
				echo '<td><a class="btn btn-info" href="admins.php?admin=allView&id='.$client['client_id'].'">View Details</></td>';
				echo '</tr>';
			}
			echo '</thead>';
			echo '</table>';
			?>
	</div>
</main>