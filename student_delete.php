<?php 
	require 'database.php';
	$Student_id = 0;
	
	if ( !empty($_GET['Student_id'])) {
		$Student_id = $_REQUEST['Student_id'];
	}
	
	if ( !empty($_POST)) {
		// keep track post values
		$Student_id = $_POST['Student_id'];
		
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM Students WHERE Student_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($Student_id));
		Database::disconnect();
		header("Location: student.php");
		
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
		    			<h3>Delete a Student</h3>
		    		</div>
		    		
	    			<form class="form-horizontal" action="student_delete.php" method="post">
	    			  <input type="hidden" name="Student_id" value="<?php echo $Student_id;?>"/>
					  <p class="alert alert-error">Are you sure to delete ?</p>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-danger">Yes</button>
						  <a class="btn" href="student.php">No</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>