<?php
include("../db/database.php");
// require('../db/databaseTable.php');
session_start();
 ?>
 
 <?php 
 if(isset($_SESSION['a_id'])){
 
 ?>
 		<!DOCTYPE html>
 <html>
 <head>
 	<link rel="stylesheet" type="text/css" href="../styles/styles.css">
 	<!-- bootstraps property -->
 	<link rel="stylesheet" href="../Bootstrap/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="../Bootstrap/jquery-ui.css">
	
	<!-- jQuery library -->
	<script src="../Bootstrap/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="../Bootstrap/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="../Bootstrap/bootstrap.min.js"></script>

		
	<script src="../Bootstrap/jquery-1.12.4.js"></script>

	<script src="../Bootstrap/jquery-ui.js"></script>


	<script src="../Bootstrap/jquery.form.js"></script>

 	<title>
 	</title>
 </head>
 <body>
 <header class="adminHeader">
 	<div id="navbar">
			<?php include('../Include/adminNavBar.php'); ?>
		</div>
 </header>
 		<?php
 		echo $content;
 		?>

<footer class="alert alert-secondary" style=" margin-top: 1%; margin-bottom: 0;">
		<p style="text-align: center;">(c) 2019. Forthby's Auction House</p>
	</footer>

 </body>
 </html>
 		<?php 
 	}
 	else
 	{
 		header('Refresh: 1; url =../layouts/index.php');
 	}
 	?>		
 

