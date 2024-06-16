<?php 
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'SE3Assignment1';
$pdo= new PDO("mysql:host=localhost; dbname=SE3Assignment1; charset=utf8mb4", "root", "");
require('../db/databaseTable.php');
$connect = mysqli_connect($host, $username, $password, $dbname);
session_start();

 	
 	if(isset($_POST["classification"])){
	$classification = $_POST["classification"];
	}//if classification is entered
 	
 	if (empty($classification) ) {
		echo 'empty';
		
	}
		else{
			//check if any input are valid
			if (!preg_match("/^[A-Z][a-zA-Z -]+$/", $classification)) {
			echo 'invalid';
			
			}
			else{
				// check valid email.
					$sql ="SELECT * FROM classification WHERE classification='$classification'";
					$classifications = mysqli_query($connect, $sql);
					$classificationCheck = mysqli_num_rows($classifications);

					if ($classificationCheck > 0) 
					{
					echo 'taken';
					
					}

					else{
						$query = "
						UPDATE classification
						SET classification = :classification
						WHERE classification_id = :classification_id
						";

						$classification = [
						'classification_id' => $_POST['ClaId'],
						'classification' => $_POST['classification']
						];
						$statement = $pdo->prepare($query);
						$statement->execute($classification);						
						echo 'success';
						
	

					}
				}
			}
 