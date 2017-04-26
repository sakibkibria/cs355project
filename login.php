<?php

session_start(); 
require 'database.php';
if ( !empty($_POST)) { 
	$username = $_POST['Username']; 
	$password = $_POST['password'];
	$passwordhash = MD5($password);
	// verify the username/password
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM Students WHERE Username = ? AND password = ? LIMIT 1";
	$q = $pdo->prepare($sql);
	$q->execute(array($username,$passwordhash));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	
	if($data) { // if successful login set session variables
		echo "success!";
		$_SESSION['Student_id'] = $data['Student_id'];
		$sessionid = $data['id'];
		Database::disconnect();
		header("Location: home.html?id=$sessionid ");
		
	}
	else { // otherwise go to login error page
		Database::disconnect();
		header("Location: login.php");
		
	}
} 
// if $_POST NOT filled then display login form, below.
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  
  
  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
<form class="form-horizontal" action="login.php" method="post">
  <!--Google Font - Work Sans-->
<link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,700' rel='stylesheet' type='text/css'>

<div class="container">
<form class="form-horizontal" action="Bootstraplogin.php" method="post">
  <div class="profile">
    <button class="profile__avatar" id="toggleProfile">
     <img src="https://michiganorha.files.wordpress.com/2010/03/svsu_cardinal.png" alt="Avatar" /> 
    </button>
    <div class="profile__form">
      <div class="profile__fields">
        <div class="field">
          <input name="Username" type="text" id="fieldUser" class="input" required />
          <label for="fieldUser" class="label">Username</label>
        </div>
        <div class="field">
          <input name="password" type="password" id="fieldPassword" class="input" required />
          <label for="fieldPassword" class="label">Password</label>
        </div>
		
					<div class="profile__footer">
					<button type="submit" class="btn">Sign In</button>
				</div>
		
		
				<div>
				
					<a class="link" href="student_create.php">Register</a>
				</div>
				
      </div>
     </div>
  </div>
</div>
</form>

  
    <script src="js/index.js"></script>

</body>
</html>
