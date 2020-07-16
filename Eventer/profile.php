<?php 
	require "connection.php";
	error_reporting(E_ERROR | E_PARSE);
	$pswdErr = "";
	$cpswdErr = "";
	if(!isset($_COOKIE['uname'])){
		header(
			"Location: login.php"
		);
	}
	else if($_COOKIE['uname'] == "admin" || $_COOKIE['uname'] == "admin2"){
		header(
			"Location: login.php"
		);
	}
	$uname = $_COOKIE['uname'];
	$query = "SELECT * FROM Users WHERE uname='$uname'";
	$res = mysqli_query($conn, $query);
	$fname = "";
	$lname = "";
	$rno = "";
	$emailid = "";
	$bdate = "";
	if(mysqli_num_rows($res)){
		while($row = mysqli_fetch_assoc($res)){
			$fname = $row['fname'];
			$lname = $row['lname'];
			$bdate = $row['bdate'];
			$rno = $row['rno'];
			$emailid = $row['emailid'];
			$e1 = $row['e1'];
			$e2 = $row['e2'];
			$e3 = $row['e3'];
		}
	}
	if(isset($_POST['cancel'])){
		header(
			"Location: home.php"
		);
	}
	if(isset($_POST['save'])){
		$pswd = $_POST['pswd'];
		$rpswd = $_POST['rpswd'];
		if(!preg_match('@[A-Z]@', $pswd) || !preg_match('@[a-z]@', $pswd) || !preg_match('@[0-9]@', $pswd) || !preg_match('@[^\w]@', $pswd) || strlen($pswd) < 8){
			$pswdErr = "Password must contain atleast 1 capital letter, 1 lowercase letter, 1 numerical, 1 special character and the length of password must be greater than 8";
		}
		else if($pswd !== $rpswd){
			$cpswdErr = "Entered passwords don't match. Try again!";
		}
		else{
			$cpswd = crypt($pswd, '$1$somethin$');
			$query3 = "UPDATE Users SET pswd='$cpswd' WHERE uname='$uname';";
			$res3 = mysqli_query($conn, $query3) or die("Error: " . $query3 . "<br>" . mysqli_error($conn));
			setcookie('uname', $uname, time()+3600*24*30, '/');
			header(
				"Location: home.php"
			);
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-expand bg-light navbar-light shadow">
		<div class="container">
			<a class="navbar-brand" href="home.php"><h1>Eventer</h1></a>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="profile.php"><?php echo $fname; ?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="about.php">About</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="contact.php">Contact</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="logout.php">Logout</a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<div class="jumbotron">
			<div class="container">
				<h1 class="text-center">Profile</h1><br/>
				<form action="profile.php" method="POST">
					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group">
								<label for="fname">First Name</label>
								<input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name" required disabled value=<?php echo $fname ?> >
							</div>	
						</div>
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group">
								<label for="lname">Last Name</label>
								<input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name" required disabled value=<?php echo $lname ?>>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group">
								<label for="bdate">Birthdate</label>
								<input type="date" class="form-control" id="bdate" name="bdate" placeholder="Enter Birthdate" required disabled value=<?php echo $bdate ?>>
							</div>
						</div>
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group">
						    	<label for="rno">Roll Number:</label>
						      	<input type="text" class="form-control" id="rno" placeholder="Enter Roll Number" name="rno" required disabled value=<?php echo $rno ?>>
						    </div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group">
						    	<label for="emailid">Email Id:</label>
						      	<input type="email" class="form-control" id="emailid" placeholder="Enter Email Id" name="emailid" required disabled value=<?php echo $emailid ?>>
						    </div>
						</div>
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group">
						    	<label for="uname">Username:</label>
						      	<input type="text" class="form-control" id="uname" placeholder="Enter Username" name="uname" required disabled value=<?php echo $uname ?>>
						    </div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group">
						    	<label for="pswd">Password:</label>
						      	<input type="password" class="form-control" id="pswd" placeholder="Enter Password" name="pswd">
						    </div>
						</div>
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group">
						    	<label for="rpswd">Confirm Password:</label>
						      	<input type="password" class="form-control" id="rpswd" placeholder="Re-enter Password" name="rpswd">
						    </div>
						</div>
					</div>
				    <div class="form-group d-flex">
				    	<input type="submit" name="cancel" class="btn btn-danger" value="Cancel">
				    	<input type="submit" name="save" class="btn btn-primary ml-auto" value="Save">
				    </div>
				</form>
			</div>
		</div>
	</div>
	<div class="container text-center">
		<p class="text-danger">
			<?php
				if($pswdErr != "")
					echo $pswdErr;
				else if($cpswdErr != "")
					echo $cpswdErr;
			?>
		</p>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>