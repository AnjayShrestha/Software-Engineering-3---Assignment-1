<?php

//fetch_data.php

include('../db/database.php');

if(isset($_POST["action"]))
{
	$query = "
		SELECT * FROM auctions WHERE archive = '0'
	";
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND estimated_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}

	if(isset($_POST["artist"]))
	{
		$artist_filter = implode("','", $_POST["artist"]);
		$query .= "
		 AND artist IN('".$artist_filter."')
		";
	}

	if(isset($_POST["category"]))
	{
		$category_filter = implode("','", $_POST["category"]);
		$query .= "
		 AND category_id IN('".$category_filter."')
		";
	}
	if(isset($_POST["classification"]))
	{
		$classification_filter = implode("','", $_POST["classification"]);
		$query .= "
		 AND classification IN('".$classification_filter."')
		";
	}

	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';
	if($total_row > 0)
	{
		foreach($result as $row)
		{
			$output .= '
			<div class="alert alert-secondary" style="display:flex; flex-direction: row;">
				<div style="width: 40%; ">
					<img width="100%" style="border:1px solid #ccc;border-radius:5px;" src="../images/'. $row['auction_image'] .'" alt="" class="img-responsive" >
					
				</div>
				<div  style="width: 60%; margin-left: 2%;">
				<p><strong> '. $row['title'] .'</strong></p>
					<p>Artist: '. $row['artist'] .'</p>
					<p>Category: '. get_category($pdo, $row['category_id']) .'</p>
					<p>Classification: '. get_classification($pdo,$row['classification']) .'</p>
					<h4>Estimated Price: £'. $row['estimated_price'] .'</h4>
					<a class="btn btn-light" href="auctionDetails.php?id= '.$row['auction_id'].'">Show Details</a>
				</div>

			</div>
			';
		}
	}
	else
	{
		$output = '<h3>No Data Found</h3>';
	}
	echo $output;
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
		return  ''.$row['category'].'';
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
		return  ''.$raw['classification'].'';
		}
	}

?>