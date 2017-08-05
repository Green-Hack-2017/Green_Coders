<?php

session_start();
require_once 'dbconnect.php';

if (isset($_SESSION['userSession'])!="") {
	header("Location: home.php");
	exit;
}

if (isset($_POST['btn-login'])) {
	
	$email = strip_tags($_POST['email']);
	$password = strip_tags($_POST['password']);
	
	$email = $DBcon->real_escape_string($email);
	$password = $DBcon->real_escape_string($password);
	
	$query = $DBcon->query("SELECT id, email, password FROM admins WHERE email='$email'");
	$row=$query->fetch_array();
	
	$count = $query->num_rows; // if email/password are correct returns must be 1 row
	
	if (password_verify($password, $row['password']) && $count==1) {
		$_SESSION['userSession'] = $row['id'];
		header("Location: home.php");
	} else {
		$msg = "<div class='alert alert-danger'>
					<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Invalid Username or Password !
				</div>";
	}
	$DBcon->close();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Login</title>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
    <div class="maindiv">
      	<div class="insidediv3">&nbsp;</div>
      	<form class="form-signin" method="post" id="login-form">
      		<h2 class="form-signin-heading">Log In</h2><hr />
        
	        <?php
			if(isset($msg)){
				echo $msg;
			}
			?>
        
        	<div class="form-group">
        		<input type="email" class="form-control" placeholder="Email address" name="email" required />
        		<span id="check-e"></span>
        	</div>
        
        	<div class="form-group">
        		<input type="password" class="form-control" placeholder="Password" name="password" required />
        	</div>
       
     		<hr />
        
        	<div class="form-group">
            	<button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
    				<span class="glyphicon glyphicon-log-in"></span> &nbsp; Log In
				</button> 
            
            	<a href="adminreg.php" class="btn btn-default" style="float:right;">Sign Up Here</a>
            
        	</div>    
      	</form>
      	<div class="insidediv3">&nbsp;</div>
    </div>

</body>
</html>