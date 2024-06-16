<?php 
require('../db/database.php');
// require('../db/databaseTable.php');
session_start();
if(isset($_SESSION['a_id']))
{
 header('Refresh: 1; url =../MAIN/admins.php');
 
 }

else
{
?>
<!DOCTYPE html>
<html lang="en">
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

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Product filter in php</title>

    <script src="../Bootstrap/jquery-1.12.4.js"></script>
    <script src="../Bootstrap/jquery-ui.js"></script>
    <!-- <script src="js/bootstrap.min.js"></script> -->
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <link href = "../Bootstrap/jquery-ui.css" rel = "stylesheet">
    <!-- Custom CSS -->
    <!-- <link href="css/style.css" rel="stylesheet"> -->

</head>

<body id="users">
    <header id="index_header">
        <div id="navbar">
            <?php include('../Include/navbar.php'); ?>
        </div>
    </header>
    
    <main id="showAuctions" style="margin-top: 1%;"> 


   <!-- Page Content -->
   <br />
            <h2 align="center">Advance Search</h2>
    <div class="container" style="display: flex; flex-direction: row;" >
        <!-- <div class="row"> -->
        	
        	<br />
            <div class="col-md-5" >                				
				<div class="list-group" >
					<h3>Auction Estimated Price</h3>
					<input type="hidden" id="auction_minimum_estimated_price" value="1000" />
                    <input type="hidden" id="auction_maximum_estimated_price" value="65000" />
                    <p id="estimated_price">1000 - 65000</p>
                    <div id="estimated_price_range"></div>
                </div>	

                <div class="list-group" style="margin-top: 8%;">
					<h3>Artist</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
					<?php

                    $query = "SELECT DISTINCT(artist) FROM auctions WHERE archive = '0' ORDER BY artist";
                    $statement = $pdo->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector artist" value="<?php echo $row['artist']; ?>"  > <?php echo $row['artist']; ?></label>
                    </div>
                    <?php
                    }

                    ?>
                    </div>
                </div>

				<div class="list-group"  style="margin-top: 8%;">
					<h3>Category</h3>
                    <?php
                    $query = "SELECT DISTINCT(category_id) FROM auctions WHERE archive = '0' ORDER BY category_id";
                    $statement = $pdo->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector category" value="<?php echo $row['category_id']; ?>" > <?php echo get_category($pdo, $row['category_id']) ?></label>
                    </div>
                    <?php    
                    }

                    ?>
                </div>
				
				<div class="list-group"  style="margin-top: 8%;">
					<h3>classification</h3>
					<?php
                    $query = "SELECT DISTINCT(classification) FROM auctions WHERE archive = '0' ORDER BY classification";

                    $statement = $pdo->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector classification" value="<?php echo $row['classification']; ?>"  > <?php echo get_classification($pdo, $row['classification']); ?></label>
                    </div>
                    <?php
                    }
                    ?>	
                </div>
            </div>

            <div class="col-md-7">
            	<br />
                <div class="row searched_data">

                </div>
            </div>
        <!-- </div> -->

    </div>
</main>
<footer class="alert alert-secondary" style="margin-top: 5%; margin-bottom: 0;">
        <p style="text-align: center;">(c) 2019. Forthby's Auction House</p>
    </footer>
</body>

</html>
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
<style>


#loading
{
	text-align:center; 
	background: url('loader.gif') no-repeat center; 
	height: 150px;
}
</style>



<script>
$(document).ready(function(){

    searched_data();

    function searched_data()
    {
        $('.searched_data').html('<div id="loading" style="" ></div>');
        var action = 'search_data';
        var minimum_price = $('#auction_minimum_estimated_price').val();
        var maximum_price = $('#auction_maximum_estimated_price').val();
        var artist = get_filter('artist');
        var category = get_filter('category');
        var classification = get_filter('classification');
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, artist:artist, category:category, classification:classification},
            success:function(data){
                $('.searched_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        searched_data();
    });

    $('#estimated_price_range').slider({
        range:true,
        min:1000,
        max:65000,
        values:[1000, 65000],
        step:500,
        stop:function(event, ui)
        {
            $('#estimated_price').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#auction_minimum_estimated_price').val(ui.values[0]);
            $('#auction_maximum_estimated_price').val(ui.values[1]);
            searched_data();
        }
    });

});
</script>

</body>

</html>
