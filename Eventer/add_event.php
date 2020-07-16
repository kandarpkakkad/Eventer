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
	$RegisterErr = "";
	$enameErr = "";
	$descErr = "";
	$dateErr = "";
	if(isset($_POST['add_event'])){
		$ename = $_POST['ename'];
		$desc = $_POST['desc'];
		$now = date_create(date('Y-m-d'));
		$edate = date('Y-m-d',strtotime($_POST['edate']));
		$etime = date('H:i:s', strtotime($_POST['etime']));
		$c = date_create($edate);
		$query = "SELECT * FROM events WHERE ename = '$ename'";
		$res = mysqli_query($conn, $query) or die("Error: " . $query);
		$diff = date_diff($now, $c);
		if(mysqli_num_rows($res)){
			$RegisterErr = "Event already exists.";
		}
		else{
			if(!preg_match('/^[A-Z][A-Za-z0-9 ]+$/', $ename)){
				$enameErr = "Enter valid event name.";
			}
			else if(strlen($desc) == 0 || strlen($desc) > 100){
				$descErr = "Description is compulsory and should have maximum 100 characters";
			}
			else if(intval($diff->format('%R%a')) <= 0){
				$dateErr = "Enter valid event date.";
			}
			else{
				$query3 = "INSERT INTO `events` (`ename`, `description`, `edate`, `etime`) VALUES ('$ename','$desc','$edate','$etime');";
				$res3 = mysqli_query($conn, $query3) or die("Error: " . $query3 . "<br>" . mysqli_error($conn));
				header(
					"Location: home_admin.php"
				);
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Event</title>
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
				<h1 class="text-center">Add Event</h1><br/>
				<form action="add_event.php" method="POST">
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
							<div class="form-group">
								<label for="ename">Event Name</label>
								<input type="text" class="form-control" id="ename" name="ename" placeholder="Enter Event Name" required>
							</div>	
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
							<div class="form-group">
								<label for="desc">Desciption</label>
								<input type="text" class="form-control" id="desc" name="desc" placeholder="Enter Desciption (maximum 100 characters allowed.)" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group">
						    	<label for="edate">Event Date:</label>
						      	<input type="date" class="form-control" id="edate" placeholder="Enter Event Date" name="edate" required>
						    </div>
						</div>
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group">
						    	<label for="etime">Event Time:</label>
						      	<input type="time" class="form-control" id="etime" placeholder="Enter Event Time" name="etime" required>
						    </div>
						</div>
					</div>
				    <div class="form-group text-center">
				    	<input type="submit" name="add_event" class="btn btn-primary" value="Add Event">
				    </div>
				</form>
			</div>
		</div>
	</div>
	<div class="container text-center">
		<p class="text-danger">
			<?php
				if($RegisterErr != "")
					echo $RegisterErr;
				else if($enameErr != "")
					echo $enameErr;
				else if($descErr != "")
					echo $descErr;
				else if($dateErr != "")
					echo $dateErr;
			?>
		</p>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>