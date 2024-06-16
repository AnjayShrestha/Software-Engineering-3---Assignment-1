<?php 
// clientDetails-Templates.php
require('../db/database.php');
require('../db/databaseTable.php');



if(isset($_POST['deleteclient'])) {
 	$client_id = $_POST['id'];

 	$client = $pdo->query("SELECT * FROM clients WHERE client_id = '$client_id'")->fetch();
 	$to 	 = $client['email'];

 	$sql = "DELETE FROM clients WHERE client_id = '$client_id'";
 	$statement = $pdo->prepare($sql);
 	$statement->execute();

 	$subject = "Account Deleted";
	$message = "Dear client, we regret to inform you that your account has been deleted from the system.";
	$headers = "From: multigram1212@gmail.com";
	$headers .= "MIME-Version: 1.0"."\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8"."\r\n";

	if(mail($to, $subject, $message, $headers)) {
		?>
		<script>
			alert('deletion mail sent');
		</script>
		<?php
	   
	  }else{
	    ?>
		<script>
			alert('Failed');
		</script>
		<?php
	  }	

 	// echo 'client account deleted';
	header("Refresh: 0.5; url=admins.php?admin=clients");
 }
 else{

 ?>

<main id="clientDetails">
	<div class="container">
		<br>
		<h1 class="alert alert-secondary" style="margin-right: 25%;">Clients list</h1>
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


			$sql = "SELECT * FROM clients WHERE adminApprove = 1 AND emailVerify = 1 ORDER BY 
			type DESC";
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
				echo '<td><form method="post" action="">
				<input type="hidden" name="id" value="' .$client['client_id'].'" />
				<input type="submit" class="btn btn-danger" name="deleteclient" value="Delete" />
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