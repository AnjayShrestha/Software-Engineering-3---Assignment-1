<?php 
// get_users.php

$pdo= new PDO("mysql:host=localhost; dbname=SE3Assignment1; charset=utf8mb4", "root", "");
// session_start();
// $id = $_SESSION['id'];
if (empty($_POST['name'])) {
	echo 'empty';
}
else
{
// auctions classification
$sql = "SELECT * FROM auctions WHERE (artist like '%".$_POST['name']."%' OR estimated_price like '%".$_POST['name']."%')  ORDER BY artist" ;
// category sql
$cate = "SELECT * FROM categories WHERE category like '%".$_POST['name']."%' ORDER BY category";
// classification sql
$class = "SELECT * FROM classification WHERE classification like '%".$_POST['name']."%' ORDER BY classification";


// for fetching category
 if ($array = $pdo->query($cate)) {
 	echo '<b>Category</b><br>';
	foreach ($array as $key) {
	?>

	<div id="users">
		<span><?php echo '
		<a class="dropdown-item bg-light" href="../layouts/category.php?id='.$key['category_id'].'">'.$key['category'].'<div class="dropdown-divider"></div>
		</a>'; ?></span>

	</div>

	<?php 
	}
 }


  if ($array = $pdo->query($class)) {
 	echo '<b>Classification</b><br>';
	foreach ($array as $key) {
	?>

	<div id="users">
		<span><?php echo '
		<a class="dropdown-item bg-light" href="../layouts/classification.php?id='.$key['classification_id'].'">'.$key['classification'].'<div class="dropdown-divider"></div>
		</a>'; ?></span>

	</div>

	<?php 
	}
 }

// for fetching classification
if ($array = $pdo->query($sql)) {
 	echo '<b>Artist and Price</b><br>';
	foreach ($array as $key) {
	?>

	<div id="users">
		<span><?php echo '
		<a class="dropdown-item bg-light" href="../layouts/auctionDetails.php?id='.$key['auction_id'].'">
		<div style="display: flex; flex-direction: row"><div>
		<img width="50%" src="../images/'.$key['auction_image'].'">
		</div>
		<div>
		Artist: '.$key['artist'].'<br>
 		Price: £'.$key['estimated_price'].'<br>
 		</div></div></a><div class="dropdown-divider"></div>'; ?></span>

	</div>

	<?php 
	}
 }




}
 ?>
 
 <!--  -->