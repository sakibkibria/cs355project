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

	if ( !empty($_POST)) {
		// keep track validation errors
		$line_numberError = null;
		$coursenumberError = null;
		$coursetitleError = null;
		$courserequisiteError = null;
		$facultyError = null;
		$creditsError = null;
		$semesterError = null;
		
		
		// keep track post values
		$line_number = $_POST['line_number'];
		$coursenumber = $_POST['course_number'];
		$coursetitle= $_POST['course_title'];
		$courserequisite = $_POST['course_requisite'];
		$faculty = $_POST['faculty'];
		$credits = $_POST['credits'];
		$semester = $_POST['semester'];
		// validate input 
			$valid = true;
		if (empty($line_number)) {
			$line_numberError= 'Please enter  line number';
			$valid = false;
		}
	
		if (empty($coursenumber)) {
			$coursenumberError = 'Please enter course number';
			$valid = false;
		}
		
		if (empty($coursetitle)) {
			$coursetitleError = 'Please enter course title';
			$valid = false;
		}
		
		if (empty($courserequisite)) {
			$courserequisiteError = 'Please enter course requisite';
			$valid = false;
		}
		
     	if (empty($faculty)) {
			$facultyError = 'Please enter name of Faculty ';
			$valid = false;
		}
		
		if (empty($credits)) {
			$creditsError = 'Please enter number of credits ';
			$valid = false;
		}
		
		if (empty($semester)) {
			$semesterError = 'Please enter the semester with year ';
			$valid = false;
		}
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO courses_available (line_number,course_number,course_title,course_requisite,faculty,credits,semester) values(?, ?, ?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($line_number,$coursenumber,$coursetitle,$courserequisite,$faculty,$credits,$semester));
			Database::disconnect();
			header("Location: courses_available.php");
		}
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
		    			<h3>Create a Course</h3>
		    		</div>
					
    		
	    			<form class="form-horizontal" action="courses_available_create.php" method="post">
					  <div class="control-group <?php echo !empty($line_numberError)?'error':'';?>">
					    <label class="control-label">line number</label>
					    <div class="controls">
					      	<input name="line_number" type="text"  placeholder="line number" value="<?php echo !empty($line_number)?$line_number:'';?>">
					      	<?php if (!empty($line_numberError)): ?>
					      		<span class="help-inline"><?php echo $line_numberError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  
					  
					  <div class="control-group <?php echo !empty($coursenumberError)?'error':'';?>">
					    <label class="control-label">Course Number</label>
					    <div class="controls">
					      	<input name="course_number" type="text"  placeholder="course number" value="<?php echo !empty($coursenumber)?$coursenumber:'';?>">
					      	<?php if (!empty($coursenumberError)): ?>
					      		<span class="help-inline"><?php echo $coursenumberError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  
					  
					  <div class="control-group <?php echo !empty($coursetitleError)?'error':'';?>">
					    <label class="control-label">Course Title</label>
					    <div class="controls">
					      	<input name="course_title" type="text" placeholder="course title " value="<?php echo !empty($coursetitle)?$coursetitle:'';?>">
					      	<?php if (!empty($coursetitleError)): ?>
					      		<span class="help-inline"><?php echo $coursetitleError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  
					  
					  <div class="control-group <?php echo !empty($courserequisiteError)?'error':'';?>">
					    <label class="control-label">Course Requisite </label>
					    <div class="controls">
					      	<input name="course_requisite" type="text"  placeholder="course requisite" value="<?php echo !empty($courserequisite)?$courserequisite:'';?>">
					      	<?php if (!empty($courserequisiteError)): ?>
					      		<span class="help-inline"><?php echo $courserequisiteError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  
					     <div class="control-group <?php echo !empty($facultyError)?'error':'';?>">
					    <label class="control-label">Faculty</label>
					    <div class="controls">
					      	<input name="faculty" type="text"  placeholder="faculty" value="<?php echo !empty($faculty)?$faculty:'';?>">
					      	<?php if (!empty($facultyError)): ?>
					      		<span class="help-inline"><?php echo $facultyError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  
					   <div class="control-group <?php echo !empty($creditsError)?'error':'';?>">
					    <label class="control-label">Course credits</label>
					    <div class="controls">
					      	<input name="credits" type="text"  placeholder="credits" value="<?php echo !empty($credits)?$credits:'';?>">
					      	<?php if (!empty($creditsError)): ?>
					      		<span class="help-inline"><?php echo $creditsError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  
					  <div class="control-group <?php echo !empty($semesterError)?'error':'';?>">
					    <label class="control-label">Semester</label>
					    <div class="controls">
					      	<input name="semester" type="text"  placeholder="semester" value="<?php echo !empty($semester)?$semester:'';?>">
					      	<?php if (!empty($semesterError)): ?>
					      		<span class="help-inline"><?php echo $semesterError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="courses_available.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>