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
	}
	
	if (empty($classification) ) {
		echo "empty input";	
	}
		else{
			//check if any input are valid
			if (!preg_match("/^[A-Z][a-zA-Z -]+$/", $classification)) {
			echo 'invalid classification';
			}
			else{
				// check valid email.
					$sql ="SELECT * FROM classification WHERE classification='$classification'";
					$result = mysqli_query($connect, $sql);
					$resultCheck = mysqli_num_rows($result);

					if ($resultCheck > 0) 
					{
					echo 'taken';
					}

					else{
						$result = [
						'admin_id' => $_SESSION['a_id'],
						'classification' => $_POST['classification']
						];
						$statement= new DatabaseTable($pdo, 'classification');//new database table for statements.
						$statements =$statement->insert($result);
						echo 'success';//print success when creating classification is successfull
	

					}
				}
			}
		
 ?>