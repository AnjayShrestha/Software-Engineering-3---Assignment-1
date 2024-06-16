<?php 
require('../db/database.php');
require('../db/databaseTable.php');
$id = $_GET['id'];


 ?>
<main id="showAuctionDetails" style="margin-top: 1%;margin-left: 10%; margin-right: 10%;">
		<!-- <h1 class="alert alert-secondary">Auction Details</h1><br> -->
	<?php 	
	$query = "SELECT * FROM auctions WHERE auction_id = '$id' AND archive = 0 ORDER BY timestamp DESC";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach ($result as $row) {
	?>
	<div class="alert alert-secondary" style=" margin-bottom: 2%; width: 100%; padding: 2%;">
		
		<div id="auctionInformation" style="width: 100%">


			<!-- title of auction -->
			<div id="sides" style="display: flex;flex-direction: row; width: 100%">
				<div id="left" style="background: grey; width: 30%;text-align: right;">
					<b style="margin:1%; color: white;">Auction Title</b>
				</div>
				<div id="right" style="background: white; margin-left: 1%; width: 70%;">
					<p style="margin:1%; margin-top: 0;" ><?php echo $row['title'] ?></p>
				</div>
			</div>

			<!-- this division will show the location of the auction. -->
			<div id="sides" style="display: flex;flex-direction: row;margin-top: 1%; width: 100%">
				<div id="left" style="background: grey; width: 30%;text-align: right;">
					<b style="margin:1%; color: white;">Location</b>
				</div>
				<div id="right" style="background: white; margin-left: 1%; width: 70%;">
					<p style="margin:1%; margin-top: 0;"><?php echo $row['location'] ?></p>
				</div>
			</div>

					<!-- this division will show the auction lot reference number -->
			<div id="sides" style="display: flex;flex-direction: row;margin-top: 1%; width: 100%">
				<div id="left" style="background: grey; width: 30%; text-align: right;">
					<b style="margin:1%; color: white;">Lot Reference Number</b>
				</div>
				<div id="right" style="background: white; margin-left: 1%; width: 70%;">
					<p style="margin:1%; margin-top: 0;"><?php echo $row['lot_number'] ?></p>
				</div>
			</div>

			<!-- this div will show auction lot number -->
			<div id="sides" style="display: flex;flex-direction: row;margin-top: 1%; width: 100%">
				<div id="left" style="background: grey; width: 30%;text-align: right;">
					<b style="margin:1%; color: white;">Lot Number</b>
				</div>
				<div id="right" style="background: white; margin-left: 1%; width: 70%;">
					<p style="margin:1%; margin-top: 0;"><?php echo $row['auction_id'] ?></p>
				</div>
			</div>

			<!-- this div will show auction production date -->
			<div id="sides" style="display: flex;flex-direction: row;margin-top: 1%; width: 100%">
				<div id="left" style="background: grey; width: 30%;text-align: right;">
					<b style="margin:1%; color: white;">Period/Date of Production</b>
				</div>
				<div id="right" style="background: white; margin-left: 1%; width: 70%;">
					<p style="margin:1%; margin-top: 0;"><?php echo $row['work_produced_year'] ?></p>
				</div>
			</div>

			<!--this div will show piece title.  -->

			<div id="sides" style="display: flex;flex-direction: row;margin-top: 1%; width: 100%">
				<div id="left" style="background: grey; width: 30%;text-align: right;">
					<b style="margin:1%; color: white;">Piece Title</b>
				</div>
				<div id="right" style="background: white; margin-left: 1%; width: 70%;">
					<p style="margin:1%;margin-top: 0;"><?php echo $row['piece_title'] ?></p>
				</div>
			</div>

			<!-- this div will show auction category. -->
			<div id="sides" style="display: flex;flex-direction: row;margin-top: 1%; width: 100%">
				<div id="left" style="background: grey; width: 30%;text-align: right;">
					<b style="margin:1%; color: white;">Category</b>
				</div>
				<div id="right" style="background: white; margin-left: 1%; width: 70%;">
					<p style="margin:1%; margin-top: 0;"><?php echo get_category($pdo, $row['category_id']) ?></p>
				</div>
			</div>


			<!-- this div will show auction classification -->
			<div id="sides" style="display: flex;flex-direction: row;margin-top: 1%; width: 100%">
				<div id="left" style="background: grey; width: 30%;text-align: right;">
					<b style="margin:1%; color: white;">Classification</b>
				</div>
				<div id="right" style="background: white; margin-left: 1%; width: 70%;">
					<p style="margin:1%; margin-top: 0;"><?php echo get_classification($pdo, $row['classification']) ?></p>
				</div>
			</div>

			<!-- this div will show auction estimated price -->
			<div id="sides" style="display: flex;flex-direction: row;margin-top: 1%; width: 100%">
				<div id="left" style="background: grey; width: 30%;text-align: right;">
					<b style="margin:1%; color: white;">Estimated Price</b>
				</div>
				<div id="right" style="background: white; margin-left: 1%; width: 70%;">
					<p style="margin:1%; margin-top: 0;"><?php echo $row['estimated_price'].' British pounds' ?></p>
				</div>
			</div>

			<!-- this div will show the name of auction artist. -->
			<div id="sides" style="display: flex;flex-direction: row;margin-top: 1%; width: 100%">
				<div id="left" style="background: grey; width: 30%;text-align: right;">
					<b style="margin:1%; color: white;">Artist</b>
				</div>
				<div id="right" style="background: white; margin-left: 1%; width: 70%;">
					<p style="margin:1%; margin-top: 0;"><?php echo $row['artist'] ?></p>
				</div>
			</div>	

			<!-- this div will show the auction date -->
			<div id="sides" style="display: flex;flex-direction: row;margin-top: 1%; width: 100%">
				<div id="left" style="background: grey; width: 30%;text-align: right;">
					<b style="margin:1%; color: white;">Auction Date</b>
				</div>
				<div id="right" style="background: white; margin-left: 1%; width: 70%;">
					<p style="margin:1%; margin-top: 0;"><?php echo $row['auction_date'] ?></p>
				</div>
			</div>


			<!-- this div will show the period of auction held -->
			<div id="sides" style="display: flex;flex-direction: row;margin-top: 1%; width: 100%">
				<div id="left" style="background: grey; width: 30%;text-align: right;">
					<b style="margin:1%; color: white;">Auctoin period</b>
				</div>
				<div id="right" style="background: white; margin-left: 1%; width: 70%;">
					<p style="margin:1%; margin-top: 0;"><?php echo $row['period'] ?></p>
				</div>
			</div>

			<!-- this div will show description of auction -->
			<div id="sides" style="display: flex;flex-direction: row;margin-top: 1%; width: 100%">
				<div id="left" style="background: grey; width: 30%;text-align: right;">
					<b style="margin:1%; color: white;">Lot Description</b>
				</div>
				<div id="right" style="background: white; margin-left: 1%; width: 70%;">
					<p style="margin:1%; margin-top: 0;"><?php echo $row['description'] ?></p>
				</div>
			</div>
		</div>
		<!-- this div will show the images of auction -->
		<div id="auctionImage" style="padding: 1%; width: 100%">
			<img src="../images/<?php echo $row['auction_image'] ?>" style="border: 1px solid black; width: 100%;">
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


