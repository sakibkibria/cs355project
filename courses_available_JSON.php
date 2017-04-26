<?php 
include 'database.php';
	
	$pdo = Database::connect();
		$sql = "SELECT * from courses_needed";
	$arr = array();
	foreach ($pdo->query($sql) as $row) {
	
		array_push($arr, $row['line_number'] . ", ". $row['course_number']. ", ". $row['course_title']. ", ". $row['course_requisite']. ", ". $row['faculty']. ", ". $row['credits']. ", ". $row['semester']);
		
	}
	Database::disconnect();
	echo '{"line_number, course_number, course_title, course_requisite,faculty,credits,semester":' . json_encode($arr) . '}';
?>
