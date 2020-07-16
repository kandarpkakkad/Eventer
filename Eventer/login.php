<?php 
	require "connection.php";
	error_reporting(E_ERROR | E_PARSE);
	if(isset($_COOKIE['uname'])){
		if($_COOKIE['uname'] == "admin" || $_COOKIE["uname"] == "admin2"){
			header(
				"Location: home_admin.php"
			);
		}
		else if($_COOKIE['uname'] != "admin" && $_COOKIE["uname"] != "admin2"){
			header(
				"Location: home.php"
			);
		}
	}
	$loginErr = "";
	if(isset($_POST['login'])){
		$uname = $_POST['uname'];
		$pswd = $_POST['pswd'];
		$pswdcheck = crypt($pswd, '$1$somethin$');
		$query = "SELECT * FROM Users WHERE uname = '$uname' AND pswd = '$pswdcheck'";
		$res = mysqli_query($conn, $query);
		if(mysqli_num_rows($res)){
			setcookie('uname', $uname, time() + 3600*24*30, '/');
			header(
				"Location: home.php"
			);
		}
		else{
			$query2 = "SELECT * FROM admin WHERE uname = '$uname' AND pswd = '$pswdcheck'";
			$res2 = mysqli_query($conn, $query2);
			if(mysqli_num_rows($res2)){
				setcookie('uname', $uname, time() + 3600*24*30, '/');
				header(
					"Location: home_admin.php"
				);
			}
			else{
				$loginErr = "Enter valid username or password.";
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="jumbotron">
			<div class="container">
				<h1 class="text-center">Login</h1><br/>
				<form action="login.php" method="POST">
				    <div class="form-group">
				    	<label for="uname">Username:</label>
				      	<input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname" required>
				    </div>
				    <div class="form-group">
				      	<label for="pswd">Password:</label>
				      	<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required>
				    </div>
				    <div class="form-group text-center">
				    	<input type="submit" name="login" class="btn btn-primary" value="Login">
				    </div>
				    <div class="d-flex">
				    	<a href="forgot_password.php">Forgot Password?</a>
				    	<a href="register.php" class="ml-auto">Create Account</a>
			    	</div>
				</form>
			</div>
		</div>
	</div>
	<div class="container text-center">
		<p class="text-danger"><?php echo $loginErr ?></p>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>