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
<?php 
	require 'database.php';
	$line_number = $row[line_number];
	if ( !empty($_GET['line_number'])) {
		$line_number = $_REQUEST['line_number'];
	}
	
	if ( null==$line_number ) {
		header("Location: courses_needed.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM courses_needed where line_number = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($line_number));
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

<body background="http://www.designbolts.com/wp-content/uploads/2012/12/White-Gradient-Squares-Seamless-Patterns-For-Website-Backgrounds.jpg">
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Read a course</h3>
		    		</div>
		    		
	    			<div class="form-horizontal" >
					  <div class="control-group">
					    <label class="control-label">Line Number</label>
					    <div class="controls">
						    <label class="checkbox">
						     	<?php echo $data['line_number'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Course Number</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['course_number'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Course Title</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['course_title'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Course Requisite</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['course_requisite'];?>
						    </label>
					    </div>
					  </div>
					    <div class="control-group">
					    <label class="control-label"> Credits</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['credits'];?>
						    </label>
					    </div>
					  </div>
					    <div class="form-actions">
						  <a class="btn" href="courses_needed.php">Back</a>
					   </div>
					
					 
					</div>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>