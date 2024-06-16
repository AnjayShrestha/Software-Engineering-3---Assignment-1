<?php 
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'SE3Assignment1';
$pdo= new PDO("mysql:host=localhost; dbname=SE3Assignment1; charset=utf8mb4", "root", "");
require('../db/databaseTable.php');
$connect = mysqli_connect($host, $username, $password, $dbname);
session_start();



	
	if(isset($_POST["category"])){
	$category = $_POST["category"];
	}
	
	if (empty($category) ) {
		echo "empty input";	
	}
		else{
			//check if any input are valid
			if (!preg_match("/^[A-Z][a-zA-Z -]+$/", $category)) {
			echo 'invalid category';
			}
			else{
				// check valid email.
					$sql ="SELECT * FROM categories WHERE category='$category'";
					$result = mysqli_query($connect, $sql);
					$resultCheck = mysqli_num_rows($result);

					if ($resultCheck > 0) 
					{
					echo 'taken';
					}

					else{
						$result = [
						'admin_id' => $_SESSION['a_id'],
						'category' => $_POST['category']
						];
						$statement= new DatabaseTable($pdo, 'categories');//new database table for statements.
						$statements =$statement->insert($result);
						echo 'success';
	

					}
				}
			}
		
 ?>