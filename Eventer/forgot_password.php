<?php  
	require "connection.php";
	error_reporting(E_ERROR | E_PARSE);
	$UnameErr = "";
	function randomPassword() {
	    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	    $pass = array();
	    $alphaLength = strlen($alphabet) - 1;
	    for ($i = 0; $i < 10; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass);
	}
	if(isset($_POST['request_password'])){
		$uname = $_POST['uname'];
		$query = "SELECT * FROM Users WHERE uname='$uname'";
		$res = mysqli_query($conn, $query);
		if(mysqli_num_rows($res)){
			$newpswd = randomPassword();
			$npswd = crypt($newpswd, '$1$somethin$');
			$query2 = "UPDATE Users SET pswd='$npswd' WHERE uname='$uname'";
			$res2 = mysqli_query($conn, $query2);
			while($row = mysqli_fetch_assoc($res)){
				$to = $row['emailid'];
				$subject = "New Password";
				$msg = "Dear Student<br><br>Your new password is " . $newpswd . ". Kindly change it after login.<br><br>Regards<br><br><b>Kandarp Kakkad</b><br><b>Event Manager</b>";
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				mail($to, $subject, $msg, $headers);
			}
			header(
				"Location: login.php"
			);
		}
		else{
			$UnameErr = "Enter valid username.";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="jumbotron">
			<div class="container">
				<h1 class="text-center">Forgot Password</h1><br/>
				<form action="forgot_password.php" method="POST">
				    <div class="form-group">
				    	<label for="uname">Username:</label>
				      	<input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname" required>
				    </div>
				    <div class="form-group text-center">
				    	<input type="submit" name="request_password" class="btn btn-primary" value="Request Password">
				    </div>
				</form>
			</div>
		</div>
	</div>
	<div class="container text-center">
		<p class="text-danger"><?php echo $UnameErr ?></p>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>