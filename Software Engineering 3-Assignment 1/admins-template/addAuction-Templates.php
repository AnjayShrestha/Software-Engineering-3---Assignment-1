<?php
require '../db/database.php';//connect to database
require('../db/databaseTable.php');
?>
<section id="addNewAdmin" class="alert alert-secondary" style="margin-top: 2%; padding: 2%; border-radius: 5px; margin-left: 30%; margin-right: 30%; margin-bottom: 5%;">
	<?php 
	if (isset($_POST['addAuction'])) {
	
	if(isset($_POST["auctionTitle"])){
	$title = $_POST["auctionTitle"];
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

	if(isset($_POST["estimatedPrice"])){
	$estimatedPrice = $_POST["estimatedPrice"];
	}

	if(isset($_POST["description"])){
	$description = $_POST["description"];
	}
	// check if any input is empty or not.
	if (empty($artist)  || empty($title) || empty($location)  || empty($category) || empty($description)  || empty($workYear) || empty($classification) || empty($auctionDate) || empty($estimatedPrice)) {
		echo "Please fill all the input.";
		echo '<a href="admins.php?admin=addAuction" class="btn btn-secondary">Get back</a>';	
	}
	else{
		// validate artist name
		if ((!preg_match("/^[A-Z][a-zA-Z -]+$/", $artist))||(!preg_match("/^[A-Z][a-zA-Z -]+$/", $location)))  {
			echo 'Artist name/ location is invalid';
			echo '<a href="admins.php?admin=addAuction" class="btn btn-secondary">Get back</a>';
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
			$result = [
			'lot_number'=> $auctions['auction_id']+10000000,
			'title'		=> $_POST['auctionTitle'],
			'piece_title' => $_POST['pieceTitle'],
			'category_id' => $_POST['category'],
			'artist' => $_POST['artist'],
			'auction_image' => $file_name,
			'location' => $_POST['location'],
			'work_produced_year' => $_POST['workYear'],
			'classification' => $_POST['classification'],
			'description' => $_POST['description'],
			'auction_date' => $_POST['auctionDate'],
			'period'	=> $_POST['auctionPeriod'],
			'estimated_price' => $_POST['estimatedPrice']
			];
			$statement= new DatabaseTable($pdo, 'auctions');//new database table for statements.
			$statements =$statement->insert($result);
			echo 'Auction added';
			echo '<a href="admins.php?admin=auctions" class="btn btn-secondary">Show all Auction Details</a>';
			// header("Refresh: 0.5; url=admins.php?admin=addAuction");
			}
		}
	}
	else {
		?>


			<h2>Add New Auction</h2>
			<!-- form to add article. -->
			<form action="" class="addNewAuction" method="POST" enctype="multipart/form-data">
				<!-- fill auction title -->
				<label>Auction Title:</label>
				<input type="text" class="form-control" name="auctionTitle" required=""><br>

				<!--fill piece title -->
				<label>Piece Title:</label>
				<input type="text" class="form-control" name="pieceTitle"><br>

				<!-- fill artist name -->
				<label>Artist name:</label>
				<input type="text" class="form-control" name="artist" required=""><br>

				<!-- enter auction image -->
				<label>Auction Image:</label>
				<input type="file" class="form-control" name="image"  required=""><br>


				<!--fill location section -->
				<label>Location:</label>
				<input type="text" class="form-control" name="location" required="" ><br>

				<label>Work Produced Year:</label>
				<input type="date" class="form-control" name="workYear" required=""><br>

				<label>Classification:</label>
				<select class="form-control" name="classification">
				<option value=""></option> 
				<!-- empty option-->
				<?php
					$cls = new DatabaseTable($pdo, 'classification');//new database table for classification.
					$classifications = $cls->searchAll();//search all the information of classification.

					foreach ($classifications as $cls) {
						echo '<option value="' . $cls['classification_id'] . '">' . $cls['classification'] . '</option>';
					}
				?>
				</select><br>
				
				<!-- here foes auction description -->
				<label>Auction Description</label>
				<textarea cols="5" rows="5" class="form-control" name="description"></textarea>
				<br>

				<label>Category:</label>
				<select class="form-control" name="category" required="">
					<option value=""></option>
				<?php
					$cate = new DatabaseTable($pdo, 'categories');//new database table for categories.
					$categories = $cate->searchAll();//search all the information of categories.

					foreach ($categories as $cate) {
						echo '<option value="' . $cate['category_id'] . '">' . $cate['category'] . '</option>';
					}
				?>
				</select><br>

				<label>auction_date:</label>
				<input type="date" class="form-control" name="auctionDate" required=""><br>

				<label>Auction period:</label>
				<select class="form-control" name="auctionPeriod" >
					<option value=""></option>
					<option class="form-control" value="Morning">Morning</option>
					<option class="form-control" value="Afternoon">Afternoon</option>
					<option class="form-control" value="Evening">Evening</option>
				</select><br>

				<label>Estimated price</label>
				<input class="form-control" type="number" min="1000" name="estimatedPrice" required="" placeholder="Minimum: 1000">
				<br>

				<input type="submit"class="btn btn-dark" name="addAuction" value="Add Auction" />

			</form>
			<div id="response"></div>
			<?php 
	}
	?>
</section>



