<?php
	session_start();
			if(!isset($_SESSION["Student_id"])){ // if "user" not set,
			session_destroy();
			header('Location: login.php');     // go to login page
		
		exit;
		}
		$sessionid = $_SESSION['Student_id'];
	include database.php;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body background="http://www.designbolts.com/wp-content/uploads/2012/12/White-Gradient-Squares-Seamless-Patterns-For-Website-Backgrounds.jpg">
    <div class="container">
    		<div class="row">
    			<h3>Courses Needed</h3>
    		</div>
			<div class="row">
				<p>
					<a href="courses_needed_create.php" class="btn btn-success">Create</a>
				</p>
					<a href="home.html"><button class="btn btn-info">Home</button></a>
				<a href="logout.php"><button class="btn btn-danger">Log Out</button></a>	
				
				
				
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>Line Number</th>
		                  <th>Course Number</th>
		                  <th>Courses Title </th>
		                  <th>Course Requisite</th>
						  <th>Credits</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					   include 'database.php';
					   $pdo = Database::connect();
					   $sql = 'SELECT * FROM courses_needed ORDER BY line_number DESC';
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
							   	echo '<td>'. $row['line_number'] . '</td>';
							   	echo '<td>'. $row['course_number'] . '</td>';
							   	echo '<td>'. $row['course_title'] . '</td>';
								echo '<td>'. $row['course_requisite'] . '</td>';
								echo '<td>'. $row['credits'] . '</td>';
							   	echo '<td width=250>';
							   	echo '<a class="btn " href="courses_needed_read.php?line_number='.$row['line_number'].'">Read</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-success" href="courses_needed_update.php?line_number='.$row['line_number'].'">Update</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-danger" href="courses_needed_delete.php?line_number='.$row['line_number'].'">Delete</a>';
							   	echo '</td>';
							   	echo '</tr>';
					   }
					   Database::disconnect();
					  ?>
				      </tbody>
	            </table>
    	</div>
    </div> <!-- /container -->
  </body>
</html>