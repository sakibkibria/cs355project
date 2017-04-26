<?php 
	
	require 'database.php';

	$Student_id = null;
	if ( !empty($_GET['Student_id'])) {
		$Student_id = $_REQUEST['Student_id'];
	}
	
	if ( null==$Student_id ) {
		header("Location: student.php");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$FirstnameError = null;
		$LastnameError = null;
		$UsernameError = null;
		
		// keep track post values
		$Firstname = $_POST['First_Name'];
		$Lastname= $_POST['Last_Name'];
		$Username = $_POST['Username'];
		
		// validate input
		$valid = true;
		if (empty($Firstname)) {
			$nameError = 'Please enter First Name';
			$valid = false;
		}
		
		if (empty($Lastname)) {
			$emailError = 'Please enter Last Name';
			$valid = false;
			}
		
		if (empty($Username)) {
			$mobileError = 'Please enter Username';
			$valid = false;
		}
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE Students set First_Name = ?, Last_Name = ?, Username =? WHERE Student_id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($Firstname,$Lastname,$Username,$Student_id));
			Database::disconnect();
			header("Location: student.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM Students where Student_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($Student_id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$Firstname = $data['First_Name'];
		$Lastname = $data['Last_Name'];
		$Username = $data['Username'];
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
		    			<h3>Update a Student</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="student_update.php?Student_id=<?php echo $Student_id?>" method="post">
					  <div class="control-group <?php echo !empty($FirstnameError)?'error':'';?>">
					    <label class="control-label">First Name</label>
					    <div class="controls">
					      	<input name="First_Name" type="text"  placeholder="Name" value="<?php echo !empty($Firstname)?$Firstname:'';?>">
					      	<?php if (!empty($FirstnameError)): ?>
					      		<span class="help-inline"><?php echo $FirstnameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($LastnameError)?'error':'';?>">
					    <label class="control-label">Last Name</label>
					    <div class="controls">
					      	<input name="Last_Name" type="text" placeholder="Last Name" value="<?php echo !empty($Lastname)?$Lastname:'';?>">
					      	<?php if (!empty($LastnameError)): ?>
					      		<span class="help-inline"><?php echo $LastnameError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($UsernameError)?'error':'';?>">
					    <label class="control-label">Username</label>
					    <div class="controls">
					      	<input name="Username" type="text"  placeholder="Username" value="<?php echo !empty($Username)?$Username:'';?>">
					      	<?php if (!empty($UsernameError)): ?>
					      		<span class="help-inline"><?php echo $UsernameError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="student.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>