<?php
require('../db/database.php');
$id = $_GET['id'];
$category_name = $pdo->query("SELECT * FROM categories WHERE category_id = '$id'")->fetch();
session_start();
if(isset($_SESSION['a_id']))
{
 header('Refresh: 1; url =../MAIN/admins.php');
 
 }

else
{
?>
<!DOCTYPE html>
<html>
<head>
	<title>Forthby's Auction House</title>
	<!-- <link rel="stylesheet" type="text/css" href="../Styles/bootstrap.css"> -->
 	<link rel="stylesheet" type="text/css" href="../styles/Style.css">
 	<!-- bootstrap property -->
 	<link rel="stylesheet" href="../Bootstrap/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="../Bootstrap/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="../Bootstrap/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="../Bootstrap/bootstrap.min.js"></script>
</head>

<body id="users">
	<header id="index_header">
		<div id="navbar">
			<?php include('../Include/navbar.php'); ?>
		</div>
	</header>
	
	<main id="category" style="margin-top: 1%;margin-left: 10%; margin-right: 10%;"> 
		<h1 class="alert alert-secondary">Category: <?php echo $category_name['category']; ?> </h1><br>
	<?php 
	
	$query = "SELECT * FROM auctions WHERE category_id = '$id' AND archive = 0 ORDER BY timestamp DESC";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach ($result as $row) {
	?>
	<div class="alert alert-secondary" style=" margin-bottom: 2%; width: 100%; display: flex; flex-direction: row; padding: 2%;">
		<div id="auctionImage" style="padding: 1%; width: 30%">
			<label><b>Auction Image:</b></label><br>
			<img src="../images/<?php echo $row['auction_image'] ?>" style="border-radius: 5%;width: 80%;">
		</div>
		<div id="auctionInformation" style="width: 70%">
			
			<label><b><?php echo $row['title'] ?></b></label><br>
			<label>Artist: <?php echo $row['artist'] ?></label><br>
			<label>Category: <a style="color: black" href="category.php?id=<?php echo $row['category_id']?>"><?php echo get_category($pdo, $row['category_id']) ?></a></label><br>

			<label>Classification:<a  style="color: black" href="classification.php?id=<?php echo $row['classification']?>"> <?php echo get_classification($pdo, $row['classification']) ?></a></label><br>

			<label>Estimated Price: <?php echo '£'.$row['estimated_price'] ?></label><br>
			<a class="btn btn-light" href="auctionDetails.php?id=<?php echo $row['auction_id']?>">Show Details</a>
		</div>
	</div>
	<?php 
	}
	?>
	</main>

	<footer class="alert alert-secondary" style="margin-top: 5%; margin-bottom: 0;">
		<p style="text-align: center;">(c) 2019. Forthby's Auction House</p>
	</footer>
</body>

</html>
<?php }

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
	} ?>