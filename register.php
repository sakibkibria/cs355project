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
	ini_set('display_errors', 1);
	require 'database.php';

	if ( !empty($_POST)) {
		//keep track validation errors
		$Student_idError = null;
		$FirstnameError = null;
		$LastnameError = null;
		$UsernameError = null;
		$passwordError = null;
		$pictureError = null;
		
		//keep track post values
		$Student_id = $_POST['Student_id'];
		$Firstname = $_POST['First_Name'];
		$Lastname = $_POST['Last_Name'];
		$Username = $_POST['Username'];
		$password = $_POST['password'];
		$passwordhash = MD5($password);
		$picture = $_POST['picture'];
		
		
		// initialize $_FILES variables
		$fileName = $_FILES['userfile']['name'];
		$tmpName  = $_FILES['userfile']['tmp_name'];
		$fileSize = $_FILES['userfile']['size'];
		$fileType = $_FILES['userfile']['type'];
		$content = file_get_contents($tmpName);
		
		// validate input 
			$valid = true;
		if (empty($Student_id)) {
			$Student_idError= 'Please enter Student ID';
			$valid = false;
		}
	
		if (empty($Firstname)) {
			$FirstnameError = 'Please enter First name';
			$valid = false;
		}
		
		if (empty($Lastname)) {
			$LastnameError = 'Please enter Last name';
			$valid = false;
		}
		
		if (empty($Username)) {
			$UsernameError = 'Please enter Username';
			$valid = false;
		}
		if (empty($password)) {
			$passwordError = 'Please enter password';
			$valid = false;
		}
		
		$types = array('image/jpeg','image/gif','image/png');
		
		if($fileSize > 0) {
		if(in_array($_FILES['userfile']['type'], $types)) {
		}
		else {
			$filename = null;
			$filetype = null;
			$filesize = null;
			$filecontent = null;
			$pictureError = 'improper file type';
			$valid=false;
			
		}
	}
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO Students (Student_id,First_Name,Last_Name,Username,password,
			filename,filesize,filetype,filecontent) values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($Student_id,$Firstname,$Lastname,$Username,$passwordhash,
			$fileName,$fileSize,$fileType,$content));
			
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM Students WHERE Username = ? AND password = ? LIMIT 1";
			$q = $pdo->prepare($sql);
			$q->execute(array($Username,$passwordhash));
			$data = $q->fetch(PDO::FETCH_ASSOC);

			$_SESSION['Student_id'] = $data['Student_id'];
			Database::disconnect();

			header("Location: login.php");
			

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
		    			<h3>Create a Student</h3>
		    		</div>
					
    		
	    			<form class="form-horizontal" action="student_create.php" method="post"enctype="multipart/form-data">
					  <div class="control-group <?php echo !empty($Student_idError)?'error':'';?>">
					    <label class="control-label">Student ID</label>
					    <div class="controls">
					      	<input name="Student_id" type="text"  placeholder="Student id" value="<?php echo !empty($Student_id)?$Student_id:'';?>">
					      	<?php if (!empty($Student_idError)): ?>
					      		<span class="help-inline"><?php echo $Student_idError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  
					  
					  <div class="control-group <?php echo !empty($FirstnameError)?'error':'';?>">
					    <label class="control-label">First Name</label>
					    <div class="controls">
					      	<input name="First_Name" type="text"  placeholder="Firstname" value="<?php echo !empty($Firstname)?$Firstname:'';?>">
					      	<?php if (!empty($FirstnameError)): ?>
					      		<span class="help-inline"><?php echo $FirstnameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  
					  
					  <div class="control-group <?php echo !empty($LastnameError)?'error':'';?>">
					    <label class="control-label">Last Name</label>
					    <div class="controls">
					      	<input name="Last_Name" type="text" placeholder="Lastname " value="<?php echo !empty($Lastname)?$Lastname:'';?>">
					      	<?php if (!empty($LastnameError)): ?>
					      		<span class="help-inline"><?php echo $LastnameError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  
					  
					  <div class="control-group <?php echo !empty($UsernameError)?'error':'';?>">
					    <label class="control-label">Username </label>
					    <div class="controls">
					      	<input name="Username" type="text"  placeholder="Username" value="<?php echo !empty($Username)?$Username:'';?>">
					      	<?php if (!empty($UsernameError)): ?>
					      		<span class="help-inline"><?php echo $UsernameError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  
					   <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
					    <label class="control-label">password </label>
					    <div class="controls">
					      	<input name="password" type="password"  placeholder="password" value="<?php echo !empty($password)?$password:'';?>">
					      	<?php if (!empty($passwordError)): ?>
					      		<span class="help-inline"><?php echo $passwordError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  
					  <div class="control-group <?php echo !empty($pictureError)?'error':'';?>">
					<label class="control-label">Picture</label>
					<div class="controls">
						<input type="hidden" name="MAX_FILE_SIZE" value="26000000">
						<input name="userfile" type="file" id="userfile">
						
					</div>
					</div>
					  
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="student.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>