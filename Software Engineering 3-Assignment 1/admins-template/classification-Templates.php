<?php 
require('../db/database.php');
require('../db/databaseTable.php');
$id = $_GET['id'];
$classification_name = $pdo->query("SELECT * FROM classification WHERE classification_id = '$id'")->fetch();
// fetching classification details.
 ?>
<main id="adminClassification" style="margin-top: 1%;margin-left: 10%; margin-right: 10%;">
		<h1 class="alert alert-secondary">Classification: <?php echo $classification_name['classification']; ?> </h1><br>
	<?php 
	
	$query = "SELECT * FROM auctions WHERE classification = '$id' AND archive = 0 ORDER BY timestamp DESC";
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
			<!-- <input type="hidden" name="id" value="<?php //echo $row['auction_id']?>"> -->
			<label><b><?php echo $row['title'] ?></b></label><br>
			<label>Artist: <?php echo $row['artist'] ?></label><br>
			<label>Category: <a style="color: black" href="admins.php?admin=category&id=<?php echo $row['category_id']?>"><?php echo get_category($pdo, $row['category_id']) ?></a></label><br>

			<label>Classification:<a  style="color: black" href="admins.php?admin=classification&id=<?php echo $row['classification']?>"> <?php echo get_classification($pdo, $row['classification']) ?></a></label><br>

			<label>Estimated Price: <?php echo '£'.$row['estimated_price'] ?></label><br>
			<a class="btn btn-light" href="admins.php?admin=showAuctionDetails&id=<?php echo $row['auction_id']?>">Show Details</a>
		</div>
	</div>
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
</main>


