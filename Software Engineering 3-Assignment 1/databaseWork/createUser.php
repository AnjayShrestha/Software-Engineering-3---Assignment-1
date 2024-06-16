<?php 
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'SE3Assignment1';
$pdo= new PDO("mysql:host=localhost; dbname=SE3Assignment1; charset=utf8mb4", "root", "");
require('../db/databaseTable.php');
$connect = mysqli_connect($host, $username, $password, $dbname);
session_start();

	if(isset($_POST["fullname"])){
	$fullname = $_POST["fullname"];
	}

	if(isset($_POST["username"])){
		$username = $_POST["username"];
	}
	if(isset($_POST["emailAddress"])){
	$email = $_POST["emailAddress"];
	}

	if(isset($_POST["password"])){
	$password = $_POST["password"];
	}
	
	if (empty($fullname) || empty($username) || empty($email) || empty($password)) {
		echo "empty input";
	}
		else{
			//check if any input are valid
			if (!preg_match("/^[A-Z][a-zA-Z -]+$/", $fullname)) {
			echo 'invalid name';
			}
			else{
				// check valid email.
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				echo 'invalid email';	
				}
				else{
					$sql ="SELECT * FROM clients WHERE username='$username' OR email='$email'";
					$result = mysqli_query($connect, $sql);
					$resultCheck = mysqli_num_rows($result);
					
					if ($resultCheck > 0) 
					{
					echo 'taken';
					}

					else{
						$result = [
						'fullname' 		=> $_POST['fullname'],
						'username' 		=> $_POST['username'],
						'gender' 		=> $_POST['gender'],
						'email' 	=> strtolower($_POST['emailAddress']),
						'password' 		=> password_hash($_POST['password'], PASSWORD_DEFAULT),
						'type'			=> $_POST['type'],
						'emKey'			=> md5(time().$_POST['emailAddress']),
						];
						$statement= new DatabaseTable($pdo, 'clients');//new database table for statements.
						$statements =$statement->insert($result);
						echo 'success';
					}
				}
			}
		}

 ?>