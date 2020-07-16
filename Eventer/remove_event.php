<?php
	require "connection.php";
	error_reporting(E_ERROR | E_PARSE);
	if(!isset($_COOKIE['uname'])){
		header(
			"Location: login.php"
		);
	}
	else if($_COOKIE['uname'] != "admin" && $_COOKIE['uname'] != "admin2"){
		header(
			"Location: home.php"
		);
	}
	if(isset($_POST['rem_event'])){
		$enameErr = "";
		$ename = $_POST['ename'];
		$query = "SELECT * FROM events WHERE ename = '".$ename."'";
		$res = mysqli_query($conn, $query);
		if(mysqli_num_rows($res)){
			$query3 = "DELETE FROM events WHERE ename = '".$ename."';";
			$res3 = mysqli_query($conn, $query3) or die("Error: " . $query3 . "<br>" . mysqli_error($conn));
			$query4 = "SELECT * FROM Users WHERE e1 = '".$ename."'";
			$res4 = mysqli_query($conn, $query4);
			if(mysqli_num_rows($res4)){
				while($row = mysqli_fetch_assoc($res4)){
					$query5 = "UPDATE Users SET e1='0' WHERE uname='".$row['uname']."'";
					$res5 = mysqli_query($conn, $query5);
				}
			}
			$query4 = "SELECT * FROM Users WHERE e2 = '".$ename."'";
			$res4 = mysqli_query($conn, $query4);
			if(mysqli_num_rows($res4)){
				while($row = mysqli_fetch_assoc($res4)){
					$query5 = "UPDATE Users SET e2='0' WHERE uname='".$row['uname']."'";
					$res5 = mysqli_query($conn, $query5);
				}
			}
			$query4 = "SELECT * FROM Users WHERE e3 = '".$ename."'";
			$res4 = mysqli_query($conn, $query4);
			if(mysqli_num_rows($res4)){
				while($row = mysqli_fetch_assoc($res4)){
					$query5 = "UPDATE Users SET e3='0' WHERE uname='".$row['uname']."'";
					$res5 = mysqli_query($conn, $query5);
				}
			}
			header(
				"Location: home_admin.php"
			);
		}
		else{
			$enameErr = "No such event.";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Remove Event</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-expand bg-light navbar-light shadow">
		<div class="container">
			<a class="navbar-brand" href="home_admin.php"><h1>Eventer</h1></a>
			<ul class="navbar-nav">
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
				<h1 class="text-center">Remove Event</h1><br/>
				<form action="remove_event.php" method="POST">
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
							<div class="form-group">
								<label for="ename">Event Name</label>
								<input type="text" class="form-control" id="ename" name="ename" placeholder="Enter Event Name" required>
							</div>	
						</div>
					</div>
				    <div class="form-group text-center">
				    	<input type="submit" name="rem_event" class="btn btn-danger" value="Remove Event">
				    </div>
				</form>
			</div>
		</div>
	</div>
	<div class="text-center">
		<p class="text-danger">
			<?php 
				if($enameErr != ""){
					echo $enameErr;
				}
			?>
		</p>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>