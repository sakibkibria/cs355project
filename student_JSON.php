<?php 
include 'database.php';
	
	$pdo = Database::connect();
	if($_GET['Student_id']) 
		$sql = "SELECT * from Students WHERE id=" . $_GET['Student_id']; 
	else
		$sql = "SELECT * from Students";
	$arr = array();
	foreach ($pdo->query($sql) as $row) {
	
		array_push($arr, $row['Student_id'] . ", ". $row['Last_Name']. ", ". $row['First_Name']. ", ". $row['Username']);
		
	}
	Database::disconnect();
	echo '{"ID, First Name, Last Name, Username":' . json_encode($arr) . '}';
?>
