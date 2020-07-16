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
	<br/><br/>
	<div class="container">
		<?php  
			$query2 = "SELECT * FROM events;";
			$res2 = mysqli_query($conn, $query2);
			if(mysqli_num_rows($res2)){
				$ctr = 0;
				while($row = mysqli_fetch_assoc($res2)){
					$ctr++;
					$msg = "";
					if($e1 == $row['ename'] || $e2 == $row['ename'] || $e3 == $row['ename']){
						$msg = "You are already registered.";
					}
					$now = date_create(date('Y-m-d'));
					$edate = date_create($row['edate']);
					if(date_diff($now, $edate) > 0){
						echo "<div class='card'>";
						echo "<div class='card-body'>";
						echo "<h3 class='card-title'>".$row['ename']."</h3>";
					    echo "<p class='card-text'>".$row['description']."</p>";
					    if($msg == ""){
					    	echo "<a href='event_register.php?ename=".$row['ename']."' class='card-link'>Register</a>";
						}
						else{
							echo "<a href='event_register.php?ename=".$row['ename']."' class='card-link text-success'>Registered</a>";	
						}
					    echo "<a href='' class='card-link'>".date('d/m/Y', strtotime($row['edate']))."</a>";
					    echo "<a href='' class='card-link'>".date('h:i:sa', strtotime($row['etime']))."</a>";
						echo "</div>";
						echo "</div>";
					}
				}
			}
			else{
				echo "<div class='text-center text-danger'>";
				echo "<h2>No events available.</h2>";
				echo "</div>";
			}
		?>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>