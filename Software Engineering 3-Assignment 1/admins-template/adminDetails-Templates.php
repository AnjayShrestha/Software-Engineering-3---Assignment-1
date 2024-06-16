<?php 
// adminDetails-Templates.php
require('../db/database.php');
require('../db/databaseTable.php');
if(isset($_POST['deleteadmin'])) {
 	$admin_id = $_POST['id'];
 	$sql = "DELETE FROM admin WHERE admin_id = '$admin_id'";
 	$statement = $pdo->prepare($sql);
 	$statement->execute();
 	echo 'Admin account deleted';
	header("Refresh: 0.5; url=admins.php?admin=adminDetails");
 }
 else{

 ?>

<main id="adminDetails">
	<div class="container">
		<br>
		<a href="admins.php?admin=addAdmin" class="btn btn-secondary">Create New Admins</a>
		<br><br>

		<?php
			echo '<table class="alert alert-secondary">';
			echo '<thead>';
			echo '<tr>';
			echo '<th>Fullname</th>';
			echo '<th style="width: 10%">Username</th>';
			echo '<th style="width: 10%">Gender</th>';
			echo '<th style="width: 15%">Email_Address</th>';
			echo '<th style="width: 15%">Registered Date</th>';
			// echo '<th style="width: 5%">&nbsp;</th>';
			echo '<th style="width: 5%">&nbsp;</th>';
			echo '</tr>';


			$sql = "SELECT * FROM admin ORDER BY registeredDate DESC";
			$statement = $pdo->prepare($sql);
			$statement->execute();
			$admins = $statement->fetchAll();
			
			//display admins information.
			foreach ($admins as $admin) {
				echo '<tr class="dropdown-divider">';
				echo '<td>' . $admin['fullname'] . '</td>';
				echo '<td>' . $admin['username'] . '</td>';
				echo '<td>' . $admin['gender'] . '</td>';
				echo '<td>' . $admin['emailAddress']. '</td>';
				echo '<td>' . $admin['registeredDate'] . '</td>';
				echo '<td><form method="post" action="">
				<input type="hidden" name="id" value="' .$admin['admin_id'].'" />
				<input type="submit" class="btn btn-danger" name="deleteadmin" value="Delete" />
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