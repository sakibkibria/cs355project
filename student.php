<!DOCTYPE html>
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
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
	  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body background="http://www.designbolts.com/wp-content/uploads/2012/12/White-Gradient-Squares-Seamless-Patterns-For-Website-Backgrounds.jpg">
    <div class="container">
    		<div class="row">
    			<h3>Student Account</h3>
    		</div>
			<div class="row">
				<p>
					<a href="student_create.php" class="btn btn-success">Create</a>
				</p>
				<a href="home.html"><button class="btn btn-info">Home</button></a>
				<a href="logout.php"><button class="btn btn-danger">Log Out</button></a>	
				</a>
				
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
						<th>    		</th>
		                  <th>Student id</th>
		                  <th>First Name</th>
		                  <th>Last Name</th>
		                  <th>Username</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					   include 'database.php';
					   $pdo = Database::connect();
					   $sql = 'SELECT * FROM Students ORDER BY Student_id DESC';
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
								echo '<td>.<img class="img-circle" width="40" height="40" src="data:image/jpeg;base64,'.base64_encode( $row['filecontent'] ).'"/></td>'; 
							   	echo '<td>'. $row['Student_id'] . '</td>';
							   	echo '<td>'. $row['First_Name'] . '</td>';
							   	echo '<td>'. $row['Last_Name'] . '</td>';
								echo '<td>'. $row['Username'] . '</td>';
								echo '<td width=250>';
							   	echo '<a class="btn " href="student_read.php?Student_id='.$row['Student_id'].'">Read</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-success" href="student_update.php?Student_id='.$row['Student_id'].'">Update</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-danger" href="student_delete.php?Student_id='.$row['Student_id'].'">Delete</a>';
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