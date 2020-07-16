<?php 
	setcookie('uname', "", time()-3600, '/');
	header(
		"Location: login.php"
	);
?>