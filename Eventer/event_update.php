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
	$event_name = $_GET['ename'];
	$query4 = "SELECT * FROM events WHERE ename='$event_name'";
	$res4 = mysqli_query($conn, $query4);
	$evdate = "";
	$evtime = "";
	$evdesc = "";
	if(mysqli_num_rows($res4)){
		while($row = mysqli_fetch_assoc($res4)){
			$evdate = $row['edate'];
			$evtime = $row['etime'];
			$evdesc = $row['description'];
		}
	}
	else{
		$BIGERR = "No such event.";
	}
	$RegisterErr = "";
	$enameErr = "";
	$descErr = "";
	$dateErr = "";
	if(isset($_POST['update_event'])){
		$ename = $_POST['ename'];
		$desc = $_POST['desc'];
		$now = date_create(date('Y-m-d'));
		$edate = date('Y-m-d',strtotime($_POST['edate']));
		$etime = date('H:i:s', strtotime($_POST['etime']));
		$c = date_create($edate);
		$diff = date_diff($now, $c);
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
			$query3 = "UPDATE `events` SET `ename`='$ename',`description`='$desc',`edate`='$edate',`etime`='$etime' WHERE `ename`='$event_name';";
			$res3 = mysqli_query($conn, $query3) or die("Error: " . $query3 . "<br>" . mysqli_error($conn));
			header(
				"Location: home_admin.php"
			);
		}
	}
	if(isset($_POST['cancel'])){
		header(
			"Location: home_admin.php"
		);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Event</title>
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
				<h1 class="text-center">Update Event</h1><br/>
				<form action="event_update.php?ename=<?php echo $event_name; ?>" method="POST">
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
							<div class="form-group">
								<label for="ename">Event Name</label>
								<input type="text" class="form-control" id="ename" name="ename" placeholder="Enter Event Name" required value="<?php echo $event_name; ?>">
							</div>	
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
							<div class="form-group">
								<label for="desc">Desciption</label>
								<input type="text" class="form-control" id="desc" name="desc" placeholder="Enter Desciption (maximum 100 characters allowed.)" required value="<?php echo $evdesc; ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group">
						    	<label for="edate">Event Date:</label>
						      	<input type="date" class="form-control" id="edate" placeholder="Enter Event Date" name="edate" required value="<?php echo $evdate; ?>">
						    </div>
						</div>
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group">
						    	<label for="etime">Event Time:</label>
						      	<input type="time" class="form-control" id="etime" placeholder="Enter Event Time" name="etime" required value="<?php echo $evtime; ?>">
						    </div>
						</div>
					</div>
				    <div class="form-group d-flex">
				    	<button name="cancel" class="btn btn-danger" onclick="go_back()">Cancel</button>
				    	<input type="submit" name="update_event" class="btn btn-primary ml-auto" value="Update">
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
	<div class="container">
		<div style="width: 100%; float: left;">
			<canvas id="myChart"></canvas>
		</div>
	</div>
	<?php
		$CE = 0;
		$CI = 0;
		$CL = 0;
		$EC = 0;
		$EE = 0;
		$IC = 0;
		$IT = 0;
		$ME = 0;
		$query5 = "SELECT COUNT(*) FROM Users WHERE (e1='$event_name' OR e2='$event_name' OR e3='$event_name') AND rno LIKE '%CE%';";
		$res5 = mysqli_query($conn, $query5);
		if(mysqli_num_rows($res5)){
			while($row = mysqli_fetch_assoc($res5)){
				$CE = $row['COUNT(*)'];
			}
		}
		$query5 = "SELECT COUNT(*) FROM Users WHERE (e1='$event_name' OR e2='$event_name' OR e3='$event_name') AND rno LIKE '%CI%';";
		$res5 = mysqli_query($conn, $query5);
		if(mysqli_num_rows($res5)){
			while($row = mysqli_fetch_assoc($res5)){
				$CI = $row['COUNT(*)'];
			}
		}
		$query5 = "SELECT COUNT(*) FROM Users WHERE (e1='$event_name' OR e2='$event_name' OR e3='$event_name') AND rno LIKE '%CL%';";
		$res5 = mysqli_query($conn, $query5);
		if(mysqli_num_rows($res5)){
			while($row = mysqli_fetch_assoc($res5)){
				$CL = $row['COUNT(*)'];
			}
		}
		$query5 = "SELECT COUNT(*) FROM Users WHERE (e1='$event_name' OR e2='$event_name' OR e3='$event_name') AND rno LIKE '%EC%';";
		$res5 = mysqli_query($conn, $query5);
		if(mysqli_num_rows($res5)){
			while($row = mysqli_fetch_assoc($res5)){
				$EC = $row['COUNT(*)'];
			}
		}
		$query5 = "SELECT COUNT(*) FROM Users WHERE (e1='$event_name' OR e2='$event_name' OR e3='$event_name') AND rno LIKE '%EE%';";
		$res5 = mysqli_query($conn, $query5);
		if(mysqli_num_rows($res5)){
			while($row = mysqli_fetch_assoc($res5)){
				$EE = $row['COUNT(*)'];
			}
		}
		$query5 = "SELECT COUNT(*) FROM Users WHERE (e1='$event_name' OR e2='$event_name' OR e3='$event_name') AND rno LIKE '%IC%';";
		$res5 = mysqli_query($conn, $query5);
		if(mysqli_num_rows($res5)){
			while($row = mysqli_fetch_assoc($res5)){
				$IC = $row['COUNT(*)'];
			}
		}
		$query5 = "SELECT COUNT(*) FROM Users WHERE (e1='$event_name' OR e2='$event_name' OR e3='$event_name') AND rno LIKE '%IT%';";
		$res5 = mysqli_query($conn, $query5);
		if(mysqli_num_rows($res5)){
			while($row = mysqli_fetch_assoc($res5)){
				$IT = $row['COUNT(*)'];
			}
		}
		$query5 = "SELECT COUNT(*) FROM Users WHERE (e1='$event_name' OR e2='$event_name' OR e3='$event_name') AND rno LIKE '%ME%';";
		$res5 = mysqli_query($conn, $query5);
		if(mysqli_num_rows($res5)){
			while($row = mysqli_fetch_assoc($res5)){
				$ME = $row['COUNT(*)'];
			}
		}
	?>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		var ctx = document.getElementById('myChart').getContext('2d');
		var chart = new Chart(ctx, {
		    // The type of chart we want to create
		    type: 'bar',

		    // The data for our dataset
		    data: {
		        labels: ['CE', 'CI', 'CL', 'EC', 'EE', 'IC', 'IT', 'ME'],
		        datasets: [{
		            backgroundColor: 'rgb(3,122,251)',
		            borderColor: 'rgb(3,122,251)',
		            data: [<?php echo intval($CE) ?>, <?php echo intval($CI) ?>, <?php echo intval($CL) ?>, <?php echo intval($EC) ?>, <?php echo intval($EE) ?>, <?php echo intval($IC) ?>, <?php echo intval($IT) ?>, <?php echo intval($ME) ?>]
		        }]
		    },

		    // Configuration options go here
		    options: {
				responsive: true,
				maintainAspectRatio: true,
				legend: {
					display: false,
					position: 'top',
				},
				title: {
					display: true,
					text: 'Branch Wise Number Of Registered Students',
				},
				scales: {
					xAxes: [{
					   display:true,
					}],
					yAxes: [{
						ticks: {
						   beginAtZero:true,
						   stepSize: 10,
						   max: 100,
						}
					}]
				}

			}
		});
	</script>
</body>
</html>