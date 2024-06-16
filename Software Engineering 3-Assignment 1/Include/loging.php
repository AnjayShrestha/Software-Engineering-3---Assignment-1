<?php 
session_start();
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'SE3Assignment1';

$connect = mysqli_connect($host, $username, $password, $dbname);

// if(isset($_SESSION['a_id']))
// {
//  header('Refresh: 1; url =../MAIN/admins.php');
 
//  }

// else{

	if(isset($_POST["username"])){
	$username = $_POST["username"];
	}

	if(isset($_POST["password"])){
		$password = $_POST["password"];
	}

	if(empty($username)||empty($password)){
		echo "empty";
	}
	else{
		$sql = "SELECT * FROM admin WHERE username ='$username' OR emailAddress='$username'  ";
		$result = mysqli_query($connect, $sql);
		$resultCheck = mysqli_num_rows($result);

	if($resultCheck>0){
		if($row=mysqli_fetch_assoc($result)){
			$check = password_verify($password, $row['password']);
					if($check){
				$_SESSION['a_id'] 	= $row['admin_id'];
				$_SESSION['loggedin1'] = $row['username'];
				$_SESSION['loggedin2'] = $row['emailAddress'];
				echo "success";
				
			}
			else
			{
				echo "error";
			}
		}
	}
	else{
		echo "no";

	}
	}

// }    // $connect = mysqli_connect("localhost", "root", "", "dissertation");


