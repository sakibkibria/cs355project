<?php 
	require 'database.php';
	$line_number = 0;
	
	if ( !empty($_GET['line_number'])) {
		$line_number = $_REQUEST['line_number'];
	}
	
	if ( !empty($_POST)) {
		// keep track post values
		$line_number = $_POST['line_number'];
		
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM courses_needed WHERE line_number = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($line_number));
		Database::disconnect();
		header("Location: courses_needed.php");
		
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
		    			<h3>Delete a course</h3>
		    		</div>
		  
	    			<form class="form-horizontal" action="courses_needed_delete.php" method="post">
	    			  <input type="hidden" name="line_number" value="<?php echo $line_number;?>"/>
					  <p class="alert alert-error">Are you sure to delete ?</p>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-danger">Yes</button>
						  <a class="btn" href="courses_needed.php">No</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>