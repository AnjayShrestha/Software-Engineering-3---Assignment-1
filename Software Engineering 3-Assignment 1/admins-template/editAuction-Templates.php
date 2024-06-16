<?php
require '../db/database.php';//connect to database
require('../db/databaseTable.php');
?>
<section id="addNewAdmin" class="alert alert-secondary" style="margin-top: 2%; padding: 2%; border-radius: 5px; margin-left: 30%; margin-right: 30%; margin-bottom: 5%;">
	<?php 
	if (isset($_POST['updateAuction'])) {
	
	if(isset($_POST["auctionTitle"])){
	$title = $_POST["auctionTitle"];
	}

	if(isset($_POST["pieceTitle"])){
	$piece = $_POST["pieceTitle"];
	}

	if(isset($_POST["location"])){
	$location = $_POST["location"];
	}

	if(isset($_POST["artist"])){
	$artist = $_POST["artist"];
	}

	if(isset($_POST["workYear"])){
		$workYear = $_POST["workYear"];
	}
	if(isset($_POST["classification"])){
	$classification = $_POST["classification"];
	}

	if(isset($_POST["category"])){
	$category = $_POST["category"];
	}

	if(isset($_POST["auctionDate"])){
	$auctionDate = $_POST["auctionDate"];
	}
	if (isset($_POST["auctionPeriod"])) {
		$period = $_POST["auctionPeriod"];
	}

	if(isset($_POST["estimatedPrice"])){
	$estimatedPrice = $_POST["estimatedPrice"];
	}

	if(isset($_POST["description"])){
	$description = $_POST["description"];
	}
	//check if any input is empty or not.
	if (empty($artist)  || empty($title) || empty($location)  || empty($piece)  || empty($category) || empty($description)  || empty($workYear) || empty($classification) || empty($auctionDate) || empty($period) || empty($estimatedPrice)) {
		echo "Please fill all the input.";
		echo '<a href="admins.php?admin=editAuction&id='.$_POST['id'].'" class="btn btn-secondary">Get back</a>';	
	}
	else{
		// check if artist name is valid or not
		if ((!preg_match("/^[A-Z][a-zA-Z -]+$/", $artist))||(!preg_match("/^[A-Z][a-zA-Z -]+$/", $location))) {
			echo 'Artist name/ location is invalid';
			echo '<a href="admins.php?admin=editAuction&id='.$_POST['id'].'" class="btn btn-secondary">Get back</a>';
		}
		else{
		$auctions = $pdo->query("SELECT * FROM auctions ORDER BY timestamp DESC")->fetch();
		 $file_name = '';
		 if(isset($_POST['image']))
		 {
		  $file_name = $_POST['image'];
		 }
		if($_FILES['image']['name'] != '')
			 {
			  if($file_name != '')
			  {
			   unlink('../images/'.$file_name);
			  }
			  $image_name = explode(".", $_FILES['image']['name']);
			  $extension = end($image_name);
			  $temporary_location = $_FILES['image']['tmp_name'];
			  $file_name = rand() . '.' . strtolower($extension);
			  $location = '../images/' . $file_name;
			  move_uploaded_file($temporary_location, $location);
			 }
			// updating the auction information 
			$stmt = $pdo->prepare('UPDATE auctions
								SET title = :title,
								piece_title = :piece,
								category_id = :category_id,
						 	    auction_image = :auction_image,
						 	    location = :location,
						 	    artist = :artist,
						 	    work_produced_year = :work_produced_year,
						 	    classification = :classification,
						 	    description = :description,
				 			    auction_date = :auction_date,
				 			    period = :period,
					 	    	estimated_price = :estimated_price
								WHERE auction_id = :a_id;
								');
			$result = [
			'a_id'			=> $_POST['id'],
			'title'			=> $_POST['auctionTitle'],
			'piece' 	=> $_POST['pieceTitle'],
			'category_id' => $_POST['category'],
			'artist' => $_POST['artist'],
			'auction_image' => $file_name,
			'location'	=> $_POST['location'],
			'work_produced_year' => $_POST['workYear'],
			'classification' => $_POST['classification'],
			'description' => $_POST['description'],
			'auction_date' => $_POST['auctionDate'],
			'period'	=> $_POST['auctionPeriod'],
			'estimated_price' => $_POST['estimatedPrice']
			];
			
			if($stmt->execute($result)){
				echo 'Auction updated Successfully';
				echo '<a href="admins.php?admin=auctions" class="btn btn-secondary">Show all Auction Details</a>';
			}
			
			}
		}
	}
	if (isset($_POST['archiveAuction'])) {
		$query = "UPDATE auctions
				SET archive = 1
				WHERE auction_id = :a_id";
		$result = [
			'a_id' => $_POST['id']
		];
		$stmt = $pdo->prepare($query);
		if($stmt->execute($result)){
				echo 'Auction archived Successfully';
				echo '<a href="admins.php?admin=auctions" class="btn btn-secondary">Show all Auction Details</a>';
			}

	}
	else {
		$id = $_GET['id'];
	 	$auction = $pdo->query("SELECT * FROM auctions WHERE auction_id = '$id'")->fetch();
	 	// fetching auction details for selected auction
		// $auction = $pdo->query("SELECT * FROM auctions WHERE auction_id = '$id'")->fetch();
		
		?>


			<h2>Update Auction</h2>
			<!-- form to add article. -->
			<form action="" class="addNewAuction" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $auction['auction_id'] ?>">
				<!-- auction title section -->
				<label>Auction Title:</label>
				<input type="text" class="form-control" name="auctionTitle" value="<?php echo $auction['title'] ?>"><br>

				<!-- piece title -->
				<label>Piece Title:</label>
				<input type="text" class="form-control" name="pieceTitle" value="<?php echo $auction['piece_title'] ?>"><br>

			<!--  -->
				<!-- artist name section -->
				<label>Artist name:</label>
				<input type="text" class="form-control" name="artist" value="<?php echo $auction['artist'] ?>" ><br>

				<!-- auction image section -->
				<label>Auction Image:</label>
				<input type="file" class="form-control" name="image">
				
				<?php 
		         if($auction["auction_image"] != '')
		         {
		          echo '<img src="../images/'.$auction["auction_image"].'" class="img-thumbnail" width="150" />';
		          echo '<input type="hidden" name="image" value="'.$auction["auction_image"].'" />';
		         }
		         ?>	
				<br>
				<br>

				<!-- location section -->
				<label>Location:</label>
				<input type="text" class="form-control" name="location" value="<?php echo $auction['location'] ?>" ><br>

				<label>Work Produced Year:</label>
				<input type="date" class="form-control" name="workYear"  value="<?php echo $auction['work_produced_year'] ?>" ><br>

				<label>Classification:</label>
				<select class="form-control" name="classification">
					<?php
					$cls = new DatabaseTable($pdo, 'classification');//new database table for classification.
					$classifications = $cls->searchAll();//search all the information of classification.
					echo '<option value="'. $auction['classification'].'">'. get_classification($pdo, $auction['classification']).'</option>';
					foreach ($classifications as $cls) {
						echo '<option value="' . $cls['classification_id'] . '">' . $cls['classification'] . '</option>';
					}
				?>
				</select><br>
				<!-- auction description section -->
				<label>Auction Description</label>
				<textarea cols="5" rows="5" class="form-control" name="description"><?php echo $auction['description'] ?></textarea>
				<br>
				
				<label>Category:</label>
				<select class="form-control" name="category" >
				<!-- category section. -->
				<?php
					$cate = new DatabaseTable($pdo, 'categories');//new database table for categories.
					$categories = $cate->searchAll();//search all the information of categories.
					echo '<option value="' . $auction['category_id'] . '">' . get_category($pdo, $auction['category_id']) . '</option>';
					foreach ($categories as $cate) {
						echo '<option value="' . $cate['category_id'] . '">' . $cate['category'] . '</option>';
					}
				?>
				</select><br>

				<label>auction_date:</label>
				<input type="date" class="form-control" name="auctionDate" value="<?php echo $auction['auction_date'] ?>"><br>

				<label>Auction period:</label>
				<select class="form-control" name="auctionPeriod" >
					<option value="<?php echo $auction['period'] ?>"><?php echo $auction['period'] ?></option>
					<option class="form-control" value="Morning">Morning</option>
					<option class="form-control" value="Afternoon">Afternoon</option>
					<option class="form-control" value="Evening">Evening</option>
				</select><br>

				<label>Estimated price</label>
				<input class="form-control" min="1000" type="number" placeholder="Minimum: 1000" name="estimatedPrice" value="<?php echo $auction['estimated_price'] ?>" >
				<br>
				<div>
				<input type="submit"class="btn btn-dark" name="updateAuction" value="Update Auction" />

				<input type="submit"class="btn btn-dark" name="archiveAuction" value="Archive" />
				</div>
			</form>
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
</section>



