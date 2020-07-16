<?php
	require "connection.php";
	error_reporting(E_ERROR | E_PARSE);
	if(isset($_COOKIE['uname'])){
		if($_COOKIE['uname'] != "admin" || $_COOKIE['uname'] != "admin2"){
			header(
				"Location: home.php"
			);
		}
		else if($_COOKIE['uname'] == "admin" || $_COOKIE['uname'] == "admin2"){
			header(
				"Location: home_admin.php"
			);
		}
	}
	$RegisterErr = "";
	$fnameErr = "";
	$lnameErr = "";
	$ageErr = "";
	$rnoErr = "";
	$emailErr = "";
	$unameErr = "";
	$pswdErr = "";
	$cpswdErr = "";
	if(isset($_POST['register'])){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$bdate = date('Y-m-d',strtotime($_POST['bdate']));
		$age = round((time()-strtotime($bdate))/(3600*24*365.25));
		$rno = $_POST['rno'];
		$emailid = $_POST['emailid'];
		$uname = $_POST['uname'];
		$pswd = $_POST['pswd'];
		$rpswd = $_POST['rpswd'];
		$query = "SELECT * FROM Users WHERE uname = '$uname'";
		$res = mysqli_query($conn, $query) or die("Error: " . $query);
		if(mysqli_num_rows($res)){
			$RegisterErr = "Username already in use.";
		}
		else{
			$query2 = "SELECT * FROM Users WHERE emailid = '$emailid'";
			$res2 = mysqli_query($conn, $query2) or die("Error: " . $query2);
			if(mysqli_num_rows($res2)){
				$RegisterErr = "Email address already in use.";
			}
			else{
				if(!preg_match('/^[A-Z][a-z]+$/', $fname) || $fname == 'admin' || $fname == 'admin2'){
					$fnameErr = "Enter valid first name.";
				}
				else if(!preg_match('/^[A-Z][a-z]+$/', $lname) || $lname == 'admin' || $lname == 'admin2'){
					$lnameErr = "Enter valid last name.";
				}
				else if($age < 18){
					$ageErr = "Event is only for adults(18+).";
				}
				else if(!preg_match('/^[0-9]{2}[B](IT|CE|CL|ME|EC|EE|IC|CI)[0-9]{2}[1-9]$/', $rno)){
					$rnoErr = "Enter valid roll number.";
				}
				else if(!filter_var($emailid, FILTER_VALIDATE_EMAIL)){
					$emailErr = "Enter valid email.";
				}
				else if(!preg_match('/^[A-Za-z0-9_.]+$/', $uname)){
					$unameErr = "Username consists of <br>
						<ul>
							<li>A - Z</li>
							<li>a - z</li>
							<li>0 - 9</li>
							<li>'.' and '_'</li>
						</ul>
					";
				}
				else if(!preg_match('@[A-Z]@', $pswd) || !preg_match('@[a-z]@', $pswd) || !preg_match('@[0-9]@', $pswd) || !preg_match('@[^\w]@', $pswd) || strlen($pswd) < 8){
					$pswdErr = "Password must contain atleast 1 capital letter, 1 lowercase letter, 1 numerical, 1 special character and the length of password must be greater than 8";
				}
				else if($pswd !== $rpswd){
					$cpswdErr = "Entered passwords don't match. Try again!";
				}
				else{
					$cpswd = crypt($pswd, '$1$somethin$');
					$query3 = "INSERT INTO `Users` (`fname`, `lname`, `bdate`, `uname`, `pswd`, `rno`, `emailid`) VALUES ('$fname','$lname','$bdate','$uname','$cpswd','$rno','$emailid');";
					$res3 = mysqli_query($conn, $query3) or die("Error: " . $query3 . "<br>" . mysqli_error($conn));
					setcookie('uname', $uname, time()+3600*24*30, '/');
					header(
						"Location: home.php"
					);
				}
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="jumbotron">
			<div class="container">
				<h1 class="text-center">Register</h1><br/>
				<form action="register.php" method="POST">
					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group">
								<label for="fname">First Name</label>
								<input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name" required>
							</div>	
						</div>
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group">
								<label for="lname">Last Name</label>
								<input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group">
								<label for="bdate">Birthdate</label>
								<input type="date" class="form-control" id="bdate" name="bdate" placeholder="Enter Birthdate" required>
							</div>
						</div>
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group">
						    	<label for="rno">Roll Number:</label>
						      	<input type="text" class="form-control" id="rno" placeholder="Enter Roll Number" name="rno" required>
						    </div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group">
						    	<label for="emailid">Email Id:</label>
						      	<input type="email" class="form-control" id="emailid" placeholder="Enter Email Id" name="emailid" required>
						    </div>
						</div>
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group">
						    	<label for="uname">Username:</label>
						      	<input type="text" class="form-control" id="uname" placeholder="Enter Username" name="uname" required>
						    </div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group">
						    	<label for="pswd">Password:</label>
						      	<input type="password" class="form-control" id="pswd" placeholder="Enter Password" name="pswd" required>
						    </div>
						</div>
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="form-group">
						    	<label for="rpswd">Confirm Password:</label>
						      	<input type="password" class="form-control" id="rpswd" placeholder="Re-enter Password" name="rpswd" required>
						    </div>
						</div>
					</div>
				    <div class="form-group text-center">
				    	<input type="submit" name="register" class="btn btn-primary" value="Register">
				    </div>
				    <div class="d-flex">
				    	<a href="login.php" class="ml-auto">Already Have An Account</a>
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
				else if($fnameErr != "")
					echo $fnameErr;
				else if($lnameErr != "")
					echo $lnameErr;
				else if($ageErr != "")
					echo $ageErr;
				else if($rnoErr != "")
					echo $rnoErr;
				else if($emailErr != "")
					echo $emailErr;
				else if($unameErr != "")
					echo $unameErr;
				else if($pswdErr != "")
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