<?php 
	require 'database.php';
	$Student_id = $row[Student_id];
	if ( !empty($_GET['Student_id'])) {
		$Student_id = $_REQUEST['Student_id'];
	}
	
	if ( null==$Student_id ) {
		header("Location: student.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM Students where Student_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($Student_id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Read a Student</h3>
		    		</div>
		    		
	    			<div class="form-horizontal" >
					  <div class="control-group">
					    <label class="control-label">First Name</label>
					    <div class="controls">
						    <label class="checkbox">
						     	<?php echo $data['First_Name'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Last Name</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['Last_Name'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Username</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['Username'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Student id</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['Student_id'];?>
						    </label>
					    </div>
					  </div>
					    <div class="form-actions">
						  <a class="btn" href="student.php">Back</a>
					   </div>
					
					 
					</div>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>