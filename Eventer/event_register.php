<?php 
	require "connection.php";
	error_reporting(E_ERROR | E_PARSE);
	if(!isset($_COOKIE['uname'])){
		header(
			"Location: login.php"
		);
	}
	else if($_COOKIE['uname'] == "admin" || $_COOKIE['uname'] == "admin2"){
		header(
			"Location: home_admin.php"
		);
	}
	$uname = $_COOKIE['uname'];
	$query = "SELECT * FROM Users WHERE uname='$uname'";
	$res = mysqli_query($conn, $query);
	$fname = "";
	$lname = "";
	$rno = "";
	$emailid = "";
	$ename = $_GET['ename'];
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
	$alreadyreg = "";
	if($e1 == $ename || $e2 == $ename || $e3 == $ename){
		$alreadyreg = "You are already registered.";
	}
	$che = $_POST['agreement'];
	$regfullErr = "";
	$regsuc = "";
	if(isset($_POST['register'])){
		if($e1 == '0'){
			$query3 = "UPDATE Users SET e1='$ename' WHERE uname='$uname'";
			$res3 = mysqli_query($conn, $query3);
			$regsuc = "You are successfully registered.";
		}
		else if($e2 == '0'){
			$query3 = "UPDATE Users SET e2='$ename' WHERE uname='$uname'";
			$res3 = mysqli_query($conn, $query3);
			$regsuc = "You are successfully registered.";
		}
		else if($e3 == '0'){
			$query3 = "UPDATE Users SET e3='$ename' WHERE uname='$uname'";
			$res3 = mysqli_query($conn, $query3);
			$regsuc = "You are successfully registered.";
		}
		else{
			$regfullErr = "Sorry you cannot register for more than 3 events.";
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
	<br/><br/>
	<div class="container">
		<?php 
			$query2 = "SELECT * FROM events WHERE ename = '$ename'";
			$res2 = mysqli_query($conn, $query2);
			if(mysqli_num_rows($res2)){
				while($row = mysqli_fetch_assoc($res2)){
					echo "<div class='jumbotron text-center'>";
					echo "<h1>".$row['ename']."</h1>";
					echo "</div>";
					echo "<div>";
					echo "<p>".$row['description']."</p><br>";
					echo "</div>";
					echo "<div class='d-flex'>";
					echo "<a href='#'>".$row['edate']."</a><br>";
					echo "<a href='#' class='ml-auto'>".$row['etime']."</a><br>";
					echo "</div><br><br>";
					if($regsuc == "" && $regfullErr == "" && $alreadyreg == ""){
						echo "<div class='jumbotron'>";
						echo "<p>Any kind of mischief will not be allowed in the event. If caught, serious penalty will be applied.</p>";
						echo "
							<form action='event_register.php?ename=".$ename."' method='POST'>
							  	<div class='form-group form-check'>
							    	<label class='form-check-label'>
							      		<input class='form-check-input' type='checkbox' name='agreement' required> I agree to the terms above.
							    	</label>
								</div>
								<input type='submit' class='btn btn-primary' name='register' value='Register'>
							</form>
						";
						echo "</div>";
					}
				}
			}
		?>
	</div>
	<div class="container text-center">
		<?php
			if($alreadyreg != ""){
				echo "<p class='text-success'>".$alreadyreg."</p>";
			}
			if($regfullErr != ""){
				echo "<p class='text-danger'>".$regfullErr."</p>";
			}
			else{
				echo "<p class='text-success'>".$regsuc."</p>";
			}
		?>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>