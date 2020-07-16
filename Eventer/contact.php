<?php 
	require "connection.php";
	error_reporting(E_ERROR | E_PARSE);
	if(!isset($_COOKIE['uname'])){
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
	if(mysqli_num_rows($res)){
		while($row = mysqli_fetch_assoc($res)){
			$fname = $row['fname'];
			$lname = $row['lname'];
			$rno = $row['rno'];
			$emailid = $row['emailid'];
			$e1 = $row['e1'];
			$e2 = $row['e2'];
			$e3 = $row['e3'];
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
			<div class="container text-center">
				<h1>Contact</h1>
			</div>
			<div class="container">
				<p>
					This is contact page.
				</p>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>