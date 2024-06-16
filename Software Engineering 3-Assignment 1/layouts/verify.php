<?php 
require('../db/database.php');

$key = $_GET['vKey'];

$sql = "UPDATE clients SET emailverify = 1 WHERE emKey= '$key'";
$statement = $pdo->prepare($sql);
$statement->execute();

echo "you email address has been verified. <a class='btn btn-dark' href='index.php'>Go to auction page</a>";

 ?>