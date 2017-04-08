<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    		<div class="row">
    			<h3>Student Account</h3>
    		</div>
			<div class="row">
				<p>
					<a href="student_create.php" class="btn btn-success">Create</a>
				</p>
				
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
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