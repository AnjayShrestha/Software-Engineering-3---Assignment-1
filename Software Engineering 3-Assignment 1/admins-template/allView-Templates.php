<?php 
require('../db/database.php');
require('../db/databaseTable.php');

$id=$_GET['id'];
$client = $pdo->query("SELECT * FROM clients  WHERE client_id = '$id' AND emailVerify = 0 AND adminApprove = 0")->fetch();
 	$key 	 = $client['emKey'];
 	$to 	 = $client['email'];
if (isset($_POST['approveApplication'])) {
	// $cid = $id;
 	$sql = "UPDATE clients SET adminApprove = 1 WHERE client_id = '$id'";
 	$statement = $pdo->prepare($sql);
 	$statement->execute();

 	// sent mail
	$subject = "Email Verification";
	$message = "Dear applicant, congratulation your application has been approved. Now, confirm to validate this email is yours.<a  href='http://localhost/SE3-as1/layouts/verify.php?vKey=$key'>Confirm.</a>";
	$headers = "From: multigram1212@gmail.com";
	$headers .= "MIME-Version: 1.0"."\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8"."\r\n";

	if(mail($to, $subject, $message, $headers)) {
	    ?>
		<script>
			alert('verification mail sent.');
		</script>
		<?php
	   
	  }else{
	    ?>
		<script>
			alert('Failed to sent verification mail.');
		</script>
		<?php
	  }	

 	
	header("Refresh: 0.5; url=admins.php?admin=application");
}

if (isset($_POST['deleteApplication'])) {

	$sql = "DELETE FROM clients WHERE client_id = '$id' AND adminApprove = 0";
 	$statement = $pdo->prepare($sql);
 	$statement->execute();

 	// sent mail
 	
	$subject = "Application cancelled";
	$message = "Dear applicant, we regret to inform you that your application has been cancelled.";
	$headers = "From: multigram1212@gmail.com";
	$headers .= "MIME-Version: 1.0"."\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8"."\r\n";

	if(mail($to, $subject, $message, $headers)) {
		?>
		<script>
			alert('cancelled mail sent.');
		</script>
		<?php
	   
	  }else{
	    ?>
		<script>
			alert('Failed to sent cancelled mail.');
		</script>
		<?php
	  }
	header("Refresh: 0.5; url=admins.php?admin=application.");
	  	
}

 ?>


 <main id="allview" class="alert alert-secondary" style="margin-left:20%; margin-right:20%">
<div class="container">
		<div class="container">
		<br>
		<h1>Approve / Delete Application</h1>
		<form class="AddNewAdmin" action="" method="POST">
			<label>Fullname:</label>
			<input type="hidden" name="cid" value="<?php echo $client['client_id'] ?>">
			<input type="text" class="form-control" disabled="true" name="fullname" value="<?php echo $client['fullname'] ?>"><br>
			
			<label>Username</label>
			<input type="text" class="form-control" disabled="true" name="username" value="<?php echo $client['username'] ?>"><br>

			<label>Gender:</label>
			<input type="text" class="form-control" disabled="true" name="gender" value="<?php echo $client['gender'] ?>">
			<br>

			<label>Application for:</label>
			<input type="text" class="form-control" disabled="true" name="application" value="<?php echo $client['type'] ?>">
			<br>
			
			<label>Email_Address:</label>
			<input type="text" class="form-control" disabled="true" name="emailAddress" value="<?php echo $client['email'] ?>"><br>
			
			<div class="container">
			<button type="submit" name="approveApplication" class="btn btn-dark">Approve</button>
			<button type="submit" name="deleteApplication" class="btn btn-dark">Delete</button>
			</div>
			
		</form>
	</div>
</div>
 	
 </main>